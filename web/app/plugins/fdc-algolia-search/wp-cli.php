<?php

if (!(defined('WP_CLI') && WP_CLI)) {
    return;
}

class Algolia_Command {

    protected $algolia;
    protected $algolia_index;
    protected $algolia_kwindex;

    public function __construct()
    {
        $this->algolia = \Algolia\AlgoliaSearch\SearchClient::create(env('ALGOLIA_APP_ID'), env('ALGOLIA_ADMIN_KEY'));
        $this->algolia_index = env('ALGOLIA_BRANDS_INDEX');
        $this->algolia_kwindex = env('ALGOLIA_KW_INDEX');
    }

    public function reindex_keywords($args, $assoc_args)
    {
        $index = $this->algolia->initIndex($this->algolia_kwindex);
        $index->clearObjects()->wait();

        $count = 0;

        $term_args = array(
            'taxonomy'               => 'brand-keywords',
            'hide_empty'             => false,
            'fields'                 => 'all',
            'count'                  => true,
        );
        $term_query = new WP_Term_Query( $term_args );
        $records = [];

        foreach ( $term_query->terms as $term ) {
            $record = (array) apply_filters('keyword_to_record', $term);
            $records[] = $record;
            $count++;
        }
        $index->saveObjects($records);
        $this->algolia->copySynonyms($this->algolia_index, $this->algolia_kwindex);

        WP_CLI::success("$count keywords indexed in Algolia");


    }

    public function reindex_brands($args, $assoc_args) {

        // Copy the search config from indexA to indexB
        // $this->algolia->copyIndex('dev_fdc_brands',$this->algolia_index);
        // WP_CLI::success("copied settings from dev_fdc_brands to ".$this->algolia_index);
        // exit;

        $index = $this->algolia->initIndex($this->algolia_index);
        $index->clearObjects()->wait();

        $paged = 1;
        $count = 0;

        do {

            $posts = new WP_Query([
                'posts_per_page' => 100,
                'paged' => $paged,
                'post_type' => 'brand',
                'orderby' => 'menu_order',
                'post_status' => 'publish',
            ]);

            if (!$posts->have_posts()) {
              break;
            }

            $records = [];

            foreach ($posts->posts as $post) {

                $record = (array) apply_filters('brand_to_record', $post);

                $records[] = $record;
                $count++;

            }

            if (isset($assoc_args['verbose'])) {
                WP_CLI::line('Sending batch');
            }

            $index->saveObjects($records);
            $paged++;

        } while (true);

        WP_CLI::success("$count posts indexed in Algolia");

    }

}

WP_CLI::add_command('algolia', 'Algolia_Command');