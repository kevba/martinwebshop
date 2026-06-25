<?php
/**
 * Homepage sectie 4: Populaire tegeltjes (productgrid met 8 bestsellers).
 *
 * @package Geloofstegels
 */

$gt_count = absint( get_theme_mod( 'gt_popular_count', 8 ) );
if ( $gt_count < 1 ) {
	$gt_count = 8;
}
?>
<section class="gt-section">
	<div class="gt-container">
		<div class="gt-section-head">
			<span class="gt-eyebrow"><?php esc_html_e( 'Bestsellers', 'geloofstegels' ); ?></span>
			<h2><?php esc_html_e( 'Populaire tegeltjes', 'geloofstegels' ); ?></h2>
			<p><?php esc_html_e( 'Onze meest geliefde ontwerpen, gekozen door klanten.', 'geloofstegels' ); ?></p>
		</div>

		<?php
		if ( class_exists( 'WooCommerce' ) ) {
			// Toon bestsellers; valt terug op recente producten.
			echo do_shortcode( '[products limit="' . $gt_count . '" columns="4" orderby="popularity" class="gt-product-grid"]' );
		} else {
			echo '<p style="text-align:center;color:#6B7280;">' . esc_html__( 'Activeer WooCommerce om producten te tonen.', 'geloofstegels' ) . '</p>';
		}
		?>

		<div style="text-align:center;margin-top:2.5rem;">
			<a class="gt-btn gt-btn--outline" href="<?php echo esc_url( class_exists( 'WooCommerce' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/winkel/' ) ); ?>">
				<?php esc_html_e( 'Bekijk alle tegeltjes', 'geloofstegels' ); ?>
			</a>
		</div>
	</div>
</section>
