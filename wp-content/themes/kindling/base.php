<!doctype html>
<html <?php language_attributes(); ?>>
    <?php get_template_part('templates/layouts/head'); ?>
  <body <?php body_class(); ?>>
    <?php get_template_part('templates/partials/outdated'); ?>
    <?php
      do_action('get_header');
      get_template_part('templates/layouts/header');
    ?>
    <div class="wrap container" role="document">
      <div class="content row">
        <main class="main">
            <?php include kindling_template_path(); ?>
        </main><!-- /.main -->
        <?php include kindling_sidebar_path(); ?>
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
      get_template_part('templates/layouts/footer');
      wp_footer();
    ?>
  </body>
</html>
