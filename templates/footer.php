<?php
$copyright_name = get_bloginfo( 'name' );
$copyright_year = date( 'Y' );
?>
<footer class="content-info">
  <div class="container">
  	<span class="copyright">&copy; <?php esc_attr_e( "{$copyright_year} {$copyright_name}" ); ?></span>
	<?php
	if ( has_nav_menu( 'footer_navigation' ) ) {
		wp_nav_menu( [
			'theme_location' => 'footer_navigation',
			'menu_class' => 'footer-navigation',
		] );
	} ?>
	</div>
</footer>
