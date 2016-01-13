<?php
/**
 * Kindling Type Base Class
 */

/**
 * This is a base for custom post type classes so they can all take advantage of the same logic for meta, transients etc.
 *
 * You should do your best not to overwrite any method and to use the
 * custom_[some_property] properties for configuring the base class methods which have parameters.
 * Feel free to over write any of the parameters you see fit to make the sub-classes
 * more versatile.  As with every rule there is in exception do not overwrite $meta_helper
 * unless you know what you are doing...which if your over writing it you probably do not.
 * Make sure to include the parameters marked as REQUIRED or else the class will
 * not work at all everything has sensible defaults.
 *
 * @package      WordPress
 * @subpackage   Kindling
 *
 * @author       Matchbox Design Group <info@matchboxdesigngroup.com>
 *
 * @example lib/post-types/type-stub.php
 */
class MDG_Type_Base {

	/**
	 * REQUIRED slug for post type.
	 *
	 * @var  string
	 */
	public $post_type;



	/**
	 * REQUIRED title of post type.
	 *
	 * @var  string
	 */
	public $post_type_title;



	/**
	 * REQUIRED singular title.
	 *
	 * @var  string
	 */
	public $post_type_single;



	/**
	 * Arguments to be used when registering the post type's taxonomy.
	 *
	 * @var  array
	 */
	private $_taxonomy_args;




	/**
	 * Arguments to be used when registering the post type.
	 *
	 * @var  array
	 */
	private $_post_type_args;



	/**
	 * What the post type supports.
	 *
	 * @var  array
	 */
	private $_post_type_supports;



	/**
	 * All of the transients for each post type, post type will be used as key.
	 *
	 * @var  string
	 */
	private $_transient_title_option = 'mdgTransientTitles';



	/**
	 * The transient expiry.
	 *
	 * @var  integer
	 */
	protected $transient_expiry;



	/**
	 * The post types custom labels used in register_post_type().
	 *
	 * @var  array
	 */
	public $custom_post_type_labels;



	/**
	 * Used to disable the addition of the featured image column.
	 *
	 * @var  boolean
	 */
	public $disable_image_column;



	/**
	 * Custom post type arguments used in register_post_type().
	 *
	 * @var  array
	 */
	public $custom_post_type_args;



	/**
	 * The taxonomy "name" used in register_taxonomy().
	 *
	 * @var  array
	 */
	public $taxonomy_name;



	/**
	 * Custom taxonomy labels used in register_taxonomy().
	 *
	 * @var  array
	 */
	public $custom_taxonomy_labels;



	/**
	 * Custom taxonomy arguments used in register_taxonomy().
	 *
	 * @var  array
	 */
	public $custom_taxonomy_args;



	/**
	 * Custom post type supports array used in register_post_type().
	 *
	 * @var  array
	 */
	public $custom_post_type_supports;



	/**
	 * Disable/Enable Categories per post type.
	 *
	 * @var  boolean
	 */
	public $disable_post_type_categories;



	/**
	 * Disable/Enable thumbnail post table column.
	 *
	 * @var  boolean
	 */
	public $disable_thumbnail_column;



	/**
	 * Class constructor, takes care of all the setup needed
	 */
	public function __construct() {

		// First make sure the sub class has the required properties
		if ( ! $this->_passed_config_test() ) {
			return false; }

		$this->_set_parameters();
		$this->_type_base_add_actions();
		$this->init();
	} // __construct()
	


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
	 * Sets all of the classes parameters
	 *
	 * @todo Make this cleaner
	 */
	private function _set_parameters() {
		// Taxonomy Properties
		$this->_taxonomy_args         = $this->set_default( $this->_taxonomy_args, array() );
		$this->custom_taxonomy_labels = $this->set_default( $this->custom_taxonomy_labels, array() );
		$this->custom_taxonomy_args   = $this->set_default( $this->custom_taxonomy_args, array() );
		$this->taxonomy_name          = $this->set_default( $this->taxonomy_name, "{$this->post_type}-categories" );
		$this->set_taxonomy_args( $this->custom_taxonomy_args );
		$this->disable_post_type_categories = $this->set_default( $this->disable_post_type_categories, false );

		// Post Type
		$this->_post_type_args           = $this->set_default( $this->_post_type_args, array() );
		$this->custom_post_type_args     = $this->set_default( $this->custom_post_type_args, array() );
		$this->custom_post_type_labels   = $this->set_default( $this->custom_post_type_labels, array() );
		$this->custom_post_type_supports = $this->set_default( $this->custom_post_type_supports, array() );
		$this->set_post_type_supports( $this->custom_post_type_supports );
		$this->set_post_type_args( $this->custom_post_type_args );

		// General
		$this->disable_image_column = $this->set_default( $this->disable_image_column, false );
		$this->transient_expiry     = $this->set_default( $this->transient_expiry, ( 3 * HOUR_IN_SECONDS ) );
	} // _set_parameters()



	/**
	 * This method runs after __construct() just a way for sub classes to run custom
	 * initialization stuff while still inheriting the constructor from this class.
	 */
	public function init() {
		// Overwrite/Extend in Sub-classes do not add anything here!
		// Use __constructor() or another method in __constructor().
	} // init()



	/**
	 * Actions that need to be set for this base class only using add_action()
	 * sub-classes will need to set there own actions without overriding this method.
	 */
	private function _type_base_add_actions() {
		// Enable "Links" post type
		// add_filter( 'pre_option_link_manager_enabled', '__return_true' );
		// hook to create post_type
		add_action( 'init', array( &$this, 'register_post_type' ) );

		// hook into save post to reset cache
		add_action( 'save_post', array( &$this, 'reset_transient' ) );

		// featured image column action
		$this->_add_image_column_action();
	} // _type_base_add_actions()



	/**
	 * Checks if the current post type is the correct post type.
	 *
	 * @param  string  $post_type   The post type name to check against
	 * @param  boolean $admin_only  Optional, if it should only check in the admin, default tue.
	 *
	 * @return boolean If the post type is correct.
	 */
	public function is_current_post_type( $post_type = null, $admin_only = true ) {
		global $post;
		$post_type = ( is_null( $post_type ) ) ? $this->post_type : $post_type;

		if ( is_admin() ) {
			$screen = get_current_screen();
			if ( isset( $screen ) and $post_type == $screen->post_type ) {
				return true;
			} // if()
		} // if()

		if ( ! $admin_only and isset( $post ) and $post->post_type == $post_type ) {
			return true;
		} // if()

		return false;
	} // is_current_post_type()



	/**
	 * All of the allowed tags when outputting meta form fields.
	 *
	 * @uses http://codex.wordpress.org/Function_Reference/wp_kses_allowed_html
	 *
	 * @param string $context  The context to retrieve the tags in.
	 *
	 * @return array Allowed HTML tags.
	 */
	private function get_allowed_tags( $context = 'post' ) {
		$allowed_tags          = wp_kses_allowed_html( $context );
		$allowed_tags['<hr>']  = array();
		$allowed_tags['input'] = array(
			'type'        => array(),
			'name'        => array(),
			'id'          => array(),
			'value'       => array(),
			'size'        => array(),
			'class'       => array(),
			'placeholder' => array(),
			'checked'     => array(),
		);
		$allowed_tags['option'] = array(
			'value'    => array(),
			'selected' => array(),
		);
		$allowed_tags['select'] = array(
			'name'     => array(),
			'id'       => array(),
			'class'    => array(),
			'style'    => array(),
			'multiple' => array(),
		);
		$allowed_tags['span'] = array(
			'class' => array(),
			'id'    => array(),
		);
		$allowed_tags['textarea'] = array(
			'name'        => array(),
			'id'          => array(),
			'cols'        => array(),
			'rows'        => array(),
			'class'       => array(),
		);
		return $allowed_tags;
	} // _get_meta_output_kses_allowed_html()



	/**
	 * Column filter for featured image.
	 */
	private function _add_image_column_action() {
		if ( $this->disable_image_column ) {
			return;
		} // if()

		switch ( $this->post_type ) {
			case 'post':
				$manage_filter = 'manage_posts_columns';
				$custom_column = 'manage_posts_custom_column';
				break;
			case 'page':
				$manage_filter = 'manage_pages_columns';
				$custom_column = 'manage_pages_custom_column';
				break;
			default:
				$manage_filter = "manage_{$this->post_type}_posts_columns";
				$custom_column = "manage_{$this->post_type}_posts_custom_column";
				break;
		} // switch()

		add_filter( $manage_filter, array( &$this, 'add_thumbnail_column' ), 5 );
		add_action( $custom_column, array( &$this, 'display_thumbnail_column' ), 5, 2 );
	} // _add_image_column_action()



	/**
	 * Adds the thumbnail image column.
	 *
	 * @param array $cols Current post table columns.
	 *
	 * @return array $cols The current columns with thumbnail column added.
	 */
	function add_thumbnail_column( $cols ) {
		// Make sure the image column has not been disabled.
		if ( $this->disable_image_column ) {
			return $cols;
		} // if()

		// Get the current post type.
		$post_type = ( isset( $_GET['post_type'] ) ) ? $_GET['post_type'] : '';
		if ( '' === $post_type ) {
			return $cols;
		} // if()

		// Make sure this is the correct post type.
		if ( ! $this->is_current_post_type( $post_type ) ) {
			return $cols;
		} // if()

		// Make sure the post supports thumbnails.
		if ( ! post_type_supports( $post_type, 'thumbnail' ) ) {
			return $cols;
		} // if()

		// Get the post type object.
		$post_type_obj = get_post_type_object( $post_type );
		if ( is_null( $post_type_obj ) ) {
			return $cols;
		} // if()

		// Set the column.
		$featured_image_label  = ( isset( $post_type_obj->labels->featured_image ) ) ? $post_type_obj->labels->featured_image : 'Featured Image';
		$cols['mdg_post_thumb'] = __( $featured_image_label );

		return $cols;
	} // add_thumbnail_column()



	/**
	 * Grab featured-thumbnail size post thumbnail and display it.
	 *
	 * @param array   $col  Current post table columns.
	 * @param integer $id   The current post ID..
	 */
	function display_thumbnail_column( $col, $id ) {
		global $mdg_thumbnail_column_image_ids;

		// Check if we should display this image
		$post_type         = get_post_type( $id );
		$column_image_ids  = ( isset( $mdg_thumbnail_column_image_ids ) ) ? $mdg_thumbnail_column_image_ids : array();
		$already_displayed = in_array( $id, $column_image_ids );
		$correct_column    = ( $col == 'mdg_post_thumb' );
		$correct_post_type = $this->is_current_post_type( $post_type );

		if ( $correct_column and $correct_post_type and ! $already_displayed ) {
			echo get_the_post_thumbnail( $id, 'admin-list-thumb' );
			$column_image_ids[] = $id;
		} // if()

		$mdg_thumbnail_column_image_ids = $column_image_ids;
	} // display_thumbnail_column()



	/**
	 * Checks to make sure that the required properties are set or
	 * the class will halt and produce a warning instead of throwing an
	 * error.
	 *
	 * @return bool If all required properties are set TRUE is returned
	 */
	private function _passed_config_test() {
		if ( ! is_subclass_of( $this, 'MDG_Type_Base' ) ) {
			return false; }

		$errors = array();
		$required_properties = array(
			'post_type'        => $this->post_type,
			'post_type_title'  => $this->post_type_title,
			'post_type_single' => $this->post_type_single,
		);

		foreach ( $required_properties as $property_name => $property ) {
			if ( is_null( $property ) ) {
				$errors[] = "Property {$property_name} has not been set in your sub-class.\n"; }
		} // foreach()

		if ( empty( $errors ) ) {
			return true;
		} else {
			foreach ( $errors as $error ) {
				echo esc_html( $error ); }
		} // if/each()

		return false;
	} // _passed_config_test()



	/**
	 * Sets the Post Type support array
	 *
	 * @link https://codex.wordpress.org/Function_Reference/post_type_supports
	 *
	 * @param array $custom_post_type_supports  What the current post type should support.
	 *
	 * @return                                   Void
	 */
	public function set_post_type_supports( $custom_post_type_supports ) {
		$default_post_type_supports = array(
			'title',
			'editor',
			'post-thumbnails',
			'custom-fields',
			'page-attributes',
			'author',
			'thumbnail',
			'excerpt',
			'trackbacks',
			'comments',
			'revisions',
			'post-formats',
		);

		if ( $custom_post_type_supports === false ) {
			$this->_post_type_supports = array( 'title' );
		} elseif ( ! empty( $custom_post_type_supports ) ) {
			$this->_post_type_supports = $custom_post_type_supports;
		} else {
			$this->_post_type_supports = $default_post_type_supports;
		} // if()
	} // set_post_type_supports()



	/**
	 * Registers the post type and a custom taxonomy for the post type..
	 */
	public function register_post_type() {
		// make sure the post type info is set - none of this will work without it!
		if ( is_null( $this->post_type ) or is_null( $this->post_type_title ) or is_null( $this->post_type_single ) ) {
			return false; }

		// Register post type
		register_post_type( $this->post_type, $this->_post_type_args );

		// Register taxonomy for post type
		if ( ! $this->disable_post_type_categories ) {
			register_taxonomy(
				$this->taxonomy_name,
				array( $this->post_type ),
				$this->_taxonomy_args
			);
		} // if()
	} // register_post_type()



	/**
	 * Sets the arguments used for registering the post type with register_post_type()
	 *
	 * @param  array $custom_post_type_args Optional. Anything acceptable in the $args parameter for register_post_type() http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	public function set_post_type_args( $custom_post_type_args = array() ) {
		$lowercase_post_type_title  = strtolower( $this->post_type_title );
		$lowercase_post_type_single = strtolower( $this->post_type_single );
		$default_post_type_labels   = array(
			'name'                  => __( $this->post_type_title ),
			'singular_name'         => __( $this->post_type_single ),
			'add_new'               => __( "Add New {$this->post_type_single}" ),
			'add_new_item'          => __( "Add New {$this->post_type_single}" ),
			'edit_item'             => __( "Edit {$this->post_type_single}" ),
			'new_item'              => __( "New {$this->post_type_single}" ),
			'all_items'             => __( "All {$this->post_type_title}" ),
			'view_item'             => __( "View {$this->post_type_single}" ),
			'search_items'          => __( "Search {$this->post_type_title}" ),
			'not_found'             => __( "No {$lowercase_post_type_title} found" ),
			'not_found_in_trash'    => __( "No {$lowercase_post_type_title} found in Trash" ),
			'parent_item_colon'     => __( '' ),
			'menu_name'             => __( $this->post_type_title ),
			'featured_image'        => __( "{$this->post_type_single} Image" ),
			'set_featured_image'    => __( "Set {$lowercase_post_type_single} image" ),
			'remove_featured_image' => __( "Remove {$lowercase_post_type_single} image" ),
			'use_featured_image'    => __( "Use as {$lowercase_post_type_single} image" ),
		);

		$labels = array_merge( $default_post_type_labels, $this->custom_post_type_labels );
		$default_post_type_args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => $this->post_type, 'with_front' => false ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'menu_position'      => 5,
			'can_export'         => true,
			'supports'           => $this->_post_type_supports,
			'menu_icon'          => 'dashicons-edit',
		);

		$this->_post_type_args = array_merge( $default_post_type_args, $custom_post_type_args );
	} // set_post_type_args()



	/**
	 * Sets the taxonomy args when registering a taxonomy using register_taxonomy()
	 *
	 * @param array $custom_taxonomy_args Optional. Anything acceptable in the $args parameter for register_taxonomy() http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	public function set_taxonomy_args( $custom_taxonomy_args = array() ) {
		// Taxonomy labels
		$default_labels = array(
			'name'                       => _x( "{$this->post_type_single} Categories", 'taxonomy general name' ),
			'singular_name'              => _x( "{$this->post_type_single} Category", 'taxonomy singular name' ),
			'search_items'               => __( "Search {$this->post_type_single} Categories" ),
			'all_items'                  => __( "All {$this->post_type_single} Categories" ),
			'parent_item'                => __( "Parent {$this->post_type_single} Category" ),
			'parent_item_colon'          => __( "Parent {$this->post_type_single} Category:" ),
			'edit_item'                  => __( "Edit {$this->post_type_single} Category" ),
			'update_item'                => __( "Update {$this->post_type_single} Category" ),
			'add_new_item'               => __( "Add New {$this->post_type_single} Category" ),
			'new_item_name'              => __( "New {$this->post_type_single} Category Name" ),
			'menu_name'                  => __( "{$this->post_type_single} Categories" ),
			'view_item'                  => __( "View {$this->post_type_single} Category" ),
			'popular_items'              => __( "Popular {$this->post_type_single} Categories" ),
			'separate_items_with_commas' => __( "Separate {$this->post_type_single} Categories with commas" ),
			'add_or_remove_items'        => __( "Add or remove  {$this->post_type_single} Categories" ),
			'choose_from_most_used'      => __( "Choose from the most used {$this->post_type_single} Categories" ),
			'not_found'                  => __( "No  {$this->post_type_single} Categories found." ),
		);
		$labels = array_merge( $default_labels, $this->custom_taxonomy_labels );

		// Register taxonomy
		$default_taxonomy_args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'show_admin_column' => true,
			'query_var'         => $this->taxonomy_name,
			'rewrite'           => array(
				'slug'         => $this->post_type,
				'with_front'   => false,
				'hierarchical' => true,
			),
		);

		$this->_taxonomy_args = array_merge( $default_taxonomy_args, $custom_taxonomy_args );
	} // set_taxonomy_args()



	/**
	 * Retrieves the current post types posts.
	 *
	 * @param  array   $custom_query_args  Optional. Any arguments accepted by the WP_Query class http://codex.wordpress.org/Class_Reference/WP_Query
	 * @param  boolean $query_object       Optional. If true it will return the WP_Query object instead of posts.
	 *
	 * @return array                          Retrieved post objects/Query object.
	 */
	public function get_posts( $custom_query_args = array(), $query_object = false ) {
		$default_query_args = array(
			'post_type'      => $this->post_type,
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'order'          => 'DESC',
			'orderby'        => 'date',
		);
		$query_args = array_merge( $default_query_args, $custom_query_args );
		$query      = new WP_Query( $query_args );
		$posts      = $query->get_posts();

		if ( $query_object ) {
			return $query;
		} // if()

		return $posts;
	} // get_posts()



	/**
	 * Resets the transient data by deleting the transient data.
	 */
	public function reset_transient() {
		$transient_type = $this->_get_all_cached_attachment_transient_ids();

		if ( isset( $transient_type ) and gettype( $transient_type ) ) {
			foreach ( $transient_type as $title ) {
				delete_transient( $title );
			} // foreach()
		} // if()
	} // reset_transient()


	/**
	 * Sets the custom transient title.
	 *
	 * @param  array $query_args   The query arguments for WP_Query.
	 *
	 * @return string             Custom transient value.
	 */
	private function _custom_transient_title( $query_args ) {
		$flattened_array = array();

		$flatten_array = array_walk_recursive( $query_args, function( $key, $value) use (&$flattened_array) { $flattened_array[$key] = $value;
		} );
		$keys          = implode( '', array_keys( $flattened_array ) );
		$values        = implode( '' , $flattened_array );
		$transient_id  = md5( "{$keys}{$values}" );
		$transient_id  = "_mdg{$transient_id}";

		return $transient_id;
	} // _custom_transient_title()



	/**
	 * Retrieves all of the current transient IDs.
	 *
	 * <code>$this->_get_all_cached_attachment_transient_ids();</code>
	 *
	 * @param   string $prefix  Optional, the transient id prefix to search for default _mdg.
	 *
	 * @return  array            All of the current transient IDs.
	 */
	private function _get_all_cached_attachment_transient_ids( $prefix = '_mdg' ) {
		global $wpdb;
		$sql = "SELECT `option_name` AS `name`, `option_value` AS `value`
						FROM  $wpdb->options
						WHERE `option_name` LIKE '%transient_%'
						ORDER BY `option_name`";

		$results = $wpdb->get_results( $sql );

		// Find the transient IDs with the supplied prefix.
		$transients = array();
		foreach ( $results as $result ) {
			if ( strpos( $result->name, "_transient_{$prefix}" ) !== false ) {
				$transient_id = str_replace( '_transient_', '', $result->name );
				$transients[] = $transient_id;
			} // if()
		} // foreach()

		return array_unique( $transients );
	} // _get_all_cached_attachment_transient_ids()



	/**
	 * Gets the attachments for a post.
	 *
	 * @link http://codex.wordpress.org/Class_Reference/WP_Query
	 *
	 * @param   integer $post_id             Optional, post id defaults to current post.
	 * @param   array   $custom_query_args   Optional, custom query arguments excepts anything WP_Query does.
	 * @param   boolean $only_images         Optional, only return images.
	 * @param   array   $allowed_file_types  Optional, restricts allowed file types.
	 *
	 * @return array                           The attachments for the post.
	 */
	function get_attachments( $post_id = null, $custom_query_args = array(), $only_images = true, $allowed_file_types = array() ) {
		if ( is_null( $post_id ) ) {
			global $post;
			$post_id = $post->ID;
		} // if()

		$default_query_args = array(
			'post_type'   => 'attachment',
			'post_status' => 'inherit',
			'post_parent' => $post_id,
			'order'       => 'DESC',
			'orderby'     => 'menu_order',
		);
		$query_args  = array_merge( $default_query_args, $custom_query_args );
		$attachments = $this->get_posts( $query_args );

		// Removes all attachments that are not an image
		if ( $only_images ) {
			foreach ( $attachments as $key => $attachment ) {
				if ( ! wp_attachment_is_image( $attachment->ID ) ) {
					unset( $attachments[$key] );
				} // if()
			} // foreach()
		} // if()

		// Removes all attachments that not allowed file types
		if ( ! empty( $allowed_file_types ) ) {
			foreach ( $attachments as $key => $attachment ) {
				$pathinfo = pathinfo( wp_get_attachment_url( $attachment->ID ) );
				extract( $pathinfo );
				if ( ! in_array( $extension, $allowed_file_types ) ) {
					unset( $attachments[$key] );
				} // if()
			} // foreach()
		} // if()

		return $attachments;
	} // get_attachments()



	/**
	 * Retrieves posts that have featured images.
	 *
	 * @link http://codex.wordpress.org/Class_Reference/WP_Query
	 *
	 * @param   array $custom_query_args   Optional, custom query arguments excepts anything WP_Query does.
	 *
	 * @return Retrieved post objects.
	 */
	public function get_posts_with_featured_image( $custom_query_args = array() ) {
		$default_query_args = array( 'meta_key' => '_thumbnail_id' );
		$query_args = array_merge( $default_query_args, $custom_query_args );

		return $this->get_posts( $query_args );
	} // get_posts_with_featured_image()
} // END Class MDG_Type_Base()