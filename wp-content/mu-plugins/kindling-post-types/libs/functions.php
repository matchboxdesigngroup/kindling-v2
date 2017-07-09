<?php
/**
 * Kindling Post Type Functions.
 *
 * @package Kindling_Post_Types
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

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
    ]))->unique();
}
