<?php
/**
 * Kindling Support Functions.
 *
 * @package Kindling_Blade
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

/**
 * Setup base configuration.
 */
add_action('after_setup_theme', function () {
    $paths = [
        'dir.stylesheet' => get_stylesheet_directory(),
        'dir.template'   => get_template_directory(),
        'dir.upload'     => wp_upload_dir()['basedir'],
        'uri.stylesheet' => get_stylesheet_directory_uri(),
        'uri.template'   => get_template_directory_uri(),
    ];
    $viewPaths = collect(preg_replace('%[\/]?(resources/views)?[\/.]*?$%', '', [STYLESHEETPATH, TEMPLATEPATH]))
        ->flatMap(function ($path) {
            return ["{$path}/resources/views", $path];
        })->unique()->toArray();

    config([
        'assets.manifest' => "{$paths['dir.stylesheet']}/../dist/assets.json",
        'assets.uri'      => "{$paths['uri.stylesheet']}/dist",
        'view.compiled'   => "{$paths['dir.upload']}/cache/compiled",
        'view.namespaces' => ['Kindling\Blade' => WP_CONTENT_DIR],
        'view.paths'      => $viewPaths,
    ] + $paths);

    do_action('after_support_setup_theme');
});
