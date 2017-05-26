<?php
/*
Plugin Name: Theme Development Helpers
Description: Development helpers for theme.
Plugin URI: http://matchboxdesigngroup.com/
Author: Matchbox Design Group
Author URI: http://matchboxdesigngroup.com/
Version: 1.0.0
License: GPL2
*/

define('KDEV_VERSION', '1.0.0');
define('KDEV_PLUGIN_DIR_PATH', rtrim(plugin_dir_path(__FILE__), '/'));
define('KDEV_PLUGIN_FILE', __FILE__);
define('KDEV_PLUGIN_URL', plugins_url(basename(plugin_dir_path(__FILE__))));
