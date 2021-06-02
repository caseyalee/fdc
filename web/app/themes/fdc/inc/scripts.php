<?php
/**
 * Enqueue scripts and styles.
 */
function theme_scripts() {

    $theme_style = '/assets/css/app.css';
    wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri().$theme_style, array(), filemtime( get_stylesheet_directory().$theme_style ) );
    $theme_style = '/assets/css/fontawesome.all.min.css';
    wp_enqueue_style( 'fontawesome-style', get_stylesheet_directory_uri().$theme_style, array(), filemtime( get_stylesheet_directory().$theme_style ) );


    $theme_min_js = '/assets/js/app.js';
    wp_enqueue_script( 'dash-js', get_stylesheet_directory_uri().$theme_min_js, array('jquery'), filemtime( get_stylesheet_directory().$theme_min_js ), true );

      // instantsearch.production.min.js
      // instantsearch.development.js
      $theme_search_js = '/assets/js/search/search.js';
      wp_register_script('instantsearch-js', get_template_directory_uri() . '/assets/js/search/instantsearch.development.js', array('jquery'), NULL, true);
      wp_register_script('algoliasearch-js', get_template_directory_uri() . '/assets/js/search/algoliasearch-lite.umd.js', array('jquery'), NULL, true);
      wp_register_script('search-js', get_template_directory_uri() . $theme_search_js, array('jquery','algoliasearch-js','instantsearch-js'), filemtime( get_stylesheet_directory().$theme_search_js ), true);

      if (is_page('fei')) {
        wp_enqueue_script('search-js');
        wp_localize_script( 'search-js', 'fdc_algolia_index',
            array( 
                'services' => env('ALGOLIA_BRANDS_INDEX'),
                'keywords' => env('ALGOLIA_KW_INDEX'),
            )
        );
      }

}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );




function remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];
        if ( $script->deps ) {
            $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
        }
    }
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );