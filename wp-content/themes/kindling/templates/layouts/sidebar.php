<?php
/**
 * Sidebar template.
 *
 * @package Kindling_Theme
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

if (!kindling_display_sidebar()) {
    return;
}
?>
<aside class="sidebar">
    <?php dynamic_sidebar('sidebar-primary'); ?>
</aside><!-- /.sidebar -->
