<?php
/**
 * Configuration overrides for WP_ENV === 'staging'
 */

use Roots\WPConfig\Config;
Config::define('WP_DEBUG', true);
ini_set('display_errors', '1');
Config::define('DISALLOW_FILE_MODS', false);
Config::define('FS_METHOD', 'direct');

