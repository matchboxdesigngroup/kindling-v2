<?php
/**
 * Header template.
 *
 * @package Kindling_Theme
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */
?>
<header class="banner navbar navbar-static-top site-header" role="banner">
    <div class="container">
        <div class="navbar-header">
            <div class="site-logo-wrap">
                <a
                class="site-logo-link"
                href="<?php echo esc_url(home_url('/')); ?>"
                >
                    <img
                    src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo.png    "
                    alt="<?php bloginfo('name'); ?>"
                    width="150"
                    height="60"
                    class="site-logo img-responsive">
                </a>
            </div>

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <nav class="collapse navbar-collapse" role="navigation">
            <?php
            if (has_nav_menu('primary_navigation')) {
                wp_nav_menu([
                    'theme_location' => 'primary_navigation',
                    'walker' => new Kindling\Theme\Navwalker\Bootstrap(),
                    'menu_class' => 'nav navbar-nav navbar-hover',
                    'depth' => 2,
                ]);
            }
            ?>
        </nav>
    </div>
</header>
