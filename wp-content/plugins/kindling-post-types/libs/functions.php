<?php
/**
 * Kindling Post Type Functions.
 *
 * @package Kindling_Post_Types
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

/**
 * Get all post type class instances.
 *
 * @return Illuminate\Support\Collection
 */
function kpt_get_types()
{
    global $kptTypes;

    return isset($kptTypes) ? $kptTypes : collect([]);
}

/**
 * Get an individual post type class instance.
 *
 * @param  string $type
 *
 * @return object|null
 */
function kpt_get_type($type)
{
    return kpt_get_types()->get($type);
}

/**
 * Gets the fully name spaced post type classes.
 *
 * @return Illuminate\Support\Collection
 */
function kpt_get_type_classes()
{
    return collect(apply_filters('kpt_type_classes', [
        // 'Kindling\PostTypes\Type\Stub',
        'Kindling\PostTypes\Type\Post',
        'Kindling\PostTypes\Type\Page',
    ]));
}
