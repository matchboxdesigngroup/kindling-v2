<?php
/**
 * Theme Filters.
 *
 * @package Kindling_Theme
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

/**
 * Handles removing the hicpo_pre_get_posts filter.
 *
 * In the Intuitive Custom Post Order there is a template filter
 * that forces orderby=menu_order and order=ASC on active post types.
 * This causes issues when you do not want the menu_order behavior, such
 * as when you want a random order.
 *
 * @link    https://wordpress.org/plugins/intuitive-custom-post-order/
 *
 * @param   object  $query  The current query to filter.
 *
 * @return  object          The filtered query.
 */
add_filter( 'pre_get_posts', function ($query) {
    global $wp_filter;

    if (! isset( $wp_filter['pre_get_posts'] ) or is_admin()) {
        return $query;
    } // if()

    $pre_get_posts_filters = $wp_filter['pre_get_posts'];

    foreach ($pre_get_posts_filters as $filters_key => $filters) {
        foreach ($filters as $filter_key => $filter) {
            $correct_filter = ( strpos( $filter_key, 'hicpo_pre_get_posts' ) !== false );
            $has_function   = isset( $filter['function'] );

            if ($correct_filter and $has_function) {
                remove_filter( 'pre_get_posts', $filter['function'], $filters_key );
            } // if()
        } // foreach()
    } // foreach()


    return $query;
}, 0 );

/**
 * Add <body> classes
 */
add_filter('body_class', function ($classes) {
  // Add page slug if it doesn't exist
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

  // Add class if sidebar is active
    if (kindling_display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    return $classes;
});

/**
 * Clean up the_excerpt()
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

add_filter('template_include', function ($main) {
    return Kindling\Theme\ThemeWrapper::wrap($main);
}, 109);
