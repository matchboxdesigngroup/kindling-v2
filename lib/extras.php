<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
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
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');


/**
 * Filters Gravity Forms CSS classes for a field.
 *
 * @link    http://www.gravityhelp.com/documentation/page/Gform_field_css_class
 *
 * @param   string  $classes  The CSS classes to be filtered, separated by empty spaces (i.e. "gfield custom_class").
 * @param   array   $field    Current field.
 * @param   array   $form     Current form.
 *
 * @return  string            The filtered CSS classes separated by empty spaces (i.e. "gfield custom_class").
 */
if ( ! function_exists( 'sn_gforms_input_class' ) ) {
function sn_gforms_input_class( $classes, $field, $form ){
  $input_slug = sanitize_title( $field['label'] );
  $classes   .= " gfield-{$input_slug}";

  return $classes;
} // sn_gforms_input_class
add_action( 'gform_field_css_class', 'sn_gforms_input_class', 10, 3 );
} // if()