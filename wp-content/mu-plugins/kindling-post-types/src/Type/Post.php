<?php
/**
 * Post Type: Post
 *
 * @package Kindling_Post_Types
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

namespace Kindling\PostTypes\Type;

use Kindling\PostTypes\Base;

/**
 * Post post type.
 */
class Post extends Base
{
    /**
     * Creates the Post post type.
     */
    public function __construct()
    {
        parent::__construct('post', 'Posts', 'Post');

        // Disable post type registration.
        $this->setDisableRegistration(true);
    }
}
