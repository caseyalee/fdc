<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package theme
 */

// Move Yoast to bottom Uncomment add_filter when you activate Yoast SEO
function yoasttobottom() {
	return 'low';
}
//add_filter( 'wpseo_metabox_prio', 'yoasttobottom');


// Gravity Forms - Anchor to confirmation error
add_filter( 'gform_confirmation_anchor', '__return_true' );


// Save ACF Fields
function acf_json_save_point( $path ) {
	// update path
	$path = get_stylesheet_directory() . '/assets/acf-json';

	// return
	return $path;
}
add_filter( 'acf/settings/save_json', 'acf_json_save_point' );

// Load ACF Fields
function acf_json_load_point( $paths ) {
	// remove original path (optional)
	unset( $paths[0] );

	// append path
	$paths[] = get_stylesheet_directory() . '/assets/acf-json';

	// return
	return $paths;
}
add_filter( 'acf/settings/load_json', 'acf_json_load_point' );


// Allow SVG Uploads
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


function acf_custom_toolbars( $toolbars )
{
	// Uncomment to view format of $toolbars
	/*
	echo '< pre >';
		print_r($toolbars);
	echo '< /pre >';
	die;
	*/

	$toolbars['Simple Content' ] = array();
	$toolbars['Simple Content' ][1] = array('formatselect', 'align', 'bold' , 'italic' , 'underline', 'bullist', 'link', 'removeformat' );
	
	// Remove the "Full" toolbar
	if( ($key = array_search('code' , $toolbars['Full' ][2])) !== false )
	{
	    unset( $toolbars['Full' ][2][$key] );
	}

	// return $toolbars
	return $toolbars;
}
add_filter( 'acf/fields/wysiwyg/toolbars' , 'acf_custom_toolbars'  );



/*
 * Customize TinyMCE editor block_formats
 */
function tiny_mce_remove_unused_formats($init) {
	// Add block format elements you want to show in dropdown
	$init['block_formats'] = 'Paragraph=p;H2 Subheading=h2;H3 Subheading=h3;H4 Subheading=h4;H5 Subheading=h5';
	return $init;
}
add_filter('tiny_mce_before_init', 'tiny_mce_remove_unused_formats' );


// Disable GravityForms autocomplete
function disable_gf_autocomplete( $form_tag, $form ) {
	$form_tag = preg_replace( "|action='|", "autocomplete='off' action='", $form_tag );
	return $form_tag;
}
add_filter( 'gform_form_tag', 'disable_gf_autocomplete', 10, 2 );