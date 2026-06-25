<?php
/**
 * Gutenberg blok-patronen voor de homepage-secties.
 *
 * Hiermee kan de homepage ook met de blok-editor (Gutenberg) of een page
 * builder worden opgebouwd. De patronen volgen de huisstijl en de 6 secties.
 *
 * @package Geloofstegels
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function geloofstegels_register_pattern_category() {
	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category(
			'geloofstegels',
			array( 'label' => __( 'Geloofstegels', 'geloofstegels' ) )
		);
	}
}
add_action( 'init', 'geloofstegels_register_pattern_category' );

function geloofstegels_register_patterns() {
	if ( ! function_exists( 'register_block_pattern' ) ) {
		return;
	}

	// Sectie 1: Hero banner.
	register_block_pattern(
		'geloofstegels/hero',
		array(
			'title'      => __( 'Homepage – Hero banner', 'geloofstegels' ),
			'categories' => array( 'geloofstegels' ),
			'content'    => '<!-- wp:cover {"dimRatio":50,"overlayColor":"inktblauw","minHeight":72,"minHeightUnit":"vh","align":"full"} -->
<div class="wp-block-cover alignfull" style="min-height:72vh"><span aria-hidden="true" class="wp-block-cover__background has-inktblauw-background-color has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:heading {"level":1,"textColor":"wit"} --><h1 class="wp-block-heading has-wit-color has-text-color">Geloof voor iedere gelegenheid</h1><!-- /wp:heading --><!-- wp:paragraph {"textColor":"wit"} --><p class="has-wit-color has-text-color">Handgemaakte tegeltjes, posters en accessoires met bijbelteksten – voor elk bijzonder moment.</p><!-- /wp:paragraph --><!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"wit","textColor":"donkerblauw"} --><div class="wp-block-button"><a class="wp-block-button__link has-donkerblauw-color has-wit-background-color has-text-color has-background wp-element-button" href="/winkel/">Bekijk collectie</a></div><!-- /wp:button --><!-- wp:button {"className":"is-style-outline","textColor":"wit"} --><div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-wit-color has-text-color wp-element-button" href="/eigen-ontwerp/">Eigen ontwerp</a></div><!-- /wp:button --></div><!-- /wp:buttons --></div></div>
<!-- /wp:cover -->',
		)
	);

	// Sectie 2: Kies een moment (6-grid).
	register_block_pattern(
		'geloofstegels/moments',
		array(
			'title'      => __( 'Homepage – Kies een moment (grid)', 'geloofstegels' ),
			'categories' => array( 'geloofstegels' ),
			'content'    => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}}}} -->
<div class="wp-block-group alignfull" style="padding-top:5rem;padding-bottom:5rem"><!-- wp:heading {"textAlign":"center"} --><h2 class="wp-block-heading has-text-align-center">Kies een moment</h2><!-- /wp:heading --><!-- wp:columns --><div class="wp-block-columns"><!-- wp:column --><div class="wp-block-column"><!-- wp:image --><figure class="wp-block-image"><img alt="Geboorte"/><figcaption>Geboorte</figcaption></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:image --><figure class="wp-block-image"><img alt="Doop"/><figcaption>Doop</figcaption></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:image --><figure class="wp-block-image"><img alt="Huwelijk"/><figcaption>Huwelijk</figcaption></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns --><!-- wp:columns --><div class="wp-block-columns"><!-- wp:column --><div class="wp-block-column"><!-- wp:image --><figure class="wp-block-image"><img alt="Overlijden"/><figcaption>Overlijden</figcaption></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:image --><figure class="wp-block-image"><img alt="Kerst"/><figcaption>Kerst</figcaption></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:image --><figure class="wp-block-image"><img alt="Bemoediging"/><figcaption>Bemoediging</figcaption></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns --></div>
<!-- /wp:group -->',
		)
	);

	// Sectie 4: Populaire producten (WooCommerce shortcode-blok).
	register_block_pattern(
		'geloofstegels/popular-products',
		array(
			'title'      => __( 'Homepage – Populaire tegeltjes', 'geloofstegels' ),
			'categories' => array( 'geloofstegels' ),
			'content'    => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}}}} -->
<div class="wp-block-group alignfull" style="padding-top:5rem;padding-bottom:5rem"><!-- wp:heading {"textAlign":"center"} --><h2 class="wp-block-heading has-text-align-center">Populaire tegeltjes</h2><!-- /wp:heading --><!-- wp:shortcode -->[products limit="8" columns="4" orderby="popularity"]<!-- /wp:shortcode --></div>
<!-- /wp:group -->',
		)
	);

	// Sectie 5: Bijbeltekst van de week.
	register_block_pattern(
		'geloofstegels/verse',
		array(
			'title'      => __( 'Homepage – Bijbeltekst van de week', 'geloofstegels' ),
			'categories' => array( 'geloofstegels' ),
			'content'    => '<!-- wp:group {"align":"full","backgroundColor":"warm-beige","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}}}} -->
<div class="wp-block-group alignfull has-warm-beige-background-color has-background" style="padding-top:5rem;padding-bottom:5rem"><!-- wp:quote {"align":"center"} --><blockquote class="wp-block-quote has-text-align-center"><p>Wees sterk en moedig, laat je door niets weerhouden of ontmoedigen, want waar je ook gaat, de HEER, je God, staat je bij.</p><cite>Jozua 1:9</cite></blockquote><!-- /wp:quote --><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} --><div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"donkerblauw"} --><div class="wp-block-button"><a class="wp-block-button__link has-donkerblauw-background-color has-background wp-element-button" href="/winkel/">Bekijk deze tegel</a></div><!-- /wp:button --></div><!-- /wp:buttons --></div>
<!-- /wp:group -->',
		)
	);
}
add_action( 'init', 'geloofstegels_register_patterns' );
