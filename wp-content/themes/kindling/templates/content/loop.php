<?php
/**
 * Content loop template.
 *
 * @package Kindling_Theme
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

?>
<div class="content-loop fitvid">
    <?php
    while (have_posts()) {
        the_post();
        the_content();
    } ?>
</div>
