<?php
/**
 * Kindling Type Post Class.
 *
 * @package WordPress
 * @subpackage Kindling
 * @author       Matchbox Design Group <info@matchboxdesigngroup.com>
 */

/**
 * Handles anything custom for the default WordPress "post" post type.
 */
class MDG_Type_Post extends MDG_Type_Base {
	/**
	 * The slug of the post types landing post if not post type archive.
	 *
	 * @var  string
	 */
	public $landing_page_slug = '';

	/**
	 * The slug of the post types landing post template if not post type archive.
	 *
	 * @var  string
	 */
	public $landing_page_template = '';

	/**
	 * Class constructor, handles instantiation functionality for the class
	 */
	function __construct() {
		parent::__construct( 'post', 'Posts', 'Post' );
	} // __construct()
} // END Class MDG_Type_Post()

global $mdg_post;
if ( ! isset( $mdg_post ) ) {
	$mdg_post = new MDG_Type_Post();
}
