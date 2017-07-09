<?php
/**
 * Kindling Blade Actions.
 *
 * @package Kindling_Blade
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

use Kindling\Blade\Blade;
use Kindling\Blade\BladeProvider;
use Illuminate\Contracts\Container\Container as ContainerContract;

add_action('after_support_setup_theme', function () {
    /**
     * Add Blade to container
     */
    kindling()->singleton('kindling.blade', function (ContainerContract $app) {
        $cachePath = config('view.compiled');

        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }

        (new BladeProvider($app))->register();

        return new Blade($app['view'], $app);
    });
});
