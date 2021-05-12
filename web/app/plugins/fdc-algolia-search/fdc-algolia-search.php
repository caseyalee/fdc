<?php

/**
 * Plugin Name: FDC Algolia Integration
 * Description: Custom Algolia search feature for Faith Driven Consumer Brands
 * Author: Casey Lee
 * Author URI: https://caseylee.dev
 * Text Domain: fdc-algolia-search
 * Version: 1.0.0
 * @package Algolia_Custom_Integration
 */



class FdcAlgoliaSearch {

    protected $algolia;
    protected $algolia_index;


    public function __construct() {

        $this->algolia = \Algolia\AlgoliaSearch\SearchClient::create(env('ALGOLIA_APP_ID'), env('ALGOLIA_ADMIN_KEY'));
        $this->algolia_index = env('ALGOLIA_BRANDS_INDEX');

        $this->add_actions();
        $this->add_filters();
        require_once __DIR__ . '/wp-cli.php';

    }


    /**
     * Define plugin filters
    */
    public function add_filters() {
        add_filter("brand_to_record", array( $this, 'algolia_brand_to_record' ), 10, 1);
    }


    /**
     * Define plugin Action Hooks
    */
    public function add_actions() {
        add_action('save_post', array( $this, 'algolia_update_brand_post' ), 10, 3);
    }



    /**
     * Push updates to Algolia on create/update
     * @param $id
     * @param WP_Post $post
     * @param $update
     * @return WP_Post
     */
    public function algolia_update_brand_post($id, WP_Post $post, $update) {

        if (wp_is_post_revision($id) || wp_is_post_autosave($id) || $post->post_type !== 'brand') {
            return $post;
        }

        // Only push publish/live records
        if ('publish' == $post->post_status) {
            $record = (array) apply_filters('brand_to_record', $post);
            $index = $this->algolia->initIndex($this->algolia_index);
            $index->saveObject($record);
        }

        // Remove trash/deleted records
        if ('trash' == $post->post_status) {
            $objectID = implode('#', [$post->post_type, $post->ID]);
            $index = $this->algolia->initIndex($this->algolia_index);
            $index->deleteObject($objectID);
        }

        return $post;

    }



    /**
     * Builds a searchable object for sending to the index
     * @param WP_Post $post
     * @return array
     */
    public function algolia_brand_to_record(WP_Post $post) {

                // Keywords Taxonomy
                $keywords = array_map(function (WP_Term $term) {
                    return [
                        'name'        =>    $term->name,
                    ];
                }, wp_get_post_terms($post->ID, 'brand-keywords'));

                // Types Taxonomy
                $type = array_map(function (WP_Term $term) use ($post) {
                    return htmlspecialchars_decode($term->name);
                }, wp_get_post_terms($post->ID, 'brand-type'));


                // Categories Taxonomy
                $categories = array_map(function (WP_Term $term) use ($post) {
                    return htmlspecialchars_decode($term->name);
                }, wp_get_post_terms($post->ID, 'brand-category'));


                $logo = get_field('brand_logo',$post->ID);
                if (!$logo) {
                    $logo = trailingslashit( get_stylesheet_directory_uri() ).'assets/img/missing.png';
                }

                // The Data
                $record = [];
                $record['objectID'] = implode('#', [$post->post_type, $post->ID]);
                $record['title']    = $post->post_title;
                $record['keywords'] = $keywords;
                $record['categories'] = $categories;
                $record['types'] = $type;
                $record['logo'] = $logo;
                $record['overall_score'] = strtolower(get_field('overall_score', $post->ID));
                $record['marketplace_score'] = get_field('score', $post->ID);
                $record['workplace_score'] = get_field('workplace_score', $post->ID);
                $record['culture_score'] = get_field('culture_score', $post->ID);
                $record['order'] = $post->menu_order;

                return $record;
    }


}

new FdcAlgoliaSearch();