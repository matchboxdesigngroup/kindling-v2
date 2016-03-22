<?php
/**
 * Post Table Image Column.
 *
 * @package WordPress
 */

/**
 * Adds the image column to the posts table.
 */
trait MDG_Post_Table_Image_Column {
	/**
	 * Column filter for featured image.
	 *
	 * @param string  $post_type Post type id.
	 * @param boolean $disable   Optional, if the image column should be disabled. Default false.
	 */
	public function add_image_column_action( $post_type, $disable = false ) {
		if ( $disable ) {
			return;
		} // if()

		$current_post_type = ( isset( $_GET['post_type'] ) ) ? sanitize_text_field( $_GET['post_type'] ) : ''; // Input var ok.
		if ( $current_post_type !== $post_type ) {
			return;
		}

		switch ( $post_type ) {
			case 'post':
				$manage_filter = 'manage_posts_columns';
				$custom_column = 'manage_posts_custom_column';
				break;
			case 'page':
				$manage_filter = 'manage_pages_columns';
				$custom_column = 'manage_pages_custom_column';
				break;
			default:
				$manage_filter = "manage_{$post_type}_posts_columns";
				$custom_column = "manage_{$post_type}_posts_custom_column";
				break;
		} // switch()

		add_filter( $manage_filter, array( &$this, 'add_thumbnail_column' ), 5 );
		add_action( $custom_column, array( &$this, 'display_thumbnail_column' ), 5, 2 );
	} // add_image_column_action()

	/**
	 * Adds the thumbnail image column.
	 *
	 * @param array $cols Current post table columns.
	 *
	 * @return array $cols The current columns with thumbnail column added.
	 */
	public function add_thumbnail_column( $cols ) {
		$post_type = ( isset( $_GET['post_type'] ) ) ? sanitize_text_field( $_GET['post_type'] ) : ''; // Input var ok.

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
	public function display_thumbnail_column( $col, $id ) {
		global $mdg_thumbnail_column_image_ids;

		// Check if we should display this image.
		$post_type         = get_post_type( $id );
		$column_image_ids  = ( isset( $mdg_thumbnail_column_image_ids ) ) ? $mdg_thumbnail_column_image_ids : array();
		$already_displayed = in_array( $id, $column_image_ids );
		$correct_column    = ( 'mdg_post_thumb' === $col );

		if ( $correct_column and ! $already_displayed ) {
			echo get_the_post_thumbnail( $id, 'admin-list-thumb' );
			$column_image_ids[] = $id;
		} // if()

		$mdg_thumbnail_column_image_ids = $column_image_ids;
	} // display_thumbnail_column()
}
