<?php
/**
 * Kindling Development Constants.
 *
 * @package Kindling_Development
 */

define('KPG_VERSION', '1.0.0');
define('KPG_PLUGIN_DIR_PATH', rtrim(plugin_dir_path(__FILE__), '/'));
define('KPG_PLUGIN_FILE', __FILE__);
define('KPG_PLUGIN_URL', plugins_url(basename(plugin_dir_path(__FILE__))));
