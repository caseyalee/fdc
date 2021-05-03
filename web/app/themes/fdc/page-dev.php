<?php
//
// Services Debug
// 
// WP_Query arguments
$services_args = array (
    'p'                      => 1494,
    'post_type'              => array( 'brand' ),
);

// The Query
$services = new WP_Query( $services_args );

// The Loop
if ( $services->have_posts() ) {
    while ( $services->have_posts() ) {
        $services->the_post();
        $record = (array) apply_filters('brand_to_record', $post);
        header('Content-Type: application/json');
        echo json_encode($record);
        return $record;
        // do something
    }
} else {
    // no posts found
}

// Restore original Post Data
wp_reset_postdata();

//
// Keywords Debug
//

// $term_args = array(
//     'taxonomy'               => 'service-keywords',
//     'hide_empty'             => false,
//     'fields'                 => 'all',
//     'count'                  => true,
// );

// $term_query = new WP_Term_Query( $term_args );
// $records = [];
// $count = 0;

// foreach ( $term_query->terms as $term ) {
//     $record = (array) apply_filters('keyword_to_record', $term);
//     $records[] = $record;
//     $count++;
// }

// header('Content-Type: application/json');
// echo json_encode($records);

?>