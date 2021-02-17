<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package theme
 */
?>

<?php get_header(); ?>
<?php do_action( 'theme_content_wrap', 'start' ); ?>
<?php do_action( 'theme_before_content' ); ?>

<div class="spacer lg:py-12"></div>

<div class="lg:pl-72" id="mainbody">
    <div class="container max-w-screen-3xl">

        <?php if ( have_posts() ) : ?>
            <div class="lg:flex flex-wrap equalize" data-equalize-options='{"target":".entry-title"}'>
        	<?php while ( have_posts() ) : the_post(); ?>
                <div class="lg:w-1/2 lg:px-6">
            		<?php do_action( 'theme_before_entry' ); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('prose max-w-7xl prose-lg'); ?>>

                        <header class="entry-header">
                            <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                        </header><!-- .entry-header -->

                        <?php
                        if (has_post_thumbnail( $post )) {
                            echo get_the_post_thumbnail( $post, 'large',['class'=>'mb-0 w-full h-auto']);
                        }
                        ?>


                        <div class="entry-meta text-sm text-gray-600 py-2">
                            <?php theme_entry_header(); ?>
                        </div>

                        <div class="entry-content text-base">
                            <?php the_field('post_excerpt'); ?>
                            <div class="float-right mt-8">
                                <a class="button button-sm" href="<?php echo get_permalink(); ?>"><i class="fad fa-bookmark"></i> Continue Reading</a>
                            </div>
                        </div><!-- .entry-content -->
                        <hr>

                    </article><!-- #post-## -->
                </div>

        		<?php do_action( 'theme_after_entry' ); ?>

        	<?php endwhile; ?>

            </div> <!-- /.flex -->

        	<?php the_posts_navigation(); ?>

        <?php else : ?>

        	<?php get_template_part( 'loops/content', 'none' ); ?>

        <?php endif; ?>

    </div>
</div>

<?php do_action( 'theme_after_content' ); ?>
<?php do_action( 'theme_content_wrap', 'end' ); ?>
<?php get_footer(); ?>
