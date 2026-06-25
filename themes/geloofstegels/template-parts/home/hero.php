<?php
/**
 * Homepage sectie 1: Hero banner.
 *
 * @package Geloofstegels
 */

$gt_title    = get_theme_mod( 'gt_hero_title', __( 'Geloof voor iedere gelegenheid', 'geloofstegels' ) );
$gt_subtitle = get_theme_mod( 'gt_hero_subtitle', __( 'Handgemaakte tegeltjes, posters en accessoires met bijbelteksten – voor elk bijzonder moment.', 'geloofstegels' ) );
$gt_btn1_t   = get_theme_mod( 'gt_hero_btn1_text', __( 'Bekijk collectie', 'geloofstegels' ) );
$gt_btn1_u   = get_theme_mod( 'gt_hero_btn1_url', '/winkel/' );
$gt_btn2_t   = get_theme_mod( 'gt_hero_btn2_text', __( 'Eigen ontwerp', 'geloofstegels' ) );
$gt_btn2_u   = get_theme_mod( 'gt_hero_btn2_url', '/eigen-ontwerp/' );

$gt_image_id  = get_theme_mod( 'gt_hero_image' );
$gt_image_url = $gt_image_id ? wp_get_attachment_image_url( $gt_image_id, 'gt-hero' ) : GELOOFSTEGELS_URI . '/assets/images/hero-placeholder.jpg';
?>
<section class="gt-hero" style="background-image:url('<?php echo esc_url( $gt_image_url ); ?>');">
	<div class="gt-container">
		<div class="gt-hero__inner">
			<h1><?php echo esc_html( $gt_title ); ?></h1>
			<p><?php echo esc_html( $gt_subtitle ); ?></p>
			<div class="gt-hero__buttons">
				<?php if ( $gt_btn1_t ) : ?>
					<a class="gt-btn gt-btn--light" href="<?php echo esc_url( $gt_btn1_u ); ?>"><?php echo esc_html( $gt_btn1_t ); ?></a>
				<?php endif; ?>
				<?php if ( $gt_btn2_t ) : ?>
					<a class="gt-btn gt-btn--outline gt-btn--on-dark" href="<?php echo esc_url( $gt_btn2_u ); ?>" style="border-color:#fff;color:#fff;"><?php echo esc_html( $gt_btn2_t ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
