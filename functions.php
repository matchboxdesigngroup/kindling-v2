<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 * @package WordPress
 */

$sage_includes = [
	'lib/assets.php',               // Scripts and stylesheets.
	'lib/extras.php',               // Custom functions.
	'lib/setup.php',                // Theme setup.
	'lib/titles.php',               // Page titles.
	'lib/wrapper.php',              // Theme wrapper class.
	'lib/customizer.php',           // Theme customizer.
	'lib/navwalker.php',            // Bootstap Nav Walker.
	'lib/shortcodes.php',           // Shortcodes.
	'lib/debug/debug.php',          // Debug.
	'lib/debug/environment-bar.php',
	'lib/actions.php',              // Actions.
	'lib/filters.php',              // Filters.
	'lib/image-sizes.php',          // Image sizes.
	'lib/post-table-image-column.php',
	'lib/post-types/type-base.php', // Type Base.
	'lib/post-types/type-page.php', // Post Type: Page.
	'lib/post-types/type-post.php', // Post Type: Post.
	'lib/post-types/type-stub.php', // Post Type: Stub.
];

foreach ( $sage_includes as $file ) {
	if ( ! $filepath = locate_template( $file ) ) {
		trigger_error( sprintf( __( 'Error locating %s for inclusion', 'sage' ), $file ), E_USER_ERROR );
	}

	require_once $filepath;
}
unset( $file, $filepath );
