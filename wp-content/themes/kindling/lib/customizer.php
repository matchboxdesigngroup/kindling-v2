<?php
/**
 * Theme Customizer.
 *
 * @package Kindling
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

/**
 * Add postMessage support
 */
add_action('customize_register', function ($wp_customize) {
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
});

/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script('sage/customizer', kindling_asset_path('customizer.js'), ['customize-preview'], null, true);
});
