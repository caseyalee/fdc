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

$podcasts = new CPT(
 // Labels
 array(
     'post_type_name' => 'podcast',
     'singular' => 'Podcast',
     'plural' => 'Podcasts',
     'slug' => 'podcast'
 ),
 // Description
 array(
     'supports' => array(
         'title', 'editor', 'thumbnail'
     ),
     'menu_icon' => 'dashicons-microphone', // https://developer.wordpress.org/resource/dashicons
     'has_archive' => true,
     'public' => true,
 )
);

$brands = new CPT(
 // Labels
 array(
     'post_type_name' => 'brand',
     'singular' => 'Brand',
     'plural' => 'Brands',
     'slug' => 'brand-review'
 ),
 // Description
 array(
     'supports' => array('title'),
     'menu_icon' => get_stylesheet_directory_uri().'/assets/img/cross-icon.svg', // https://developer.wordpress.org/resource/dashicons
     'has_archive' => true,
     'public' => true,
 )
);


// Brands Types Taxonomy
$brands->register_taxonomy(
    array(
       'taxonomy_name' => 'type',
       'singular' => 'Type',
       'plural' => 'Types',
    ),array(
        'hierarchical' => true,
        'publicly_queryable' => true,
    )
);


// Brands Categories Taxonomy
$brands->register_taxonomy(
    array(
       'taxonomy_name' => 'category',
       'singular' => 'Category',
       'plural' => 'Categories'
    ),array(
        'hierarchical' => true,
        'publicly_queryable' => true,
    )
);
// Brands Keywords Taxonomy
$brands->register_taxonomy(
    array(
       'taxonomy_name' => 'keyword',
       'singular' => 'Tag',
       'plural' => 'Tags'
    ),array(
        'hierarchical' => false,
        'publicly_queryable' => true,
    )
);




add_filter('wp_terms_checklist_args', 'htmlandcms_select_one_category');
function htmlandcms_select_one_category($args) {
    if (isset($args['taxonomy']) && $args['taxonomy'] == 'type') {
        $args['walker'] = new Walker_Category_Radios;
        $args['checked_ontop'] = false;
    }
    return $args;
}

class Walker_Category_Radios extends Walker {
    var $tree_type = 'category';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent<ul class='children'>\n";
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
        extract($args);
        if ( empty($taxonomy) )
            $taxonomy = 'category';

        if ( $taxonomy == 'category' )
            $name = 'post_category';
        else
            $name = 'tax_input['.$taxonomy.']';

        /** @var $popular_cats */
        $class = in_array( $object->term_id, $popular_cats ) ? ' class="popular-category"' : '';
        /** @var $selected_cats */
        $output .= "\n<li id='{$taxonomy}-{$object->term_id}'$class>" . '<label class="selectit"><input value="' . $object->term_id . '" type="radio" name="'.$name.'[]" id="in-'.$taxonomy.'-' . $object->term_id . '"' . checked( in_array( $object->term_id, $selected_cats ), TRUE, FALSE ) . disabled( empty( $args['disabled'] ), FALSE, FALSE ) . ' /> ' . esc_html( apply_filters('the_category', $object->name )) . '</label>';
    }

    function end_el( &$output, $category, $depth = 0, $args = array() ) {
        $output .= "</li>\n";
    }
}

