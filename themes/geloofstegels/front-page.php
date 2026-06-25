<?php
/**
 * Homepage-template met de 6 vaste secties.
 *
 * Als de pagina die als "homepage" is ingesteld eigen blok-inhoud bevat,
 * wordt die getoond. Anders worden de standaard 6 secties opgebouwd uit
 * Customizer-instellingen, taxonomieën en WooCommerce-producten.
 *
 * @package Geloofstegels
 */

get_header();

// Als er een statische pagina met inhoud is gekoppeld, toon die inhoud bovenaan.
$gt_has_custom_content = false;
if ( is_page() && get_the_content() ) {
	$gt_has_custom_content = (bool) trim( wp_strip_all_tags( get_the_content() ) );
}

if ( $gt_has_custom_content ) :
	while ( have_posts() ) :
		the_post();
		?>
		<div class="gt-container gt-content"><div class="entry-content"><?php the_content(); ?></div></div>
		<?php
	endwhile;
else :
	// Sectie 1: Hero banner.
	get_template_part( 'template-parts/home/hero' );

	// Sectie 2: Kies een moment.
	get_template_part( 'template-parts/home/moments' );

	// Sectie 3: Inspiratie slider.
	get_template_part( 'template-parts/home/inspiration-slider' );

	// Sectie 4: Populaire tegeltjes.
	get_template_part( 'template-parts/home/popular-products' );

	// Sectie 5: Bijbeltekst van de week.
	get_template_part( 'template-parts/home/bible-verse' );

	// Sectie 6: Footer wordt geleverd door footer.php.
endif;

get_footer();
