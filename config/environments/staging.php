<?php
/**
 * Configuration overrides for WP_ENV === 'staging'
 */

use Roots\WPConfig\Config;
Config::define('WP_DEBUG', false);
ini_set('display_errors', '0');
Config::define('DISALLOW_FILE_MODS', false);
Config::define('FS_METHOD', 'direct');

