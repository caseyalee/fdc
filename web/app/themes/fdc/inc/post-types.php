<?php
/*
* Custom Post Type Class
* @see https://github.com/jjgrainger/wp-custom-post-type-class
*/

include_once get_template_directory() . '/lib/class-cpt.php';

/**
 * Product Post Type
 * @var CPT
 */

// $products = new CPT(
//  // Labels
//  array(
//      'post_type_name' => 'product',
//      'singular' => 'Product',
//      'plural' => 'Products',
//      'slug' => 'product'
//  ),
//  // Description
//  array(
//      'supports' => array(
//          'title', 'editor', 'thumbnail'
//      ),
//      'menu_icon' => 'dashicons-cart', // https://developer.wordpress.org/resource/dashicons
//      'has_archive' => true,
//      'public' => true,
//  )
// );

// // Products Taxonomy
// $products->register_taxonomy(
//     array(
//        'taxonomy_name' => 'product_category',
//        'singular' => 'Category',
//        'plural' => 'Categories'
//     ),array(
//         'hierarchical' => false,
//         'publicly_queryable' => true,
//     )
// );
