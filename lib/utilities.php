<?php
/**
 * Kindling Generic Class.
 */

/**
 * Contains methods/properties that can be used by all classes.
 *
 * All classes should at the very minimum extend MDG_Utilities so they can
 * have easy access to all helper methods/properties.
 *
 * @package     WordPress
 * @subpackage  Kindling
 * @since       Kindling 1.0.0
 *
 * @author       Matchbox Design Group <info@matchboxdesigngroup.com>
 */
class MDG_Utilities {
	/**
	 * Checks the current host against the supplied hosts.
	 *
	 * @param   array $http_hosts  The possible hosts to check against.
	 *
	 * @return  boolean               True if the current host matches any of the supplied hosts, false if not.
	 */
	public function check_hosts( $http_hosts = array() ) {
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
	 * @since   Kindling 1.0.0
	 *
	 * @return  boolean  If the current HTTP host is localhost.
	 */
	public function is_localhost() {
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
		 * @since  Kindling  1.0.0
		 *
		 * @param  hosts  The possible HTTP hosts to check against.
		 */
		$http_hosts = apply_filters( 'sn_is_localhost_http_hosts', $http_hosts );

		return $this->check_hosts( $http_hosts );
	} // is_localhost()



	/**
	 * Checks if the current host is a staging site.
	 *
	 * @since   Kindling 1.0.0
	 *
	 * @return  boolean  If the current host is a staging site.
	 */
	public function is_staging() {
		$http_hosts = array(
			'staging.',
			'dev.',
		);

		/**
		 * Allows for filtering of the possible HTTP hosts.
		 * Accepts name/IP like localhost/127.0.0.1 or a domain such as .dev.
		 *
		 * @since  Kindling  1.0.0
		 *
		 * @param  hosts  The possible HTTP hosts to check against.
		 */
		$http_hosts = apply_filters( 'sn_is_staging_http_hosts', $http_hosts );

		return check_hosts( $http_hosts );
	} // is_staging()



	/**
	 * Sets a default value for a variable.
	 *
	 * @param   mixed $check_value    The value to check if it is set.
	 * @param   mixed $default_value  The default value to be used if $check_value has not already been set.
	 *
	 * @return  mixed                   The $check_value if it is set and the $default_value if not.
	 */
	public function set_default( $check_value, $default_value ) {
		return ( isset( $check_value ) ) ? $check_value : $default_value;
	} // set_default()



	/**
	 * Handles getting an excerpt by more tag and falls back to get_the_excerpt.
	 *
	 * @param  object  $post           Optional, WordPress post object to retrieve the content/excerpt from, default current post.
	 * @param  boolean $echo           Optional, if the excerpt should be echoed to the screen, default true.
	 * @param  integer $excerpt_length Optional, the word count for the excerpt, default 55.
	 * @param  string  $excerpt_more   Optional, the excerpt more text. Default empty string.
	 * @param  boolean $setup_postdata Optionaal, should setup_postdata() be used. Default true.
	 *
	 * @return string                  The "excerpt" content.
	 */
	public function more_content_excerpt( $post = null, $echo = true, $excerpt_length = null, $excerpt_more = '', $setup_postdata = true ) {
		$excerpt = '';

		// Get the global post if needed.
		if ( is_null( $post ) ) {
			global $post;
		} // if()

		// Setup the post data if needed.
		if ( $setup_postdata ) {
			setup_postdata( $post );
		} // if()

		$has_more_tag = ( strpos( $post->post_content, '<!--more-->' ) !== false );
		if ( $has_more_tag ) {
			global $more;
			$more    = 0;
			$excerpt = get_the_content( '' );
		} else {
			$excerpt = get_the_excerpt();

			if ( ! is_null( $excerpt_length ) and str_word_count( $excerpt ) > $excerpt_length ) {
				$excerpt = wp_trim_words( $excerpt, $excerpt_length, '' );
			} // if()

			// Add ellipsis for excerpts.
			$excerpt = ( trim( $excerpt ) == '' ) ? $excerpt : "{$excerpt}{$excerpt_more}";
		} // if()

		$excerpt = strip_shortcodes( $excerpt );
		$excerpt = trim( $excerpt );

		if ( $echo and $excerpt != '' ) {
			echo wp_kses( $excerpt, 'post' );
		} // if()

		// Reset the post data if needed.
		if ( $setup_postdata ) {
			wp_reset_postdata();
		} // if()

		return $excerpt;
	} // more_content_excerpt()
} // END Class MDG_Utilities()

global $mdg_utilities;
$mdg_utilities = new MDG_Utilities();
