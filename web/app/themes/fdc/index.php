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

<?php if ( have_posts() ) : ?>

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
