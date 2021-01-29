<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package theme
 */


/**
 * Adds custom classes to the array of body classes.
 * @param  [type] $classes [description]
 * @return [array]          [description]
 */

function dash_body_class( $classes ) {

	global $post;

	if ( isset( $post->post_name ) && ! empty( $post->post_name ) ) {
		// add the current page's slug to the body class
		$classes[] = 'post-' . $post->post_name;
	}

	if ( isset( $post->post_parent ) && ! empty( $post->post_parent ) ) {
		// add the page's parent slug to the body class
		$post_parent = get_post( $post->post_parent );
		$classes[]   = 'post_parent-' . $post_parent->post_name;
	}

	return $classes;

}
add_filter( 'body_class', 'dash_body_class' );


/**
 * Disable Emojicons
 */

function dash_disable_wp_emojicons() {
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
}
add_action( 'init', 'dash_disable_wp_emojicons' );

/**
 * Disable theme updates
 */

function dash_disable_theme_update_api( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) ) {
		return $r; // Not a theme update request. Bail immediately.
	}

	$themes = unserialize( $r['body']['themes'] );
	unset( $themes[ get_option( 'template' ) ] );
	unset( $themes[ get_option( 'stylesheet' ) ] );
	$r['body']['themes'] = serialize( $themes );
	return $r;
}
add_filter( 'http_request_args', 'dash_disable_theme_update_api', 10, 2 );
add_filter( 'auto_update_theme', '__return_false' );
