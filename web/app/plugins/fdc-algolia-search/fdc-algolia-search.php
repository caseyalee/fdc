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
    protected $algolia_kwindex;


    public function __construct() {

        $this->algolia = \Algolia\AlgoliaSearch\SearchClient::create(env('ALGOLIA_APP_ID'), env('ALGOLIA_ADMIN_KEY'));
        $this->algolia_index = env('ALGOLIA_BRANDS_INDEX');
        $this->algolia_kwindex = env('ALGOLIA_KW_INDEX');

        $this->add_filters();
        $this->add_actions();
        require_once __DIR__ . '/wp-cli.php';

    }


    /**
     * Define plugin filters
    */
    public function add_filters() {
        add_filter("brand_to_record", array( $this, 'algolia_brand_to_record' ));
        add_filter("keyword_to_record", array( $this, 'algolia_keyword_to_record' ));
    }


    /**
     * Define plugin Action Hooks
    */
    public function add_actions() {
        add_action('save_post_brand', array( $this, 'algolia_update_brand_post' ), 10, 3);
    }


    /**
     * Push updates to Algolia on create/update
     * @param $id
     * @param WP_Post $post
     * @param $update
     * @return WP_Post
     */
    public function algolia_update_brand_post($id, WP_Post $post, $update) {

        if (wp_is_post_revision($post) || wp_is_post_autosave($post)) {
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

    }


    /**
     * Keyword Term to Record
     * @param  WP_Term $term [description]
     * @return [type]        [description]
     */
    public function algolia_keyword_to_record(WP_Term $term) {
        $record = [];
        $record['objectID'] = implode('#', ['keyword', $term->term_id]);
        $record['id'] = $term->term_id;
        $record['name'] = $term->name;
        return $record;
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

                $category_data = array_map(function (WP_Term $term) use ($post) {
                    
                    if (!$category_icon = get_field('category_icon', $term)) {
                       $category_icon = 'default';
                    }
                    return [
                        'name' => htmlspecialchars_decode($term->name),
                        'icon' => $category_icon,
                        'order' => (int) $term->term_order
                    ];
                }, wp_get_post_terms($post->ID, 'brand-category'));


                // // Get the primary icon
                // $primary_icon = array_map(function (WP_Term $term) use ($post) {
                //     if ($icon = get_field('icon', $term)) {
                //         $is_primary = $this->is_primary_taxonomy($post->ID,$term);
                //         if ($is_primary) {
                //             return $icon['url'];
                //         }
                //     }
                // }, wp_get_post_terms($post->ID, 'brand-category'));

                // // Get any other icons
                // $secondary_icons = array_map(function (WP_Term $term) use ($post) {
                //     if ($icon = get_field('icon', $term)) {
                //         $is_primary = $this->is_primary_taxonomy($post->ID,$term);
                //         if (!$is_primary) {
                //             return $icon['url'];
                //         }
                //     }
                // }, wp_get_post_terms($post->ID, 'brand-category'));

                // // Remove null values
                // $pi = array_filter($primary_icon, function($e) {return !is_null($e);});
                // $npi = array_filter($secondary_icons, function($e) {return !is_null($e);});

                // Merge primary ahead of secondaries
                // $category_icons = array_merge($pi, $npi);

                // $category_color = array_map(function (WP_Term $term) use ($post) {

                //     $is_primary = $this->is_primary_taxonomy($post->ID,$term);
                //     $color = get_field('color', $term);
                //     if ($is_primary && $color) {
                //         return $color;
                //     }
                //     return false;
                    
                // }, wp_get_post_terms($post->ID, 'brand-category'));

                // $category_color = current(array_filter($category_color));


                // The Data
                $record = [];
                $record['objectID'] = implode('#', [$post->post_type, $post->ID]);
                $record['title']    = $post->post_title;
                $record['keywords'] = $keywords;
                $record['categories'] = $categories;
                $record['types'] = $type;
                $record['categorydata'] = $category_data;
                $record['overall_score'] = get_post_meta($post->ID, 'overall_score', true);
                $record['marketplace_score'] = get_post_meta($post->ID, 'score', true);
                $record['workplace_score'] = get_post_meta($post->ID, 'workplace_score', true);
                $record['culture_score'] = get_post_meta($post->ID, 'culture_score', true);
                $record['order'] = $post->menu_order;

                return $record;
    }


    public function is_primary_taxonomy( $post_id, $taxonomy ) {

        $is_primary = false;

        if (class_exists('WPSEO_Primary_Term')) {

            $wpseo_primary_term = new WPSEO_Primary_Term( $taxonomy, $post_id );
            $primary_term = get_post_meta( $post_id, WPSEO_Meta::$meta_prefix . 'primary_' . $taxonomy->taxonomy, true );
            return (int) $primary_term === $taxonomy->term_id;

        }

        return $is_primary;
    }



}

new FdcAlgoliaSearch();

