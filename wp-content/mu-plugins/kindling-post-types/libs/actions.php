<?php
/**
 * Kindling Post Type Actions.
 *
 * @package Kindling_Post_Types
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

use Illuminate\Contracts\Container\Container as ContainerContract;

/**
 * Register post types.
 * Add fully name spaced classes to `kpt_get_type_classes()` or use the kpt_type_classes filter.
 * All post classes must extend Kindling\PostTypes\Base see src/Type/Stub.php for an example.
 */
add_action('init', function () {
    kpt_get_type_classes()->each(function ($class) {
        if (!class_exists($class)) {
            return false;
        }

        // Add the post type to the container.
        $abstract = explode('\\', $class);
        $abstract = 'type.' . end($abstract);
        kindling()->singleton($abstract, function (ContainerContract $app) use ($class) {
            $class = new $class;

            $class->init();

            return $class;
        });

        // Resolve the post type out of the container to initialize it.
        kindling($abstract);
    });
});
