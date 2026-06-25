<?php
/**
 * Homepage sectie 5: Bijbeltekst van de week (paginabreed beige blok).
 *
 * @package Geloofstegels
 */

$gt_text = get_theme_mod( 'gt_verse_text', __( 'Wees sterk en moedig, laat je door niets weerhouden of ontmoedigen, want waar je ook gaat, de HEER, je God, staat je bij.', 'geloofstegels' ) );
$gt_ref  = get_theme_mod( 'gt_verse_ref', __( 'Jozua 1:9', 'geloofstegels' ) );
$gt_btn  = get_theme_mod( 'gt_verse_btn', __( 'Bekijk deze tegel', 'geloofstegels' ) );
$gt_url  = get_theme_mod( 'gt_verse_url', '/winkel/' );
?>
<section class="gt-verse">
	<div class="gt-verse__inner">
		<span class="gt-eyebrow"><?php esc_html_e( 'Bijbeltekst van de week', 'geloofstegels' ); ?></span>
		<blockquote class="gt-verse__quote">&ldquo;<?php echo esc_html( $gt_text ); ?>&rdquo;</blockquote>
		<cite class="gt-verse__ref"><?php echo esc_html( $gt_ref ); ?></cite>
		<?php if ( $gt_btn ) : ?>
			<div><a class="gt-btn" href="<?php echo esc_url( $gt_url ); ?>"><?php echo esc_html( $gt_btn ); ?></a></div>
		<?php endif; ?>
	</div>
</section>
