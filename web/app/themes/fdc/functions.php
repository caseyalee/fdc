<?php
/**
 * dash functions and definitions
 *
 * @package theme
 */

/**
 * Initial Theme Setup
 * Add support for featured images, menus, theme options etc.
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Enqueue stylesheets and javascripts
 */
require get_template_directory() . '/inc/scripts.php';

/**
 * Layout structure and template tags
 */
require get_template_directory() . '/inc/layout.php';
require get_template_directory() . '/inc/TailwindsCSS_Menu_Walker.php';

/**
 * Register Sidebars/Widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Register Post Types
 * @see  https://github.com/jjgrainger/wp-custom-post-type-class
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Core Utilities
 * body_class handlers, etc.
 */
require get_template_directory() . '/inc/utils.php';


/**
 * Site-specific custom functions
 */
require get_template_directory() . '/inc/custom_functions.php';
