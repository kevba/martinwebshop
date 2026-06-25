<?php
/**
 * Homepage sectie 2: Kies een moment (grid van 6 foto-blokken).
 *
 * Probeert eerst de termen uit de `moment`-taxonomie te tonen. Valt anders
 * terug op de 6 standaardmomenten uit de briefing.
 *
 * @package Geloofstegels
 */

$gt_moment_slugs = array( 'geboorte', 'doop', 'huwelijk', 'overlijden', 'kerst', 'bemoediging' );
$gt_cards        = array();

foreach ( $gt_moment_slugs as $slug ) {
	$term = get_term_by( 'slug', $slug, 'moment' );
	if ( $term && ! is_wp_error( $term ) ) {
		$thumb_id  = get_term_meta( $term->term_id, 'gt_image_id', true );
		$image_url = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'gt-moment' ) : '';
		$gt_cards[] = array(
			'title' => $term->name,
			'url'   => get_term_link( $term ),
			'image' => $image_url ? $image_url : GELOOFSTEGELS_URI . '/assets/images/moment-' . $slug . '.jpg',
		);
	} else {
		$gt_cards[] = array(
			'title' => ucfirst( $slug ),
			'url'   => home_url( '/momenten/' . $slug . '/' ),
			'image' => GELOOFSTEGELS_URI . '/assets/images/moment-' . $slug . '.jpg',
		);
	}
}
?>
<section class="gt-section">
	<div class="gt-container">
		<div class="gt-section-head">
			<span class="gt-eyebrow"><?php esc_html_e( 'Voor elk moment', 'geloofstegels' ); ?></span>
			<h2><?php esc_html_e( 'Kies een moment', 'geloofstegels' ); ?></h2>
			<p><?php esc_html_e( 'Of je nu een geboorte viert of troost zoekt – vind het passende tegeltje bij jouw moment.', 'geloofstegels' ); ?></p>
		</div>

		<div class="gt-moments-grid">
			<?php foreach ( $gt_cards as $card ) : ?>
				<a class="gt-moment-card" href="<?php echo esc_url( $card['url'] ); ?>">
					<img src="<?php echo esc_url( $card['image'] ); ?>" alt="<?php echo esc_attr( $card['title'] ); ?>" loading="lazy">
					<span class="gt-moment-card__overlay">
						<span class="gt-moment-card__title"><?php echo esc_html( $card['title'] ); ?></span>
					</span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
