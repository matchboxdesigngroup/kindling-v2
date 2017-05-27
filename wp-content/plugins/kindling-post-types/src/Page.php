<?php
/**
 * Kindling Type Page Class.
 *
 * @package Kindling
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

namespace Kindling\PostTypes;

use Kindling\PostTypes\Base;

/**
 * Handles anything custom for the default WordPress "page" post type.
 */
class Page extends Base
{
    /**
     * The slug of the post types landing page if not post type archive.
     *
     * @var string
     */
    public $landing_page_slug = '';

    /**
     * The slug of the post types landing page template if not post type archive.
     *
     * @var string
     */
    public $landing_page_template = '';

    /**
     * Class constructor, handles instantiation functionality for the class
     */
    public function __construct()
    {
        parent::__construct('page', 'Pages', 'Page');
    } // __construct()
} // END Class MDG_Type_Page()
