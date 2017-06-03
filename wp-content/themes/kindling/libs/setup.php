<?php
/**
 * Theme setup.
 *
 * @package Kindling_Theme
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

/**
 * Theme setup.
 */
add_action('after_setup_theme', function () {
    // Enable features from Soil when plugin is activated
    // https://roots.io/plugins/soil/
    add_theme_support('soil-clean-up');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-relative-urls');

    // Make theme available for translation
    // Community translations can be found at https://github.com/roots/sage-translations
    load_theme_textdomain('kindling', get_template_directory() . '/lang');

    // Enable plugins to manage the document title
    // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
    add_theme_support('title-tag');

    // Register wp_nav_menu() menus
    // http://codex.wordpress.org/Function_Reference/register_nav_menus
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'kindling'),
        'footer_navigation'  => __('Footer Navigation', 'snifter' ),
        'social_menu'        => __('Social Menu', 'snifter' ),
    ]);

    // Enable post thumbnails
    // http://codex.wordpress.org/Post_Thumbnails
    // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
    // http://codex.wordpress.org/Function_Reference/add_image_size
    add_theme_support('post-thumbnails');

    // Enable post formats
    // http://codex.wordpress.org/Post_Formats
    add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

    // Enable HTML5 markup support
    // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    // Use main stylesheet for visual editor
    // To add custom styles edit /assets/styles/layouts/_tinymce.scss
    add_editor_style(kindling_asset_path('main.css'));
});

/**
 * Register sidebars.
 */
add_action('widgets_init', function () {
    register_sidebar([
        'name'          => __('Primary', 'kindling'),
        'id'            => 'sidebar-primary',
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ]);
});

/**
 * Theme assets.
 */
add_action('wp_enqueue_scripts', function () {
    $theme         = wp_get_theme();
    $theme_version = $theme->get( 'Version' );

    wp_enqueue_style('kindling/css', kindling_asset_path('main.css'), false, $theme_version);

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_script('kindling/js', kindling_asset_path('main.js'), ['jquery', 'jquery-effects-core'], $theme_version, true);
}, 100);

/**
 * Administrator assets.
 */
add_action('admin_enqueue_scripts', function () {
    $version = wp_get_theme()->get( 'Version' );

    wp_enqueue_style('kindling/css', kindling_asset_path('main-admin.css'), false, $version);
}, 100);
