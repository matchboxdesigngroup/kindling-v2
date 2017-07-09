<?php
/**
 * Theme Actions.
 *
 * @package Kindling_Theme
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

/**
 * Filters Gravity Forms CSS classes for a field.
 *
 * @link    http://www.gravityhelp.com/documentation/page/Gform_field_css_class
 *
 * @param   string  $classes  The CSS classes to be filtered, separated by empty spaces (i.e. "gfield custom_class").
 * @param   array   $field    Current field.
 * @param   array   $form     Current form.
 *
 * @return  string            The filtered CSS classes separated by empty spaces (i.e. "gfield custom_class").
 */
add_action('gform_field_css_class', function ($classes, $field, $form) {
  // Add the field label class.
    $label       = (isset($field['label'])) ? $field['label'] : '';
    $admin_label = (isset($field['adminLabel'])) ? $field['adminLabel'] : '';
    $input_slug  = ('' === $admin_label) ? $label : $admin_label;
    $input_slug  = sanitize_title($input_slug);
    $classes    .= " gfield-{$input_slug}";

  // Add the field type class.
    $type     = (isset($field['type'])) ? $field['type'] : '';
    $type     = sanitize_title($type);
    $classes .= " gfield-type-{$type}";

  // Add placeholder classes.
    $has_placeholder = (isset($field['placeholder']) and '' !== $field['placeholder']);
    if (isset($field['inputs'])) {
        foreach ($field['inputs'] as $input) {
            if (isset($input['placeholder']) and '' !== $input['placeholder']) {
                $has_placeholder = true;

                break;
            } // if()
        } // foreach()
    } // if()
    $classes .= ($has_placeholder) ? ' gfield-placeholder' : '';

    return $classes;
}, 10, 3);

/**
 * Declare WooCommerce theme support.
 */
add_action('after_setup_theme', function () {
    add_theme_support('woocommerce');
});

/**
 * Register image sizes.
 */
add_action('init', function () {
    Kindling\Theme\ImageSizes::register();
});

/**
 * Shared view data.
 */
add_action('wp', function () {
    global $wp_query;

    $posts = $wp_query->get_posts();
    $post = current($posts);
    $blade = kindling('blade');

    $blade->share('wp_query', $wp_query);
    $blade->share('posts', $posts);
    $blade->share('post', (false === $post) ? null : $post);
    $blade->share('page_title', kindling_page_title());
});
