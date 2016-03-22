<?php
/**
 * SN Images Class.
 *
 * @package WordPress
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

/**
 * Handles adding custom image sizes and other global image related functionality.
 */
class MDG_Image_Sizes {
	/**
	 * The available image sizes.
	 *
	 * @since Snifter 1.0.0
	 *
	 * @var  array
	 */
	public $image_sizes = array();



	/**
	 * Class constructor
	 *
	 * @since Snifter 1.0.0
	 */
	public function __construct() {
		// Custom Image Sizes.
		$this->set_image_sizes();
		$this->register_sizes();
	} // __construct()

	/**
	 * Sets all of the custom image sizes.
	 */
	public function set_image_sizes() {
		// Featured image administrator column image size.
		$this->image_sizes[] = array(
			'title'   => 'admin-list-thumb', // The default will be widthxheight but any string can be used.
			'width'   => 100,
			'height'  => 100,
			'crop'    => true,
		);
	} // function set_image_sizes()

	/**
	 * Registers all of the new image sizes for use in our theme
	 *
	 * @since Snifter 1.0.0
	 *
	 * <code>
	 * $this->image_sizes[] = array(
	 *  'width'  => 220,
	 *  'height' => 130,
	 *  'title'  => '220x130',
	 *  'crop'   => true,
	 * );
	 * </code>
	 *
	 * @return  void
	 */
	public function register_sizes() {
		// First set the thumb size and make sure that this theme supports thumbs.
		if ( function_exists( 'add_theme_support' ) ) {
			add_theme_support( 'post-thumbnails' );
			set_post_thumbnail_size( 140, 140 ); // default Post Thumbnail dimensions
		} // if()

		// Now add the sizes.
		if ( function_exists( 'add_image_size' ) ) {
			foreach ( $this->image_sizes as $image_size ) {
				$width   = isset( $image_size['width'] ) ? $image_size['width'] : '';
				$height  = isset( $image_size['height'] ) ? $image_size['height'] : '';
				$title   = isset( $image_size['title'] ) ? $image_size['title'] : "{$width}x{$height}";
				$crop    = isset( $image_size['crop'] ) ? $image_size['crop'] : true;

				add_image_size( $title, $width, $height, $crop );
			}
		} // if()
	} // function register_sizes()
} // END Class MDG_Image_Sizes()

new MDG_Image_Sizes();
