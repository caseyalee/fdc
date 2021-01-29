<?php
/**
 * The template for displaying search results pages.
 *
 * @package theme
 */
?>

<?php get_header(); ?>
<?php do_action( 'theme_content_wrap', 'start' ); ?>
<?php do_action( 'theme_before_content' ); ?>

<?php if ( have_posts() ) : ?>

	<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'clarity' ), '<span>' . get_search_query() . '</span>' ); ?></h1><!-- .page-title -->

	<?php while ( have_posts() ) : the_post(); ?>

		<?php do_action( 'theme_before_entry' ); ?>
		<?php get_template_part( 'loops/content', 'search' ); ?>
		<?php do_action( 'theme_after_entry' ); ?>

	<?php endwhile; ?>

	<?php the_posts_navigation(); ?>

<?php else : ?>

	<?php get_template_part( 'loops/content', 'none' ); ?>

<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php do_action( 'theme_before_entry' ); ?>
	<?php get_template_part( 'loops/content', 'search' ); ?>
	<?php do_action( 'theme_after_entry' ); ?>

<?php endwhile; ?>

<?php do_action( 'theme_after_content' ); ?>
<?php get_sidebar(); ?>
<?php do_action( 'theme_content_wrap', 'end' ); ?>
<?php get_footer(); ?>
