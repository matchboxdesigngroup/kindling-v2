<?php
/**
 * Image Sizes Class.
 *
 * @package Kindling
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

namespace Kindling;

/**
 * Handles adding custom image sizes and other global image related functionality.
 */
class ImageSizes {
	/**
	 * The available image sizes.
	 *
	 * @since Kindling 1.0.2
	 *
	 * @var  array
	 */
	public static $image_sizes = array();

	/**
	 * Sets all of the custom image sizes.
	 *
	 * @since Kindling 1.0.2
	 */
	public static function get_image_sizes() {
		$image_sizes = [];

		// Featured image administrator column image size.
		$image_sizes[] = array(
			'title' => 'admin-list-thumb', // The default will be widthxheight but any string can be used.
			'width' => 100,
			'height' => 100,
			'crop' => true,
			'disable_choose' => true,  // Disables the ability to be added to the size selector in the media manager.
		);

		return $image_sizes;
	}

	/**
	 * Registers all of the new image sizes for use in our theme
	 *
	 * @since Kindling 1.0.2
	 *
	 * <code>
	 * Self::image_sizes[] = array(
	 *  'width' => 220,
	 *  'height => 130,
	 *  'title' => '220x130',
	 *  'crop' => true,
	 *  'disable_choose' => false,
	 * );
	 * </code>
	 *
	 * @return  void
	 */
	public static function register() {
		// First set the thumb size and make sure that this theme supports thumbs.
		if ( function_exists( 'add_theme_support' ) ) {
			add_theme_support( 'post-thumbnails' );
			set_post_thumbnail_size( 140, 140 ); // Default Post Thumbnail dimensions.
		} // if()

		// Now add the sizes.
		$sizes = Self::get_image_sizes();
		Self::add_sizes( $sizes );
	}

	/**
	 * Ads the image sizes.
	 *
	 * @since Kindling 1.0.2
	 *
	 * @param array $sizes The image sizes to add.
	 */
	protected static function add_sizes($image_sizes)
	{
		if ( ! function_exists( 'add_image_size' ) ) {
			return;
		} // if()

		// Register the image sizes.
		foreach ( $image_sizes as $size ) {
			Self::add_size($size);
		}

		// Add the images to the media manager image size select.
		add_filter('image_size_names_choose', function($sizes) use ($image_sizes) {
			return array_merge( $sizes, Self::get_image_size_names_choose( $image_sizes ) );
		});
	}

	/**
	 * Adds an image size.
	 *
	 * @since Kindling 1.0.2
	 *
	 * @param array $size Image size to add.
	 */
	protected static function add_size($size)
	{
		$width = isset( $size['width'] ) ? $size['width'] : '';
		$height = isset( $size['height'] ) ? $size['height'] : '';
		$title = isset( $size['title'] ) ? $size['title'] : "{$width}x{$height}";
		$crop = isset( $size['crop'] ) ? $size['crop'] : true;

		add_image_size( $title, $width, $height, $crop );
	}

	/**
	 * Get the image sizes for the media manager size select.
	 *
	 * @since Kindling 1.0.2
	 *
	 * @param  array $size Image size to add.
	 *
	 * @return array       The image sizes for the media manager size select.
	 */
	protected static function get_image_size_names_choose($sizes)
	{
		$choose_sizes = [];

		foreach ( $sizes as $size ) {
			if ( isset( $size['disable_choose'] ) && (bool) $size['disable_choose'] ) {
				continue;
			}

			$width   = isset( $size['width'] ) ? $size['width'] : '';
			$height  = isset( $size['height'] ) ? $size['height'] : '';
			$title   = isset( $size['title'] ) ? $size['title'] : "{$width}x{$height}";
			$label = ucwords( str_replace( [ '-', '_' ], ' ', $title ) );
			$choose_sizes[ $title ] = $label;
		}

		return $choose_sizes;
	}
}
