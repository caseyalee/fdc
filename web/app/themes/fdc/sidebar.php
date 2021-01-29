<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package theme
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<?php do_action( 'theme_before_sidebar' ); ?>
<?php dynamic_sidebar( 'sidebar-1' ); ?>
<?php do_action( 'theme_after_sidebar' ); ?>
