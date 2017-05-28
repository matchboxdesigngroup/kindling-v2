<?php
/**
 * Footer template.
 *
 * @package Kindling_Theme
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

$copyrightName = get_bloginfo('name');
$copyrightYear = date('Y');
?>
<footer class="content-info">
  <div class="container">
    <span class="copyright">&copy; <?php esc_attr_e("{$copyrightYear} {$copyrightName}"); ?></span>
    <?php
    if (has_nav_menu('footer_navigation')) {
        wp_nav_menu([
            'theme_location' => 'footer_navigation',
            'menu_class' => 'footer-navigation',
        ]);
    } ?>
    </div>
</footer>
