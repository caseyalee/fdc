<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
    <?php the_field('additional_header_scripts','option'); ?>
</head>

<body <?php body_class(); ?>>
<?php
    if (defined('WP_ENV')) {
        if (WP_ENV === 'staging') {
            echo '<div style="z-index:999999;position:fixed;top:0;right:0;width:250px;background-color:red;padding:5px 10px;color:white;text-align:center;">ENV:STAGING</div>';
        }
    }
?>

<?php do_action( 'theme_header' ); ?>