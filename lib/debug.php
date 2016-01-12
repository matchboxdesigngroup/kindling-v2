<?php
/**
 * Kindling debug/development.
 *
 * @package     WordPress
 * @subpackage  Kindling
 * @since       Kindling 1.0.0
 */



/**
 * Enables Jetpack devleopment mode.
 *
 * @todo  Add localhost check.
 */
function mdg_enable_jetpack_development_mode( $enabled ) {
	global  $mdg_utilities;

	if ( $mdg_utilities->is_localhost() ) {
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
		global $mdg_utilities;

		$is_localhost = $mdg_utilities->is_localhost();
		if ( ! $is_localhost ) return;
		echo '<pre>';
		if ( gettype( $value ) === 'boolean' ) {
			var_dump( $value );
		} else {
			print_r( $value );
		} // if/else()
		echo '</pre>';
	} // pp()
} // if()