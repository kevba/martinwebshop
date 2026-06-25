<?php
/**
 * Maatwerk taxonomieën voor SEO-vriendelijke URL-structuur.
 *
 * - Momenten      => /momenten/doop/
 * - Inspiratie     => /inspiratie/hoop/
 * - Voor wie       => /voor-wie/papa/
 * - Bijbeltekst    => tags op producten (gebruikt door de zoekfunctie)
 *
 * Deze taxonomieën worden gekoppeld aan WooCommerce-producten. Werkt ook
 * zonder WooCommerce (dan gekoppeld aan berichten) zodat het thema niet breekt.
 *
 * @package Geloofstegels
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function geloofstegels_register_taxonomies() {
	$object_type = post_type_exists( 'product' ) ? 'product' : 'post';

	// Momenten (hiërarchisch, als categorie).
	register_taxonomy(
		'moment',
		$object_type,
		array(
			'labels'            => array(
				'name'          => __( 'Momenten', 'geloofstegels' ),
				'singular_name' => __( 'Moment', 'geloofstegels' ),
				'menu_name'     => __( 'Momenten', 'geloofstegels' ),
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array(
				'slug'         => 'momenten',
				'with_front'   => false,
				'hierarchical' => false,
			),
		)
	);

	// Inspiratie (thema-woorden).
	register_taxonomy(
		'inspiratie',
		$object_type,
		array(
			'labels'            => array(
				'name'          => __( 'Inspiratie', 'geloofstegels' ),
				'singular_name' => __( 'Inspiratiethema', 'geloofstegels' ),
				'menu_name'     => __( 'Inspiratie', 'geloofstegels' ),
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array(
				'slug'       => 'inspiratie',
				'with_front' => false,
			),
		)
	);

	// Voor wie (doelgroep).
	register_taxonomy(
		'doelgroep',
		$object_type,
		array(
			'labels'            => array(
				'name'          => __( 'Voor wie', 'geloofstegels' ),
				'singular_name' => __( 'Doelgroep', 'geloofstegels' ),
				'menu_name'     => __( 'Voor wie', 'geloofstegels' ),
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array(
				'slug'       => 'voor-wie',
				'with_front' => false,
			),
		)
	);

	// Bijbeltekst-tags (niet-hiërarchisch) – gebruikt door de zoekfunctie.
	register_taxonomy(
		'bijbeltekst',
		$object_type,
		array(
			'labels'            => array(
				'name'          => __( 'Bijbelteksten', 'geloofstegels' ),
				'singular_name' => __( 'Bijbeltekst', 'geloofstegels' ),
				'menu_name'     => __( 'Bijbelteksten', 'geloofstegels' ),
			),
			'hierarchical'      => false,
			'public'            => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array(
				'slug'       => 'bijbeltekst',
				'with_front' => false,
			),
		)
	);
}
add_action( 'init', 'geloofstegels_register_taxonomies' );

/**
 * Flush rewrite rules bij thema-activatie zodat de nieuwe URL's werken.
 */
function geloofstegels_rewrite_flush() {
	geloofstegels_register_taxonomies();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'geloofstegels_rewrite_flush' );
