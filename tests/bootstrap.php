<?php
/**
 * PHPUnit bootstrap file
 *
 * @package Kindling
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
	$_tests_dir = '/tmp/wordpress-tests-lib';
}

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Loads theme required plugins.
 *
 * @param  array $files The plugin main files. Example woocommerce/woocommerce.php.
 */
function _load_theme_required_plugin_files($files) {
	$directory = dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/plugins';
	foreach ( $files as $file ) {
		$file = ltrim( $file, '/' );
		$path = "{$directory}/{$file}";

		require_once $path;
	}
}

/**
 * Manually load the plugin being tested.
 */
function _manually_load_plugin() {
	// Load required plugins.
	_load_theme_required_plugin_files( [
		// 'woocommerce/woocommerce.php',
		// 'advanced-custom-fields-pro/acf.php',
		// 'shortcode-ui/shortcode-ui.php',
	] );

	require dirname( dirname( __FILE__ ) ) . '/functions.php';
}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';
