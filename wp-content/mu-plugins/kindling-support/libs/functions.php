<?php
/**
 * Kindling Support Functions.
 *
 * @package Kindling_Blade
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

use Kindling\Support\Container;
use Illuminate\Contracts\Container\Container as ContainerContract;

/**
 * Get the kindling container.
 *
 * @param string $abstract
 * @param array  $parameters
 * @param ContainerContract $container
 * @return ContainerContract|mixed
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
function kindling($abstract = null, $parameters = [], ContainerContract $container = null)
{
    $container = $container ?: Container::getInstance();
    if (!$abstract) {
        return $container;
    }
    return $container->bound($abstract)
        ? $container->makeWith($abstract, $parameters)
        : $container->makeWith("kindling.{$abstract}", $parameters);
}

/**
 * Get / set the specified configuration value.
 *
 * If an array is passed as the key, we will assume you want to set an array of values.
 *
 * @param array|string $key
 * @param mixed $default
 * @return mixed|\Roots\Sage\Config
 * @copyright Taylor Otwell
 * @link https://github.com/laravel/framework/blob/c0970285/src/Illuminate/Foundation/helpers.php#L254-L265
 */
function config($key = null, $default = null)
{
    if (is_null($key)) {
        return kindling('config');
    }
    if (is_array($key)) {
        return kindling('config')->set($key);
    }

    return kindling('config')->get($key, $default);
}
