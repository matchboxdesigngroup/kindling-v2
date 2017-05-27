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
    }

    // Check the possible HTTP hosts against the current HTTP host.
    foreach ($hosts as $host) {
        if (false !== strpos($current, $host)) {
            return true;
        }
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
 * }
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
}

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
        foreach ($values as $value) {
            pp($value);
        }

        die();
    } // dd()
}

/**
 * If the environment bar should be displayed.
 *
 * @return boolean True if the bar should be displayed and false if not
 */
function kdev_display_environment_bar()
{
    /**
    * Allows for filtering if the environment bar should be displayed or not.
    *
    * @param  boolean
    */
    return apply_filters('kdev_display_environment_bar', !kdev_is_production());
}

/**
 * Adds the environment bar.
 */
function kdev_environment_bar()
{
    if (kdev_display_environment_bar()) {
        require_once KDEV_PLUGIN_DIR_PATH . '/views/environment-bar.php';
    }
}

/**
 * Adds the environment bar styles.
 */
function kdev_environment_bar_styles()
{
    if (kdev_display_environment_bar()) {
        $url = KDEV_PLUGIN_URL . '/assets/kdev-environment-bar.css';
        wp_enqueue_style('kindling-development/css', $url, false, KDEV_VERSION);
    }
}

/**
 * Adds the environment bar body class.
 *
 * @param  array|string $classes The current classes.
 *
 * @return array|string          An array of classes if passed in as an array and a string if passed in as a string.
 */
function kdev_environment_bar_body_class($classes)
{
    if (! kdev_display_environment_bar()) {
        return $classes;
    }

    $env_type = kdev_get_environment_type();
    $bar_classes = [
        'kdev-environment-bar-enabled',
        "kdev-environment-{$env_type}",
    ];

    if (is_string($classes)) {
        $classes .= trim(' ' . implode( ' ', $bar_classes ));
    } elseif (is_array($classes)) {
        $classes = array_merge($classes, $bar_classes);
    }

    return $classes;
}

/**
 * Adds possible site links such as staging, production, etc.
 *
 * @param  WP_Admin_Bar $admin_bar
 */
function kdev_add_site_links($admin_bar)
{
    /**
    * Allows for filtering of the site links.
    *
    * @param  array
    */
    $sites = apply_filters('kdev_toolbar_site_links', [
        'Production' => '',
        'Staging' => '',
    ]);

    if (!array_filter($sites)) {
        return;
    }

    $admin_bar->add_menu([
        'id'    => 'kdev-links',
        'title' => 'Sites',
        'href'  => '#',
        'meta'  => [
            'title' => __('Site Links'),
        ],
    ]);

    foreach ($sites as $label => $link) {
        $admin_bar->add_menu( [
            'id' => 'kdev_link_' . str_replace('-', '_', sanitize_title($label)),
            'parent' => 'kdev-links',
            'title' => $label,
            'href'  => $link,
            'meta'  => [
                'title' => __($label),
                'target' => '_blank',
                'class' => 'kdev-link-' . sanitize_title($label)
            ],
        ]);
    }
}
