<?php

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

add_filter( 'big_image_size_threshold', '__return_false' );


if ( ! function_exists( 'theme_setup' ) ) :
	function theme_setup() {
		/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		*/
		load_theme_textdomain( 'clarity', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support( 'title-tag' );

		/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		*/
		add_theme_support( 'post-thumbnails' );
        add_image_size( 'archive-post-thumb', 750, 350, ['center','center'] );

		// This theme uses wp_nav_menu() in one location.
        register_nav_menus([
            'primary_footer' => __('Footer Menu', 'clarity'),
            'primary_header' => __('Primary Header Menu', 'clarity'),
        ]);

		/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
	}
endif; // theme_setup

add_action( 'after_setup_theme', 'theme_setup' );


/**
 * Admin Color Scheme
 */
function fdc_admin_colors() {
  wp_admin_css_color(
    'flat',
    'Flat',
    get_stylesheet_directory_uri().'/assets/css/admin-style.css',
    array( '#2A3340', '#35404F', '#E5442C', '#086584' ),
    array(
      'base' => '#f1f2f3',
      'focus' => '#fff',
      'current' => '#fff',
    )
  );
  add_editor_style( 'editor-style.css' );
}
add_action( 'admin_init', 'fdc_admin_colors' );



/**
 * Automatically Set Color Scheme
 * @param  $user_id
 * @return wp_update_user()
 */
function fdc_set_default_admin_color($user_id) {
    $args = array(
        'ID' => $user_id,
        'admin_color' => 'flat'
    );
    wp_update_user( $args );
}
add_action('user_register', 'fdc_set_default_admin_color');


/**
 * Don't Allow Color Scheme Change
 */
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );


    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(
            [
                'page_title'    => 'Theme General Settings',
                'menu_title'    => 'Site Settings',
                'menu_slug'     => 'theme-general-settings',
                'capability'    => 'edit_posts',
                'redirect'      => true
            ]
        );

        acf_add_options_sub_page(
            [
                'page_title'     => 'Side Menu Settings',
                'menu_title'     => 'Side Menu',
                'parent_slug'    => 'theme-general-settings',
                'menu_slug'      => 'theme-sidemenu-settings'
            ]
        );

        acf_add_options_sub_page(
            [
                'page_title'     => 'Social Media Links',
                'menu_title'     => 'Social Media',
                'parent_slug'    => 'theme-general-settings',
                'menu_slug'      => 'theme-social-settings'
            ]
        );

        acf_add_options_sub_page(
            [
                'page_title'     => 'Member Benefits Content',
                'menu_title'     => 'Member Benefits',
                'parent_slug'    => 'theme-general-settings',
                'menu_slug'      => 'theme-member-benefits'
            ]
        );


        acf_add_options_sub_page(
            [
                'page_title'     => 'Theme Header Settings',
                'menu_title'     => 'Header',
                'parent_slug'    => 'theme-general-settings',
                'menu_slug'      => 'theme-header-settings'
            ]
        );

        acf_add_options_sub_page(
            [
                'page_title'     => 'Theme Footer Settings',
                'menu_title'     => 'Footer',
                'parent_slug'    => 'theme-general-settings',
                'menu_slug'      => 'theme-footer-settings'
            ]
        );


    }
