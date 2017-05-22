<?php
/**
 * Kindling debug/development.
 *
 * @package     WordPress
 * @subpackage  Kindling
 * @since       Kindling 1.0.0
 */

/**
 * Checks the current host against the supplied hosts.
 *
 * @param   array $http_hosts  The possible hosts to check against.
 *
 * @return  boolean               True if the current host matches any of the supplied hosts, false if not.
 */
function mdg_check_hosts( $http_hosts = array() ) {
	$http_host = sanitize_text_field( $_SERVER['HTTP_HOST'] ); // Input var ok.

	// Check the possible HTTP hosts against the current HTTP host.
	if ( in_array( $http_host, $http_hosts ) ) {
		return true;
	} // if()

	// Check the possible HTTP hosts against the current HTTP host.
	foreach ( $http_hosts as $host ) {
		if ( false !== strpos( $http_host, $host ) ) {
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
	// Default possible HTTP hosts URLs/IP addresses.
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
	* @param  hosts  The possible HTTP hosts to check against.
	*/
	$http_hosts = apply_filters( 'mdg_mdg_is_staging_http_hosts', $http_hosts );

	return mdg_check_hosts( $http_hosts );
} // mdg_is_staging()


/**
 * Enables Jetpack devleopment mode.
 *
 * @param boolean $enabled If Jetpack is currently enabled.
 */
function mdg_enable_jetpack_development_mode( $enabled ) {
	if ( mdg_is_localhost() ) {
		return true;
	} // if()

	return $enabled;
} // mdg_enable_jetpack_development_mode()
add_filter( 'jetpack_development_mode', 'mdg_enable_jetpack_development_mode' );



if ( ! function_exists( 'pp' ) ) {
	/**
	 * Pretty Print Debug Function
	 *
	 * <code>
	 * pp( $something_to_pretty_print );
	 * </code>
	 *
	 * @todo  Add localhost check.
	 *
	 * @param mixed $value Any value.
	 */
	function pp( $value ) {
		if ( !mdg_is_localhost() ) {
			return;
		}

		echo '<pre>';
		if ( is_string( $value) or is_bool( $value ) or is_null( $value ) ) {
			var_dump( $value );
		} else {
			print_r( $value );
		} // if/else()
		echo '</pre>';
	} // pp()
} // if()

if ( ! function_exists( 'dd' ) ) {
	/**
	 * Pretty Print Debug and Die
	 *
	 * <code>
	 * dd( $something_to_pretty_print );
	 * </code>
	 *
	 * @todo  Add localhost check.
	 *
	 * @param mixed $value Any value.
	 */
	function dd( $value ) {
		pp( $value );
		die();
	} // dd()
} // if()

/**
 * Prints a filter/action for a hook.
 *
 * @param  string $hook
 */
function print_hooks_for($hook)
{
    pp(get_filters_for($hook));
}

/**
 * Gets a filter/action for a hook.
 *
 * @param string $hook
 */
function get_hooks_for($hook)
{
    global $wp_filter;

    return isset($wp_filter[ $hook ]) ? $wp_filter[ $hook ] : '';
}
