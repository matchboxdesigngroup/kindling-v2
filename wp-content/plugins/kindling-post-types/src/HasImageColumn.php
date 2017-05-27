<?php
/**
 * Post Table Image Column.
 *
 * @package Kindling_Post_Types
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

namespace Kindling\PostTypes;

/**
 * Adds the image column to the posts table.
 */
trait HasImageColumn
{
    /**
     * If the taxonomy registration should be disabled.
     *
     * @var boolean
     */
    protected $disableImageColumn = false;

    /**
     * Column filter for featured image.
     *
     * @param string  $postType Post type id.
     */
    public function addImageColumnAction($postType)
    {
        if ($this->disableImageColumn) {
            return;
        } // if()

        $currentPostType = (isset($_GET['post_type'])) ? sanitize_text_field($_GET['post_type']) : '';
        if ($currentPostType !== $postType) {
            return;
        }

        switch ($postType) {
            case 'post':
                $manageFilter = 'manage_posts_columns';
                $customColumn = 'manage_posts_custom_column';
                break;
            case 'page':
                $manageFilter = 'manage_pages_columns';
                $customColumn = 'manage_pages_custom_column';
                break;
            default:
                $manageFilter = "manage_{$postType}_posts_columns";
                $customColumn = "manage_{$postType}_posts_custom_column";
                break;
        } // switch()

        add_filter($manageFilter, [ &$this, 'addThumbnailColumn' ], 5);
        add_action($customColumn, [ &$this, 'displayThumbnailColumn' ], 5, 2);
    }

    /**
     * Adds the thumbnail image column.
     *
     * @param array $cols Current post table columns.
     *
     * @return array $cols The current columns with thumbnail column added.
     */
    public function addThumbnailColumn($cols)
    {
        $postType = (isset($_GET['post_type'])) ? sanitize_text_field($_GET['post_type']) : '';

        // Make sure the post supports thumbnails.
        if (! post_type_supports($postType, 'thumbnail')) {
            return $cols;
        } // if()

        // Get the post type object.
        $typeObj = get_post_type_object($postType);
        if (is_null($typeObj)) {
            return $cols;
        } // if()

        // Set the column.
        $label  = (isset($typeObj->labels->featured_image)) ? $typeObj->labels->featured_image : 'Featured Image';
        $cols['mdg_post_thumb'] = __($label);

        return $cols;
    }

    /**
     * Grab featured-thumbnail size post thumbnail and display it.
     *
     * @param array   $col  Current post table columns.
     * @param integer $id   The current post ID..
     */
    public function displayThumbnailColumn($col, $id)
    {
        global $kptThumbnailColumnImageIds;

        // Check if we should display this image.
        $postType         = get_post_type($id);
        $columnImageIds  = (isset($kptThumbnailColumnImageIds)) ? $kptThumbnailColumnImageIds : [];
        $alreadyDisplayed = in_array($id, $columnImageIds);
        $correct_column    = ('mdg_post_thumb' === $col);

        if ($correct_column and ! $alreadyDisplayed) {
            echo get_the_post_thumbnail($id, 'admin-list-thumb');
            $columnImageIds[] = $id;
        } // if()

        $kptThumbnailColumnImageIds = $columnImageIds;
    }

    /**
     * Sets disable post table image column.
     *
     * @param boolean $disable
     */
    protected function setDisableImageColumn($disable)
    {
        $this->disableImageColumn = (bool) $disable;
    }
}
