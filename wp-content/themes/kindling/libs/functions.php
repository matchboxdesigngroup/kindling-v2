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
 * Retrieves a template from /templates.
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
 * Determine which pages should NOT display the sidebar
 */
function kindling_display_sidebar()
{
    static $display;

    // We very rarely use a sidebar so this can be removed and you can use the logic below.
    return false;

    isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_front_page(),
    is_page_template('template-custom.php'),
    ]);

    return apply_filters('kindling_display_sidebar', $display);
}

/**
 * Gets the path to the page template.
 *
 * @return string
 */
function kindling_template_path()
{
    return Kindling\Theme\ThemeWrapper::$main_template;
}

/**
 * Gets the path to the sidebar template.
 *
 * @return string
 */
function kindling_sidebar_path()
{
    return new Kindling\Theme\ThemeWrapper('templates/layouts/sidebar.php');
}

function view($path, $data = []) {
    extract($data);

    $path = ltrim($path, '/');
    $path = rtrim($path, '.php');

    //var_dump(file_exists(get_template_directory() . "/templates/{$path}.php"));
    include get_template_directory() . "/templates/{$path}.php";
}
