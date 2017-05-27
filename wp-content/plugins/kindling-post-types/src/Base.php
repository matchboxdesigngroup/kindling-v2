<?php
/**
 * Kindling Type Base Class.
 *
 * @package Kindling_Post_Types
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

namespace Kindling\PostTypes;

use Kindling\PostTypes\HasArgumentMerge;
use Kindling\PostTypes\HasImageColumn;

/**
 * This is a base for custom post type classes so they can all take advantage of the same logic and defaults.
 *
 * @example src/Type/Stub.php
 *
 * @todo Write tests
 * @todo Split out post type registration.
 * @todo Split out taxonomy registration.
 */

abstract class Base
{
    use HasImageColumn, HasArgumentMerge;

    /**
     * The slug of the post types landing page if not post type archive.
     *
     * @var string
     */
    public $landingPageSlug;

    /**
     * The slug of the post types landing page template if not post type archive.
     *
     * @var string
     */
    public $landingPageTemplate;

    /**
     * Slug for post type.
     *
     * @var string
     */
    public $postType;

    /**
     * Title of post type.
     *
     * @var string
     */
    public $titlePlural;

    /**
     * Singular title.
     *
     * @var string
     */
    public $titleSingular;

    /**
     * The taxonomy "name" used in register_taxonomy().
     *
     * @var array
     */
    public $taxonomy;

    /**
     * If the post type registration should be disabled.
     *
     * @var boolean
     */
    protected $disableRegistration = false;

    /**
     * If the taxonomy registration should be disabled.
     *
     * @var boolean
     */
    protected $disableTaxonomy = false;

    /**
     * Class constructor, takes care of all the setup needed.
     *
     * @param string $postType The post type id.
     * @param string $titlePlural The post type plural title.
     * @param string $titleSingular The post type singular title.
     */
    public function __construct($postType, $titlePlural, $titleSingular)
    {
        $this->postType = $postType;
        $this->titlePlural = $titlePlural;
        $this->titleSingular = $titleSingular;
        $this->taxonomy = "{$this->postType}-categories";
        $this->landingPageSlug = "{$this->postType}s";
        $this->landingPageTemplate = "template-{$this->postType}";
    }

    /**
     * Sets up the post type.
     *
     * @return Kindling\PostTypes\Base
     */
    public function init()
    {
        // Create post type and taxonomy.
        $this->register();

        // Featured image column action.
        $this->addImageColumnAction($this->postType);

        return $this;
    }

    /**
     * Registers the post type and a custom taxonomy for the post type..
     */
    protected function register()
    {
        // Register post type
        if (!post_type_exists($this->postType) && !$this->disableRegistration) {
            register_post_type($this->postType, $this->baseArguments());
        }

        // Register taxonomy
        if (!$this->disableTaxonomy && !taxonomy_exists($this->taxonomy) && !$this->disableRegistration) {
            register_taxonomy($this->taxonomy, [ $this->postType ], $this->baseTaxonomyArguments());
        }
    }

    /**
     * Gets the arguments used for registering the post type with register()
     *
     * @see http://codex.wordpress.org/Function_Reference/register
     *
     * @return array
     */
    protected function baseArguments()
    {
        // Lowercase Labels
        $lcTitlePlural = strtolower($this->titlePlural);
        $lcTitleSingular = strtolower($this->titleSingular);

        return $this->typeArgumentMerge([
            'labels' => [
                'name' => __($this->titlePlural),
                'singular_name' => __($this->titleSingular),
                'add_new' => __("Add New {$this->titleSingular}"),
                'add_new_item' => __("Add New {$this->titleSingular}"),
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
        ], $this->arguments());
    }

    /**
     * The post type arguments.
     * Overwrite this method in a sub-class to overwrite default post type arguments.
     *
     * @return array
     */
    protected function arguments()
    {
        return [];
    }

    /**
     * Gets the taxonomy arguments when registering a taxonomy using register_taxonomy()
     *
     * @see http://codex.wordpress.org/Function_Reference/register_taxonomy
     * @return array
     */
    protected function baseTaxonomyArguments()
    {
        return $this->taxonomyArgumentMerge([
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
            ],
        ], $this->taxonomyArguments());
    }

    /**
     * The taxonomy arguments.
     * Overwrite this method in a sub-class to overwrite default taxonomy arguments.
     *
     * @return array
     */
    protected function taxonomyArguments()
    {
        return [];
    }

    /**
     * Retrieves the current post types posts.
     *
     * @see http://codex.wordpress.org/Class_Reference/WP_Query
     *
     * @param array   $arguments Optional. Any arguments accepted by the WP_Query class.
     * @param boolean $getQuery  Optional. If true it will return the WP_Query object instead of posts.
     *
     * @return array Retrieved post objects/Query object.
     */
    public function getPosts($arguments = [], $getQuery = false)
    {
        $query = new WP_Query(array_merge([
            'post_type'=> $this->postType,
            'posts_per_page' => 500,
            'post_status'=> 'publish',
            'order' => 'DESC',
            'orderby' => 'date',
        ], $arguments));

        return $getQuery ? $query : $query->get_posts();
    }

    /**
     * Sets Disables post type registration.
     *
     * @param boolean $disable
     */
    protected function setDisableRegistration($disable)
    {
        $this->disableRegistration = (bool) $disable;
    }

    /**
     * Sets Disables post type taxonomy.
     *
     * @param boolean $disable
     */
    protected function setDisableTaxonomy($disable)
    {
        $this->disableTaxonomy = (bool) $disable;
    }

    /**
     * Sets taxonomy slug.
     *
     * @param string $disable
     */
    protected function setTaxonomy($slug)
    {
        $this->taxonomy = $slug;
    }
}
