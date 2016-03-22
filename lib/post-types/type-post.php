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
		/**
		 * REQUIRED slug for post type.
		 *
		 * @var string
		 */
		$this->post_type = 'post';

		/**
		 * REQUIRED title of post type.
		 *
		 * @var string
		 */
		$this->post_type_title = 'Posts';

		/**
		 * REQUIRED singular title.
		 *
		 * @var string
		 */
		$this->post_type_single = 'Post';

		parent::__construct();
	} // __construct()

	/**
	 * Disables creating post type since post is a default post type.
	 */
	public function register_post_type() {}
} // END Class MDG_Type_Post()

global $mdg_page;
$mdg_page = new MDG_Type_Post();
