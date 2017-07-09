<?php
/**
 * Kindling Blade Filters.
 *
 * @package Kindling_Blade
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", function ($templates) {
        return collect($templates)->flatMap(function ($template) {
            $transforms = [
                '%^/?(resources[\\/]views)?[\\/]?%' => '',
                '%(\.blade)?(\.php)?$%' => ''
            ];
            $normalizedTemplate = preg_replace(array_keys($transforms), array_values($transforms), $template);
            return ["{$normalizedTemplate}.blade.php", "{$normalizedTemplate}.php"];
        })->toArray();
    });
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("kindling/template/{$class}/data", $data, $template);
    }, []);
    echo view($template, $data);
    // Return a blank file to make WordPress happy
    return get_theme_file_path('index.php');
}, PHP_INT_MAX);
