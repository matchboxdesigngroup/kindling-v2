<?php
/**
 * Theme Functions.
 * Include all files in libs/loader.php
 *
 * @package Kindling_Theme
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

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
        $manifest = new Kindling\Theme\Assets\JsonManifest($manifest_path);
    }

    if (array_key_exists($file, $manifest->get())) {
        return $dist_path . $directory . $manifest->get()[$file];
    } else {
        return $dist_path . $directory . $file;
    }
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
            return __( 'Latest Posts', 'kindling' );
        }
    } elseif (is_archive()) {
        return get_the_archive_title();
    } elseif (is_search()) {
        return sprintf( __( 'Search Results for %s', 'kindling' ), get_search_query() );
    } elseif (is_404()) {
        return __( 'Not Found', 'kindling' );
    } else {
        return get_the_title();
    }
}

/**
 * Determine whether to show the sidebar
 * @return bool
 */
function kindling_display_sidebar()
{
    static $display;
    isset($display) || $display = apply_filters('kindling/display_sidebar', false);
    return $display;
}
