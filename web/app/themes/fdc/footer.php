<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package theme
 */
?>

<?php do_action( 'theme_footer' ); ?>

<?php wp_footer(); ?>
<?php the_field('additional_footer_scripts','option'); ?>
</body>
</html>
