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
