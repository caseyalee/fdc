<?php
/**
 * The template for displaying all single posts.
 *
 * @package theme
*/?>
<?php get_header(); ?>

<?php while ( have_posts() ) : the_post() ; ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="wrap">
        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php the_content(); ?>
            <!--
                <?php
                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'clarity' ),
                        'after'  => '</div>',
                    ) );
                ?>
            -->
        </div><!-- .entry-content -->

    </div><!-- .wrap -->

</article><!-- #post-## -->
<?php endwhile;?>

<?php get_footer(); ?>