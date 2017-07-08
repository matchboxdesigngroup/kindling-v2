<?php
/**
 * Post Type: Stub
 *
 * @package Kindling_Post_Types
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

namespace Kindling\PostTypes\Type;

use Kindling\PostTypes\Base;

/**
 * @codingStandardsIgnoreStart
 * - Change all references to [stub/Stub] to be your post type name.
 * - You can configure/see default post type arguments in the `arguments()` method or remove it if you do not need to change the defaults.
 * - You can configure/see default taxonomy arguments in the `taxonomyArguments()` method or remove it if you do not need to change the defaults.
 * - You can set the default taxonomy slug in the `__construct()` method. Default value is {$this->postType}-categories.
 * - You can disable registration of the post type or taxonomy. If post type registration, for example in Post, the default taxonomy is disabled as well.
 * - Feel free to delete this comment once complete.
 *
 * Please do take a look at Base along with reading comments to get more of an understanding of what is going on.
 *
 * Usage example below.
 * <code>
 * add_action('init', function () {
 *     $stub = new Kindling\PostTypes\Stub;
 *     $stub->init();
 * });
 * </code>
 * @codingStandardsIgnoreEnd
 */

/**
 * Stub post type.
 */
class Stub extends Base
{
    /**
     * Creates the Stub post type.
     */
    public function __construct()
    {
        parent::__construct('stub', 'Stubs', 'Stub');

        // Disable post type registration useful for Page and Post.
        // $this->setDisableRegistration(true);

        // Disable taxonomy in case you do not need it.
        // $this->setDisableTaxonomy(true);

        // Set taxonomy
        $this->setTaxonomy("{$this->postType}-categories");

        // Disable post table image column. Automatically disables if featured image is disabled.
        // $this->setDisableImageColumn(true);
    }

    /**
     * The post type arguments.
     * You can remove this method if you do not need to alter the defaults.
     *
     * @return array
     */
    protected function arguments()
    {
        // Lowercase Labels
        $lcTitlePlural = strtolower($this->titlePlural);
        $lcTitleSingular = strtolower($this->titleSingular);

        return [
            'labels' => [
                'name' => __($this->titlePlural),
                'singular_name' => __($this->titleSingular),
                'add_new' => __("Add New {$this->titleSingular}"),
                'add_new_item' => __("Add News {$this->titleSingular}"),
                'edit_item' => __("Edit {$this->titleSingular}"),
                'new_item' => __("New {$this->titleSingular}"),
                'all_items' => __("All {$this->titlePlural}"),
                'view_item' => __("View {$this->titleSingular}"),
                'search_items' => __("Search {$this->titlePlural}"),
                'not_found' => __("No {$lcTitlePlural} found"),
                'not_found_in_trash' => __("No {$lcTitlePlural} found in Trash"),
                'parent_item_colon' => __(''),
                'menu_name' => __($this->titlePlural),
                'featured_image' => __("{$this->titleSingular} Image"),
                'set_featured_image' => __("Set {$lcTitleSingular} image"),
                'remove_featured_image' => __("Remove {$lcTitleSingular} image"),
                'use_featured_image' => __("Use as {$lcTitleSingular} image"),
            ],
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => [
                'slug' => "{$this->postType}s",
                'with_front' => false
            ],
            'capability_type' => 'post',
            'has_archive' => false,
            'hierarchical' => true,
            'menu_position' => 5,
            'can_export' => true,
            'supports' => [
                'title',
                'editor',
                'post-thumbnails',
                'custom-fields',
                'page-attributes',
                'author',
                'thumbnail',
                'excerpt',
                'trackbacks',
                'comments',
                'revisions',
                'post-formats',
            ],
            'menu_icon' => 'dashicons-edit',
        ];
    }

    /**
     * The taxonomy arguments.
     * You can remove this method if you do not need to alter the defaults.
     *
     * @return array
     */
    protected function taxonomyArguments()
    {
        return [
            'hierarchical' => true,
            'labels' => [
                'name' => _x("{$this->titleSingular} Categories", 'taxonomy general name'),
                'singular_name' => _x("{$this->titleSingular} Category", 'taxonomy singular name'),
                'search_items' => __("Search {$this->titleSingular} Categories"),
                'all_items' => __("All {$this->titleSingular} Categories"),
                'parent_item' => __("Parent {$this->titleSingular} Category"),
                'parent_item_colon' => __("Parent {$this->titleSingular} Category:"),
                'edit_item' => __("Edit {$this->titleSingular} Category"),
                'update_item' => __("Update {$this->titleSingular} Category"),
                'add_new_item' => __("Add New {$this->titleSingular} Category"),
                'new_item_name' => __("New {$this->titleSingular} Category Name"),
                'menu_name' => __("{$this->titleSingular} Categories"),
                'view_item' => __("View {$this->titleSingular} Category"),
                'popular_items' => __("Popular {$this->titleSingular} Categories"),
                'separate_items_with_commas' => __("Separate {$this->titleSingular} Categories with commas"),
                'add_or_remove_items' => __("Add or remove  {$this->titleSingular} Categories"),
                'choose_from_most_used' => __("Choose from the most used {$this->titleSingular} Categories"),
                'not_found' => __("No  {$this->titleSingular} Categories found."),
            ],
            'public' => true,
            'show_in_nav_menus' => true,
            'show_ui' => true,
            'show_tagcloud' => true,
            'show_admin_column' => true,
            'query_var' => $this->taxonomy,
            'rewrite' => [
                'slug' => "{$this->postType}-categories",
                'with_front' => false,
                'hierarchical' => true,
            ]
        ];
    }
}
