<?php
/*
Plugin Name: Theme Packages
Description: Composer packages and auto-loading for theme/plugins.
Plugin URI: http://matchboxdesigngroup.com/
Author: Matchbox Design Group
Author URI: http://matchboxdesigngroup.com/
Version: 1.0.0
License: GPL2
*/

require_once __DIR__ . '/../../../vendor/autoload.php';

do_action('kindling_packages_ready');
