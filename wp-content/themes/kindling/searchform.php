<?php
/**
 * Search form template.
 *
 * @package Kindling_Theme
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url() ); ?>">
    <label class="search-label">
        <span class="sr-only">Search for:</span>
        <input type="search" class="search-field" placeholder="Search" value="" name="s">
    </label>
    <button type="submit" class="search-submit">
        <i class="fa fa-search header-search-icon" aria-hidden="true"></i>
        <span class="sr-only">Search</span>
    </button>

</form>
