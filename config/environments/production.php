<?php
/**
 * Configuration overrides for WP_ENV === 'development'
 */

use Roots\WPConfig\Config;

Config::define('SAVEQUERIES', false);
Config::define('WP_DEBUG', false);
Config::define('WP_DEBUG_DISPLAY', false);
Config::define('WP_DISABLE_FATAL_ERROR_HANDLER', false);
Config::define('SCRIPT_DEBUG', false);
Config::define('ALLOW_UNFILTERED_UPLOADS', true);

ini_set('display_errors', '0');

// Enable plugin and theme updates and installation from the admin
Config::define('DISALLOW_FILE_MODS', true);
