<?php
/**
 * Theme includes
 *
 * @link https://github.com/roots/sage/pull/1042
 * @package WordPress
 */

$themeIncludes = [
    'setup.php', // Theme setup.
    'customizer.php', // Theme customizer.
    'shortcodes.php', // Shortcodes.
    'actions.php', // Theme Actions.
    'filters.php', // Theme Filters.
];


foreach ($themeIncludes as $file) {
    $filepath = __dir__ . "/{$file}";
    if (! file_exists($filepath)) {
        trigger_error(sprintf(__('Error locating %s for inclusion', 'kindling'), $file), E_USER_ERROR);
    }

    require_once $filepath;
}
unset($file, $filepath);
