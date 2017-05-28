<?php
/**
 * Theme Custom Functions.
 *
 * @package Kindling
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

use Roots\Sage\Assets\JsonManifest;

/**
 * Gets a files asset path.
 *
 * @param  string $filename the asset filename.
 *
 * @return string
 */
function kindling_asset_path($filename)
{
    $dist_path = get_template_directory_uri() . '/dist/';
    $directory = dirname($filename) . '/';
    $file = basename($filename);
    static $manifest;

    if (empty($manifest)) {
        $manifest_path = get_template_directory() . '/dist/' . 'assets.json';
        $manifest = new JsonManifest($manifest_path);
    }

    if (array_key_exists($file, $manifest->get())) {
        return $dist_path . $directory . $manifest->get()[$file];
    } else {
        return $dist_path . $directory . $file;
    }
}

/**
 * Retrieves a template from /templates.
 *
 * @since  Kindling 1.0.2
 *
 * @param  string  $path The path to the file in the templates directory.
 * @param  array   $data Optional, Data to pass through to the template. Default none.
 * @param  boolean $once Optional, if the template should be included once. Default false.
 */
function kindling_template($path, $data = [], $once = false)
{
    $path = ltrim( $path, 'templates' );
    $path = ltrim( $path, '/' );
    kindling_load_template_file( "templates/{$path}" );
}

/**
 * Loads a template file.
 *
 * @since  Kindling 1.0.2
 *
 * @param  string  $path The path to the file in the templates directory.
 * @param  array   $data Optional, Data to pass through to the template. Default none.
 * @param  boolean $once Optional, if the template should be included once. Default false.
 */
function kindling_load_template_file($path, $data = [], $once = false)
{
    $template = kindling_locate_template_file( "templates/{$path}" );
    if (! $template) {
        return;
    }

    // Allow access to data in the template files.
	// @codingStandardsIgnoreStart
	extract( $data );
	// @codingStandardsIgnoreEnd

    if ($once) {
        require_once $template;
    } else {
        require $template;
    }
}

/**
 * Locates a file in the template.
 * Defaults to the child theme if active and the template is available.
 *
 * @since  Kindling 1.0.2
 *
 * @param  string $path Path in the directory.
 *
 * @return string       The path to the template file.
 */
function kindling_locate_template_file($path)
{
    $path = trim( rtrim( $path, '.php' ), '/' );
    $file = get_stylesheet_directory() . "/{$path}.php";

    // Handle child theme files and themes without children.
    if (file_exists( $file )) {
        return $file;
    }

    // Handle child themes that do not overwrite the parent themes file.
    $file = get_template_directory() . "/{$path}.php";
    if (file_exists( $file )) {
        return $file;
    }

    return '';
}

/**
 * Page titles.
 */
function kindling_page_title()
{
    if (is_home()) {
        if (get_option( 'page_for_posts', true )) {
            return get_the_title( get_option( 'page_for_posts', true ) );
        } else {
            return __( 'Latest Posts', 'sage' );
        }
    } elseif (is_archive()) {
        return get_the_archive_title();
    } elseif (is_search()) {
        return sprintf( __( 'Search Results for %s', 'sage' ), get_search_query() );
    } elseif (is_404()) {
        return __( 'Not Found', 'sage' );
    } else {
        return get_the_title();
    }
}

/**
 * Determine which pages should NOT display the sidebar
 */
function kindling_display_sidebar()
{
    static $display;

    isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_front_page(),
    is_page_template('template-custom.php'),
    ]);

    return apply_filters('sage/display_sidebar', $display);
}
