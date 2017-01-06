<?php
/**
 * Theme Custom Functions.
 *
 * @package Kindling
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function mdg_body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
	if (!in_array(basename(get_permalink()), $classes)) {
	  $classes[] = basename(get_permalink());
	}
  }

  // Add class if sidebar is active
  if (mdg_display_sidebar()) {
	$classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', 'mdg_body_class');

/**
 * Clean up the_excerpt()
 */
function mdg_excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', 'mdg_excerpt_more');

/**
 * Retrieves a template from /templates.
 *
 * @since  Kindling 1.0.2
 *
 * @param  string  $path The path to the file in the templates directory.
 * @param  array   $data Optional, Data to pass through to the template. Default none.
 * @param  boolean $once Optional, if the template should be included once. Default false.
 */
function mdg_template($path, $data = [], $once = false) {
	$path = ltrim( $path, 'templates' );
	$path = ltrim( $path, '/' );
	mdg_load_template_file( "templates/{$path}" );
}

/**
 * Loads a template file.
 *
 * @since  Kindling 1.0.2
 *
 * @param  string  $path The path to the file in the templates directory.
 * @param  array   $data Optional, Data to pass through to the template. Default none.
 * @param  boolean $once Optional, if the template should be included once. Default false.
 */
function mdg_load_template_file($path, $data = [], $once = false) {
	$template = mdg_locate_template_file( "templates/{$path}" );
	if ( ! $template ) {
		return;
	}

	// Allow access to data in the template files.
	// @codingStandardsIgnoreStart
	extract( $data );
	// @codingStandardsIgnoreEnd

	if ( $once ) {
		require_once $template;
	} else {
		require $template;
	}
}

/**
 * Locates a file in the template.
 * Defaults to the child theme if active and the template is available.
 *
 * @since  Kindling 1.0.2
 *
 * @param  string $path Path in the directory.
 *
 * @return string       The path to the template file.
 */
function mdg_locate_template_file($path) {
	$path = trim( rtrim( $path, '.php' ), '/' );
	$file = get_stylesheet_directory() . "/{$path}.php";

	// Handle child theme files and themes without children.
	if ( file_exists( $file ) ) {
		return $file;
	}

	// Handle child themes that do not overwrite the parent themes file.
	$file = get_template_directory() . "/{$path}.php";
	if ( file_exists( $file ) ) {
		return $file;
	}

	return '';
}

/**
 * Page titles.
 */
function mdg_page_title() {
	if ( is_home() ) {
		if ( get_option( 'page_for_posts', true ) ) {
			return get_the_title( get_option( 'page_for_posts', true ) );
		} else {
			return __( 'Latest Posts', 'sage' );
		}
	} elseif ( is_archive() ) {
		return get_the_archive_title();
	} elseif ( is_search() ) {
		return sprintf( __( 'Search Results for %s', 'sage' ), get_search_query() );
	} elseif ( is_404() ) {
		return __( 'Not Found', 'sage' );
	} else {
		return get_the_title();
	}
}
