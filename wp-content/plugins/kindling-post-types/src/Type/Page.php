<?php
/**
 * Post Type: Page
 *
 * @package Kindling_Post_Types
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

namespace Kindling\PostTypes\Type;

use Kindling\PostTypes\Base;

/**
 * Page post type.
 */
class Page extends Base
{
    /**
     * Creates the Page post type.
     */
    public function __construct()
    {
        parent::__construct('page', 'Pages', 'Page');

        // Disable post type registration.
        $this->setDisableRegistration(true);
    }
}
