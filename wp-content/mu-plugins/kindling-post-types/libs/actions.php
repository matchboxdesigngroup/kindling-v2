<?php
/**
 * Kindling Post Type Actions.
 *
 * @package Kindling_Post_Types
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

/**
 * Register post types.
 * Add fully name spaced classes to `kpt_get_type_classes()` or use the kpt_type_classes filter.
 * All post classes must extend Kindling\PostTypes\Base see src/Type/Stub.php for an example.
 */
add_action('init', function () {
    global $kptTypes;

    $kptTypes = kpt_get_type_classes()->map(function ($class) {
        return class_exists($class) ? (new $class)->init() : false;
    })->filter(function ($item) {
        return $item;
    })->keyBy(function ($type) {
        return $type->postType;
    });
});
