<?php
/**
 * Kindling Type Base Class.
 *
 * @package Kindling
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

namespace Kindling\PostType;

use Kindling\PostType\PostType;
use Kindling\PostType\ImageColumn;

/**
 * This is a base for custom post type classes so they can all take advantage of the same logic.
 *
 * You should do your best not to overwrite any method and to use the
 * custom_[some_property] properties for configuring the base class methods which have parameters.
 * Feel free to over write any of the parameters you see fit to make the sub-classes
 * more versatile.
 *
 * @package      WordPress
 * @subpackage   Kindling
 *
 * @author       Matchbox Design Group <info@matchboxdesigngroup.com>
 *
 * @example lib/post-types/type-stub.php
 */
abstract class Base
{
    use ImageColumn;

    /**
     * Slug for post type.
     *
     * @var  string
     */
    // public $post_type;

    /**
     * Title of post type.
     *
     * @var  string
     */
    // public $post_type_title;

    /**
     * Singular title.
     *
     * @var  string
     */
    // public $post_type_single;

    /**
     * Arguments to be used when registering the post type's taxonomy.
     *
     * @var  array
     */
    private $taxonomy_args;


    /**
     * Arguments to be used when registering the post type.
     *
     * @var  array
     */
    private $post_type_args;

    /**
     * What the post type supports.
     *
     * @var  array
     */
    private $_post_type_supports;

    /**
     * The post types custom labels used in register_post_type().
     *
     * @var  array
     */
    // public $custom_post_type_labels;

    /**
     * Used to disable the addition of the featured image column.
     *
     * @var  boolean
     */
    // public $disable_image_column = false;

    /**
     * Custom post type arguments used in register_post_type().
     *
     * @var  array
     */
    // public $custom_post_type_args;

    /**
     * The taxonomy "name" used in register_taxonomy().
     *
     * @var  array
     */
    // public $taxonomy_name;

    /**
     * Custom taxonomy labels used in register_taxonomy().
     *
     * @var  array
     */
    // public $custom_taxonomy_labels;

    /**
     * Custom taxonomy arguments used in register_taxonomy().
     *
     * @var  array
     */
    // public $custom_taxonomy_args;

    /**
     * Custom post type supports array used in register_post_type().
     *
     * @var  array
     */
    // public $custom_post_type_supports;

    /**
     * Disable/Enable Categories per post type.
     *
     * @var  boolean
     */
    // public $disable_post_type_taxonomy;

    /**
     * Disable/Enable thumbnail post table column.
     *
     * @var  boolean
     */
    // public $disable_thumbnail_column;

    /**
     * Class constructor, takes care of all the setup needed.
     *
     * @param string $post_type        The post type id.
     * @param string $post_type_title  The post type plural title.
     * @param string $post_type_single The post type singular title.
     */
    public function __construct($post_type, $post_type_title, $post_type_single)
    {
        // $this->post_type = $post_type;
        // $this->post_type_title = $post_type_title;
        // $this->post_type_single = $post_type_single;

        // $this->setProperties();
        // $this->typeBaseAddActions();
    } // __construct()

    /**
     * Sets a default value for a variable.
     *
     * @param   mixed $check_value    The value to check if it is set.
     * @param   mixed $default_value  The default value to be used if $check_value has not already been set.
     *
     * @return  mixed                   The $check_value if it is set and the $default_value if not.
     */
    public function setDefault($check_value, $default_value)
    {
        // return (isset($check_value)) ? $check_value : $default_value;
    } // setDefault()

    /**
     * Sets all of the classes parameters
     *
     * @todo Make this cleaner
     */
    private function setProperties()
    {
        // $this->setTaxonomyProperties();
        // $this->setPostTypeProperties();
    } // setProperties()

    /**
     * Sets the post type properties.
     */
    private function setPostTypeProperties()
    {
        // Post Type.
        // $this->post_type_args           = $this->setDefault($this->post_type_args, array());
        // $this->custom_post_type_args     = $this->setDefault($this->custom_post_type_args, array());
        // $this->custom_post_type_labels   = $this->setDefault($this->custom_post_type_labels, array());
        // $this->custom_post_type_supports = $this->setDefault($this->custom_post_type_supports, array());
        // $this->setPostTypeSupports($this->custom_post_type_supports);
        // $this->setPostTypeArgs($this->custom_post_type_args);
    }

    /**
     * Sets the taxonomy properties.
     */
    private function setTaxonomyProperties()
    {
        // $this->taxonomy_args         = $this->setDefault($this->taxonomy_args, array());
        // $this->custom_taxonomy_labels = $this->setDefault($this->custom_taxonomy_labels, array());
        // $this->custom_taxonomy_args   = $this->setDefault($this->custom_taxonomy_args, array());
        // $this->taxonomy_name          = $this->setDefault($this->taxonomy_name, "{$this->post_type}-categories");
        // $this->setTaxonomyArgs($this->custom_taxonomy_args);
        // $this->disable_post_type_taxonomy = $this->setDefault($this->disable_post_type_taxonomy, false);
    }

    /**
     * Actions that need to be set for this base class only using add_action()
     * sub-classes will need to set there own actions without overriding this method.
     */
    private function typeBaseAddActions()
    {
        // Create post type.
        // add_action('init', array(&$this, 'registerPostType'));

        // Featured image column action.
        // add_action('init', function () {
        //     $this->add_image_column_action($this->post_type, $this->disable_image_column);
        // });
    } // typeBaseAddActions()

    /**
     * Sets the Post Type support array
     *
     * @link https://codex.wordpress.org/Function_Reference/post_type_supports
     *
     * @param array $custom_post_type_supports  What the current post type should support.
     */
    public function setPostTypeSupports($custom_post_type_supports)
    {
        // $default_post_type_supports = [
        //     'title',
        //     'editor',
        //     'post-thumbnails',
        //     'custom-fields',
        //     'page-attributes',
        //     'author',
        //     'thumbnail',
        //     'excerpt',
        //     'trackbacks',
        //     'comments',
        //     'revisions',
        //     'post-formats',
        // ];

        // if (! empty($custom_post_type_supports)) {
        //     $this->post_type_supports = $custom_post_type_supports;
        // } else {
        //     $this->post_type_supports = $default_post_type_supports;
        // } // if()
    } // setPostTypeSupports()

    /**
     * Registers the post type and a custom taxonomy for the post type..
     */
    public function registerPostType()
    {
        // if (post_type_exists($this->post_type)) {
        //     return;
        // }

        // Register post type.
        // register_post_type($this->post_type, $this->post_type_args);

        // Register taxonomy for post type.
        // if (! $this->disable_post_type_taxonomy) {
        //     register_taxonomy(
        //         $this->taxonomy_name,
        //         array($this->post_type),
        //         $this->taxonomy_args
        //     );
        // } // if()
    } // register_post_type()

    /**
     * Sets the arguments used for registering the post type with register_post_type()
     *
     * @param  array $custom_post_type_args Optional. Anything acceptable in the $args parameter for register_post_type() http://codex.wordpress.org/Function_Reference/register_post_type.
     */
    public function setPostTypeArgs($custom_post_type_args = array())
    {
        // $lowercase_post_type_title  = strtolower($this->post_type_title);
        // $lowercase_post_type_single = strtolower($this->post_type_single);
        // $default_post_type_labels   = [
        //     'name'                  => __($this->post_type_title),
        //     'singular_name'         => __($this->post_type_single),
        //     'add_new'               => __("Add New {$this->post_type_single}"),
        //     'add_new_item'          => __("Add New {$this->post_type_single}"),
        //     'edit_item'             => __("Edit {$this->post_type_single}"),
        //     'new_item'              => __("New {$this->post_type_single}"),
        //     'all_items'             => __("All {$this->post_type_title}"),
        //     'view_item'             => __("View {$this->post_type_single}"),
        //     'search_items'          => __("Search {$this->post_type_title}"),
        //     'not_found'             => __("No {$lowercase_post_type_title} found"),
        //     'not_found_in_trash'    => __("No {$lowercase_post_type_title} found in Trash"),
        //     'parent_item_colon'     => __(''),
        //     'menu_name'             => __($this->post_type_title),
        //     'featured_image'        => __("{$this->post_type_single} Image"),
        //     'set_featured_image'    => __("Set {$lowercase_post_type_single} image"),
        //     'remove_featured_image' => __("Remove {$lowercase_post_type_single} image"),
        //     'use_featured_image'    => __("Use as {$lowercase_post_type_single} image"),
        // ];

        // $labels = array_merge($default_post_type_labels, $this->custom_post_type_labels);
        // $default_post_type_args = [
        //     'labels'             => $labels,
        //     'public'             => true,
        //     'publicly_queryable' => true,
        //     'show_ui'            => true,
        //     'show_in_menu'       => true,
        //     'query_var'          => true,
        //     'rewrite'            => array('slug' => $this->post_type, 'with_front' => false),
        //     'capability_type'    => 'post',
        //     'has_archive'        => false,
        //     'hierarchical'       => true,
        //     'menu_position'      => 5,
        //     'can_export'         => true,
        //     'supports'           => $this->post_type_supports,
        //     'menu_icon'          => 'dashicons-edit',
        // ];

        // $this->post_type_args = array_merge($default_post_type_args, $custom_post_type_args);
    } // setPostTypeArgs()

    /**
     * Sets the taxonomy args when registering a taxonomy using register_taxonomy()
     *
     * @param array $custom_taxonomy_args Optional. Anything acceptable in the $args parameter for register_taxonomy() http://codex.wordpress.org/Function_Reference/register_taxonomy.
     */
    public function setTaxonomyArgs($custom_taxonomy_args = array())
    {
        // Taxonomy labels.
        // $default_labels = [
        //     'name'                       => _x("{$this->post_type_single} Categories", 'taxonomy general name'),
        //     'singular_name'              => _x("{$this->post_type_single} Category", 'taxonomy singular name'),
        //     'search_items'               => __("Search {$this->post_type_single} Categories"),
        //     'all_items'                  => __("All {$this->post_type_single} Categories"),
        //     'parent_item'                => __("Parent {$this->post_type_single} Category"),
        //     'parent_item_colon'          => __("Parent {$this->post_type_single} Category:"),
        //     'edit_item'                  => __("Edit {$this->post_type_single} Category"),
        //     'update_item'                => __("Update {$this->post_type_single} Category"),
        //     'add_new_item'               => __("Add New {$this->post_type_single} Category"),
        //     'new_item_name'              => __("New {$this->post_type_single} Category Name"),
        //     'menu_name'                  => __("{$this->post_type_single} Categories"),
        //     'view_item'                  => __("View {$this->post_type_single} Category"),
        //     'popular_items'              => __("Popular {$this->post_type_single} Categories"),
        //     'separate_items_with_commas' => __("Separate {$this->post_type_single} Categories with commas"),
        //     'add_or_remove_items'        => __("Add or remove  {$this->post_type_single} Categories"),
        //     'choose_from_most_used'      => __("Choose from the most used {$this->post_type_single} Categories"),
        //     'not_found'                  => __("No  {$this->post_type_single} Categories found."),
        // ];
        // $labels = array_merge($default_labels, $this->custom_taxonomy_labels);

        // Register taxonomy.
        // $default_taxonomy_args = [
        //     'hierarchical'      => true,
        //     'labels'            => $labels,
        //     'public'            => true,
        //     'show_in_nav_menus' => true,
        //     'show_ui'           => true,
        //     'show_tagcloud'     => true,
        //     'show_admin_column' => true,
        //     'query_var'         => $this->taxonomy_name,
        //     'rewrite'           => array(
        //         'slug'         => $this->post_type,
        //         'with_front'   => false,
        //         'hierarchical' => true,
        //    ),
        // ];

        // $this->taxonomy_args = array_merge($default_taxonomy_args, $custom_taxonomy_args);
    } // setTaxonomyArgs()














    public $postType;
    public $taxonomy;

    /**
     * Registers the post type.
     *
     * @param  string $slug
     * @param  string $singularName
     * @param  string $pluralName
     * @param  array $attributes
     */
    protected function registerPostType($slug, $singularName, $pluralName, $attributes)
    {
        $this->postType = (PostType($slug, $singularName, $pluralName))->register();
    }

    protected function resgisterTaxonomy($slug, $singularName, $pluralName)
    {
        $this->taxonomy = Taxonomy();
    }
}
