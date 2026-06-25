<?php
/**
 * Homepage sectie 3: Inspiratie slider (horizontale carrousel met thema-woorden).
 *
 * @package Geloofstegels
 */

$gt_themes = array(
	array( 'Hoop', __( 'Licht in donkere tijden', 'geloofstegels' ) ),
	array( 'Rust', __( 'Vrede voor je hart', 'geloofstegels' ) ),
	array( 'Liefde', __( 'Voor wie je dierbaar is', 'geloofstegels' ) ),
	array( 'Kracht', __( 'Sterk en moedig', 'geloofstegels' ) ),
	array( 'Vertrouwen', __( 'Op God gericht', 'geloofstegels' ) ),
	array( 'Dankbaarheid', __( 'Tel je zegeningen', 'geloofstegels' ) ),
	array( 'Bemoediging & troost', __( 'Een steun in de rug', 'geloofstegels' ) ),
);

// Vervang door taxonomie-termen indien aanwezig.
$gt_terms = get_terms( array( 'taxonomy' => 'inspiratie', 'hide_empty' => false ) );
if ( ! is_wp_error( $gt_terms ) && ! empty( $gt_terms ) ) {
	$gt_themes = array();
	foreach ( $gt_terms as $t ) {
		$gt_themes[] = array( $t->name, '', get_term_link( $t ) );
	}
}
?>
<section class="gt-section gt-section--beige-licht gt-inspiration">
	<div class="gt-container">
		<div class="gt-section-head">
			<span class="gt-eyebrow"><?php esc_html_e( 'Laat je inspireren', 'geloofstegels' ); ?></span>
			<h2><?php esc_html_e( 'Inspiratie', 'geloofstegels' ); ?></h2>
		</div>

		<div class="gt-slider" id="gt-inspiration-slider" tabindex="0">
			<?php foreach ( $gt_themes as $theme ) : ?>
				<?php $url = isset( $theme[2] ) ? $theme[2] : home_url( '/inspiratie/' . sanitize_title( $theme[0] ) . '/' ); ?>
				<a class="gt-slide" href="<?php echo esc_url( $url ); ?>">
					<span class="gt-slide__word"><?php echo esc_html( $theme[0] ); ?></span>
					<?php if ( ! empty( $theme[1] ) ) : ?>
						<span class="gt-slide__sub"><?php echo esc_html( $theme[1] ); ?></span>
					<?php endif; ?>
				</a>
			<?php endforeach; ?>
		</div>

		<div class="gt-slider-nav">
			<button class="gt-slider-prev" aria-label="<?php esc_attr_e( 'Vorige', 'geloofstegels' ); ?>">
				<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>
			</button>
			<button class="gt-slider-next" aria-label="<?php esc_attr_e( 'Volgende', 'geloofstegels' ); ?>">
				<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="9 18 15 12 9 6"/></svg>
			</button>
		</div>
	</div>
</section>
