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

<div class="lg:pl-72 mt-6" id="mainbody">
    <div class="container max-w-screen-3xl">
        <iframe height="480px" width="100%" frameborder="no" scrolling="no" seamless src="https://player.simplecast.com/94751a5f-9c72-4503-8bd7-abcf24d9f0d9?dark=false&show=true"></iframe>
    </div>
</div>

<?php do_action( 'theme_after_content' ); ?>
<?php do_action( 'theme_content_wrap', 'end' ); ?>
<?php get_footer(); ?>
