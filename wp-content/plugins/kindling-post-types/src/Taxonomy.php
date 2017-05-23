<?php
/**
 * Kindling Post Type.
 *
 * @package Kindling
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

namespace Kindling\PostType;

class PostType
{
    protected $slug;

    /**
     * Configures a taxonomy.
     *
     * @param  string $slug
     * @param  string $singularName
     * @param  string $pluralName
     * @param  array  $attributes
     */
    protected function __construct($slug, $singularName, $pluralName, $attributes = [])
    {
        $this->slug = $slug;
        $this->singularName = $singularName;
        $this->pluralName = $pluralName;
        $this->attributes = array_merge_recursive($this->getDefaultAttributes(), $attributes);
    }

    public function register()
    {
        return;
    }

    protected function getDefaultAttributes()
    {
        return [];
    }
}
