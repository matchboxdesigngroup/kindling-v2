<?php
/**
 * Kindling Development Filters.
 *
 * @package Kindling_Development
 */

/**
 * Enables Jetpack development mode.
 *
 * @param boolean $enabled If Jetpack is currently enabled.
 */
add_filter('jetpack_development_mode', function ($enabled) {
    if (kdev_is_localhost()) {
        return true;
    } // if()

    return $enabled;
});
