<?php
/**
 * Kindling Type Post Class.
 *
 * @package Kindling
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

namespace Kindling\PostTypes;

use Kindling\PostTypes\Base;

/**
 * Handles anything custom for the default WordPress "post" post type.
 */
class Post extends Base
{
    /**
     * The slug of the post types landing post if not post type archive.
     *
     * @var string
     */
    public $landing_page_slug = '';

    /**
     * The slug of the post types landing post template if not post type archive.
     *
     * @var string
     */
    public $landing_page_template = '';

    /**
     * Class constructor, handles instantiation functionality for the class
     */
    public function __construct()
    {
        parent::__construct('post', 'Posts', 'Post');
    } // __construct()
}
