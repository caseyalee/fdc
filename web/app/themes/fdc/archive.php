<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package theme
 */
?>

<?php get_header(); ?>
<?php do_action( 'theme_content_wrap', 'start' ); ?>
<?php do_action( 'theme_before_content' ); ?>

<?php if ( have_posts() ) : ?>

	<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
	<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php do_action( 'theme_before_entry' ); ?>
		<?php get_template_part( 'loops/content', get_post_type() ); ?>
		<?php do_action( 'theme_after_entry' ); ?>

	<?php endwhile; ?>

	<?php the_posts_navigation(); ?>

<?php else : ?>

	<?php get_template_part( 'loops/content', 'none' ); ?>

<?php endif; ?>

<?php do_action( 'theme_after_content' ); ?>
<?php get_sidebar(); ?>
<?php do_action( 'theme_content_wrap', 'end' ); ?>
<?php get_footer(); ?>
