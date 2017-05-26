<?php
/**
 * Kindling Development Actions.
 *
 * @package Kindling_Development
 */

/**
 * Add the environment bar.
 */
add_action('admin_footer', 'kdev_environment_bar');
add_action('wp_footer', 'kdev_environment_bar');
add_action('admin_body_class', 'kdev_environment_bar_body_class');
add_action('body_class', 'kdev_environment_bar_body_class');
add_action('wp_enqueue_scripts', 'kdev_environment_bar_styles');
add_action('admin_enqueue_scripts', 'kdev_environment_bar_styles');

/**
 * Add Production/Staging link.
 */
add_action('admin_bar_menu', 'kdev_add_site_links', 100);
