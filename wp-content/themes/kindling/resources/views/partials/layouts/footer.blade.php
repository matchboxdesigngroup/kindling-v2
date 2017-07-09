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
<footer class="content-info site-footer">
    <div class="container footer-inner">
        <span class="footer-copyright">&copy; <?php esc_attr_e("{$copyrightYear} {$copyrightName}"); ?></span>

        <nav class="footer-navigation-menu">
            <?php
            if (has_nav_menu('footer_navigation')) {
                wp_nav_menu([
                    'theme_location' => 'footer_navigation',
                    'menu_class' => 'footer-navigation-menu list-unstyled clearfix',
                    'depth' => 1,
                ]);
            } ?>
        </nav>
    </div>
</footer>
<?php
get_template_part('templates/partials/back-to-top');
