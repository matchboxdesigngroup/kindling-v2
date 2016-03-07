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
add_action( 'gform_field_css_class', function( $classes, $field, $form ){
  $input_slug = sanitize_title( $field['label'] );
  $classes   .= " gfield-{$input_slug}";

  return $classes;
}, 10, 3 );

/**
 * Handles removing the hicpo_pre_get_posts filter.
 *
 * In the Intuitive Custom Post Order there is a template filter
 * that forces orderby=menu_order and order=ASC on active post types.
 * This causes issues when you do not want the menu_order behavior, such
 * as when you want a random order.
 *
 * @link    https://wordpress.org/plugins/intuitive-custom-post-order/
 *
 * @param   object  $query  The current query to filter.
 *
 * @return  object          The filtered query.
 */
add_filter( 'pre_get_posts', function( $query ) {
  global $wp_filter;

  if ( ! isset( $wp_filter['pre_get_posts'] ) or is_admin() ) {
    return $query;
  } // if()

  $pre_get_posts_filters = $wp_filter['pre_get_posts'];

  foreach ( $pre_get_posts_filters as $filters_key => $filters ) {
    foreach ( $filters as $filter_key => $filter ) {
      $correct_filter = ( strpos( $filter_key, 'hicpo_pre_get_posts' ) !== false );
      $has_function   = isset( $filter['function'] );

      if ( $correct_filter and $has_function ) {
        remove_filter( 'pre_get_posts', $filter['function'], $filters_key );
      } // if()
    } // foreach()
  } // foreach()


  return $query;
}, 0 );



/**
 * Checks the current host against the supplied hosts.
 *
 * @param   array $http_hosts  The possible hosts to check against.
 *
 * @return  boolean               True if the current host matches any of the supplied hosts, false if not.
 */
function check_hosts( $http_hosts = array() ) {
  $http_host = $_SERVER['HTTP_HOST'];

  // Check the possible HTTP hosts against the current HTTP host.
  if ( in_array( $http_host, $http_hosts ) ) {
    return true;
  } // if()

  // Check the possible HTTP hosts against the current HTTP host.
  foreach ( $http_hosts as $host ) {
    if ( strpos( $http_host, $host ) !== false ) {
      return true;
    } // if()
  } // foreach

  return false;
} // check_hosts()



/**
 * Checks if the current HTTP host is localhost.
 * Default possible HTTP hosts http://localhost, 127.0.0.1, 10.0.0.2, http://*.dev.
 *
 * <code>
 * if ( $mdg_utilities->is_localhost() ) {
 *  // Do something localhost specific...
 * } // if()
 * </code
 *
 * @since   Kindling 0.1.0
 *
 * @return  boolean  If the current HTTP host is localhost.
 */
function is_localhost() {
  // Default possible HTTP hosts URLs/IP addresses
  $http_hosts = array(
    'localhost',
    '127.0.0.1',
    '10.0.2.2',
    '.dev',
  );

  /**
   * Allows for filtering of the possible HTTP hosts.
   * Accepts name/IP like localhost/127.0.0.1 or a domain such as .dev.
   *
   * @since  Kindling 0.1.0
   *
   * @param  hosts  The possible HTTP hosts to check against.
   */
  $http_hosts = apply_filters( 'mdg_is_localhost_http_hosts', $http_hosts );

  return $this->check_hosts( $http_hosts );
} // is_localhost()



/**
 * Checks if the current host is a staging site.
 *
 * @since   Kindling 0.1.0
 *
 * @return  boolean  If the current host is a staging site.
 */
function is_staging() {
  $http_hosts = array(
    '.staging.',
    'dev.',
  );

  /**
   * Allows for filtering of the possible HTTP hosts.
   * Accepts name/IP like localhost/127.0.0.1 or a domain such as .dev.
   *
   * @since  Kindling 0.1.0
   *
   * @param  hosts  The possible HTTP hosts to check against.
   */
  $http_hosts = apply_filters( 'mdg_is_staging_http_hosts', $http_hosts );

  return check_hosts( $http_hosts );
} // is_staging()
