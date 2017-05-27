<?php
/**
 * Kindling Has Argument Merge Trait.
 *
 * @package Kindling_Post_Types
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

namespace Kindling\PostTypes;

trait HasArgumentMerge
{
    /**
     * Merges the post type arguments.
     *
     * @param  array $new
     * @param  array $old
     *
     * @return array
     */
    protected function typeArgumentMerge($old, $new)
    {
        $new = collect($new);
        $old = collect($old);

        // Merge the sub-arguments
        $labels = $this->mergeLabelsArgument($old, $new);
        $rewrite = $this->mergeRewriteArgument($old, $new);
        $supports = $this->mergeSupportsArgument($old, $new);

        // Rebuild the arguments
        $new->merge($old->toArray());
        $new->put('labels', $labels);
        $new->put('rewrite', $rewrite);
        $new->put('supports', $supports);

        return $new->toArray();
    }

    /**
     * Merges the taxonomy arguments.
     *
     * @param  array $new
     * @param  array $old
     *
     * @return array
     */
    protected function taxonomyArgumentMerge($old, $new)
    {
        // Merge the sub-arguments
        $labels = $this->mergeLabelsArgument($old, $new);
        $rewrite = $this->mergeRewriteArgument($old, $new);

        // Rebuild the arguments
        $new = collect($new)->merge($old);
        $new->put('labels', $labels);
        $new->put('rewrite', $rewrite);

        return $new->toArray();
    }

    /**
     * Merges a supports argument.
     *
     * @param  array $new
     * @param  array $old
     *
     * @return array
     */
    protected function mergeSupportsArgument($old, $new)
    {
        $oldSupports = collect($old)->get('supports', []);
        $newSupports = collect($new)->get('supports');

        return is_null($newSupports) ? $oldSupports : $newSupports;
    }

    /**
     * Merges a labels argument.
     *
     * @param  array $new
     * @param  array $old
     *
     * @return array
     */
    protected function mergeLabelsArgument($old, $new)
    {
        $newLabels = collect($new)->get('labels', []);
        $oldLabels = collect($old)->get('labels', []);

        return  array_merge($oldLabels, $newLabels);
    }

    /**
     * Merges a rewrite argument.
     *
     * @param  array $new
     * @param  array $old
     *
     * @return array|boolean
     */
    protected function mergeRewriteArgument($old, $new)
    {
        $oldRewrite = collect($old)->get('rewrite', false);
        $newRewrite = collect($new)->get('rewrite');

        return is_null($newRewrite) ? $oldRewrite : $newRewrite;
    }
}
