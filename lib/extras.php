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
 * Checks the current host against the supplied hosts.
 *
 * @param   array $http_hosts  The possible hosts to check against.
 *
 * @return  boolean               True if the current host matches any of the supplied hosts, false if not.
 */
function mdg_check_hosts( $http_hosts = array() ) {
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
} // mdg_check_hosts()



/**
 * Checks if the current HTTP host is localhost.
 * Default possible HTTP hosts http://localhost, 127.0.0.1, 10.0.0.2, http://*.dev.
 *
 * <code>
 * if ( mdg_is_localhost() ) {
 *  // Do something localhost specific...
 * } // if()
 * </code
 *
 * @since   Kindling 0.1.0
 *
 * @return  boolean  If the current HTTP host is localhost.
 */
function mdg_is_localhost() {
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
  $http_hosts = apply_filters( 'mdg_mdg_is_localhost_http_hosts', $http_hosts );

  return mdg_check_hosts( $http_hosts );
} // mdg_is_localhost()



/**
 * Checks if the current host is a staging site.
 *
 * @since   Kindling 0.1.0
 *
 * @return  boolean  If the current host is a staging site.
 */
function mdg_is_staging() {
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
  $http_hosts = apply_filters( 'mdg_mdg_is_staging_http_hosts', $http_hosts );

  return mdg_check_hosts( $http_hosts );
} // mdg_is_staging()
