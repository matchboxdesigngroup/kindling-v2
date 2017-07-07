<?php
/**
 * Kindling debug/development.
 *
 * @package Kindling
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

/**
 * If the environment bar should be displayed.
 *
 * @since   Kindling 1.0.2
 *
 * @return boolean True if the bar should be displayed and false if not
 */
function mdg_display_environment_bar() {
	return apply_filters( 'mdg_display_environment_bar', ! mdg_is_production() );
}

/**
 * Adds the environment bar.
 *
 * @since   Kindling 1.0.2
 */
function mdg_environment_bar() {
	if ( ! mdg_display_environment_bar() ) {
		return;
	}

	get_template_part( 'templates/debug/environment-bar' );
}
add_action('admin_footer', 'mdg_environment_bar');
add_action('wp_footer', 'mdg_environment_bar');

/**
 * Adds the environment bar body class.
 *
 * @param  array|string $classes The current classes.
 *
 * @return array|string          An array of classes if passed in as an array and a string if passed in as a string.
 */
function mdg_environment_bar_body_class($classes) {
	if ( ! mdg_display_environment_bar() ) {
		return $classes;
	}

	$env_type = mdg_get_environment_type();
	$bar_classes = [
		'mdg-environment-bar-enabled',
		"mdg-environment-{$env_type}",
	];

	if ( is_string( $classes ) ) {
		$classes .= trim( ' ' . implode( ' ', $bar_classes ) );
	} else if ( is_array( $classes ) ) {
		$classes = array_merge( $classes, $bar_classes );
	}

	return $classes;
}
add_action( 'admin_body_class', 'mdg_environment_bar_body_class' );
add_action( 'body_class', 'mdg_environment_bar_body_class' );
