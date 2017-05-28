<?php
/**
 * Theme includes
 *
 * @link https://github.com/roots/sage/pull/1042
 * @package WordPress
 */

$themeIncludes = [
    'lib/extras.php', // Custom functions.
    'lib/setup.php', // Theme setup.
    'lib/customizer.php', // Theme customizer.
    'lib/shortcodes.php', // Shortcodes.
    'lib/actions.php', // Theme Actions.
    'lib/filters.php', // Theme Filters.
];


foreach ($themeIncludes as $file) {
    $filepath = __dir__ . "/{$file}";
    if (! file_exists($filepath)) {
        trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
    }

    require_once $filepath;
}
unset($file, $filepath);
