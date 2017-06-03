<?php
/**
 * Base template wrapper.
 *
 * @package Kindling_Theme
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
    <?php get_template_part('templates/layouts/head'); ?>
    <body <?php body_class(); ?>>
        <div class="body-bg">
            <?php
            get_template_part('templates/partials/outdated');
            do_action('get_header');
            get_template_part('templates/layouts/header');
            ?>

            <div class="site-wrap content-bg" role="document">
                <div class="container">
                    <div class="content row">
                        <main class="main">
                            <?php include kindling_template_path(); ?>
                        </main><!-- /.main -->
                        <?php include kindling_sidebar_path(); ?>
                    </div><!-- /.content -->
                </div>
            </div><!-- /.site-wrap -->

            <?php
            do_action('get_footer');
            get_template_part('templates/layouts/footer');
            wp_footer();
            ?>
        </div>
    </body>
</html>
