<?php
/**
 * Kindling Development Constants.
 *
 * @package Kindling_Development
 */

define('KDEV_VERSION', '1.0.0');
define('KDEV_PLUGIN_DIR_PATH', rtrim(dirname(plugin_dir_path(__FILE__)), '/'));
define('KDEV_PLUGIN_URL', plugins_url(basename(dirname(plugin_dir_path(__FILE__)))));
