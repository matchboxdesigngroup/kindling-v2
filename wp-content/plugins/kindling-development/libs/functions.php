<?php
/**
 * Kindling Development Functions.
 *
 * @package Kindling_Development
 */

/**
 * Checks the current host against the supplied hosts.
 *
 * @param   array $hosts  The possible hosts to check against.
 *
 * @return  boolean       True if the current host matches any of the supplied hosts, false if not.
 */
function kdev_check_hosts($hosts = [])
{
    $current = sanitize_text_field($_SERVER['HTTP_HOST']);

    // Check the possible HTTP hosts against the current HTTP host.
    if (in_array($current, $hosts)) {
        return true;
    } // if()

    // Check the possible HTTP hosts against the current HTTP host.
    foreach ($hosts as $host) {
        if (false !== strpos($current, $host)) {
            return true;
        } // if()
    } // foreach

    return false;
}

/**
 * Checks if the current HTTP host is localhost.
 * Default possible HTTP hosts http://localhost, 127.0.0.1, 10.0.0.2, http://*.dev.
 *
 * <code>
 * if (kdev_is_localhost()) {
 *  // Do something localhost specific...
 * } // if()
 * </code
 *
 * @return  boolean If the current HTTP host is localhost.
 */
function kdev_is_localhost()
{
    // Default possible HTTP hosts URLs/IP addresses.
    $hosts = [
        'localhost',
        '127.0.0.1',
        '10.0.2.2',
        '.dev',
    ];

    /**
    * Allows for filtering of the possible HTTP hosts.
    * Accepts name/IP like localhost/127.0.0.1 or a domain such as .dev.
    *
    * @param  hosts  The possible HTTP hosts to check against.
    */
    $hosts = apply_filters('kdev_is_localhost_http_hosts', $hosts);

    return kdev_check_hosts($hosts);
}

/**
 * Checks if the current host is a staging site.
 *
 * @return  boolean If the current host is a staging site.
 */
function kdev_is_staging()
{
    $hosts = [
        '.staging.',
        'dev.',
    ];

    /**
    * Allows for filtering of the possible HTTP hosts.
    * Accepts name/IP like localhost/127.0.0.1 or a domain such as .dev.
    *
    * @param  hosts  The possible HTTP hosts to check against.
    */
    $hosts = apply_filters('kdev_is_staging_http_hosts', $hosts);

    return kdev_check_hosts($hosts);
}

/**
 * Gets the environment type.
 *
 * @return string The environment type.
 */
function kdev_get_environment_type()
{
    if (kdev_is_localhost()) {
        return 'local';
    }

    if (kdev_is_staging()) {
        return 'staging';
    }

    return 'production';
}

/**
 * Checks if the current host is a production site.
 *
 * @return  boolean  If the current host is a production site.
 */
function kdev_is_production()
{
    return ('production' === kdev_get_environment_type());
}

if (!function_exists('pp')) {
    /**
     * Pretty Print Debug Function
     *
     * <code>
     * pp($value1, $value2,...);
     * </code>
     *
     * @todo  Add localhost check.
     *
     * @param mixed $value Any value.
     */
    function pp(...$values)
    {
        if (kdev_is_production()) {
            return;
        }

        foreach ($values as $value) {
            echo '<pre>';
            if (is_string($value) or is_bool($value) or is_null($value)) {
                var_dump($value);
            } else {
                print_r($value);
            }
            echo '</pre>';
        }
    } // pp()
} // if()

if (! function_exists('dd')) {
    /**
     * Pretty Print Debug and Die
     *
     * <code>
     * dd($value1, $value2,...);
     * </code>
     *
     * @todo  Add localhost check.
     *
     * @param mixed $value Any value.
     */
    function dd(...$values)
    {
        pp($values);
        die();
    } // dd()
} // if()
