<?php
/**
 * Theme Custom Functions.
 *
 * @package Kindling
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
  if (Setup\display_sidebar()) {
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
