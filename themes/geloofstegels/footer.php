<?php
/**
 * Footer template – 5 kolommen.
 *
 * @package Geloofstegels
 */

$gt_footer_menus = array(
	'footer-shop'     => __( 'Producten', 'geloofstegels' ),
	'footer-moments'  => __( 'Momenten', 'geloofstegels' ),
	'footer-inspo'    => __( 'Inspiratie', 'geloofstegels' ),
	'footer-service'  => __( 'Klantenservice', 'geloofstegels' ),
	'footer-business' => __( 'Zakelijk & Algemeen', 'geloofstegels' ),
);
?>
</div><!-- #content -->

<footer id="colophon" class="site-footer">
	<div class="gt-container">
		<div class="footer-cols">
			<?php foreach ( $gt_footer_menus as $gt_location => $gt_label ) : ?>
				<div class="footer-col">
					<h3><?php echo esc_html( $gt_label ); ?></h3>
					<?php
					if ( has_nav_menu( $gt_location ) ) {
						wp_nav_menu(
							array(
								'theme_location' => $gt_location,
								'container'      => false,
								'menu_class'     => 'footer-menu',
								'depth'          => 1,
							)
						);
					} else {
						echo '<ul class="footer-menu"><li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Menu instellen', 'geloofstegels' ) . '</a></li></ul>';
					}
					?>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="footer-bottom">
			<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>. <?php esc_html_e( 'Alle rechten voorbehouden.', 'geloofstegels' ); ?></span>
			<span><?php esc_html_e( 'Met liefde gemaakt – geloof voor iedere gelegenheid.', 'geloofstegels' ); ?></span>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
