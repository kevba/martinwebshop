<?php
/**
 * WooCommerce-integratie en aanpassingen aan de huisstijl.
 *
 * @package Geloofstegels
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Standaard WooCommerce-wrappers verwijderen en eigen wrappers gebruiken.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

function geloofstegels_woo_wrapper_start() {
	echo '<div class="gt-container gt-content"><div class="gt-layout' . ( is_active_sidebar( 'shop-sidebar' ) && ( is_shop() || is_product_category() || is_product_taxonomy() ) ? '' : ' gt-layout--full' ) . '"><main id="primary" class="site-main woocommerce-main">';
}
add_action( 'woocommerce_before_main_content', 'geloofstegels_woo_wrapper_start', 10 );

function geloofstegels_woo_wrapper_end() {
	echo '</main>';
	if ( ( is_shop() || is_product_category() || is_product_taxonomy() ) && is_active_sidebar( 'shop-sidebar' ) ) {
		echo '<aside class="widget-area shop-sidebar">';
		dynamic_sidebar( 'shop-sidebar' );
		echo '</aside>';
	}
	echo '</div></div>';
}
add_action( 'woocommerce_after_main_content', 'geloofstegels_woo_wrapper_end', 10 );

/**
 * Producten per rij: 4 (homepage en winkel).
 */
add_filter( 'loop_shop_columns', function () { return 4; }, 20 );

/**
 * Aantal producten per pagina.
 */
add_filter( 'loop_shop_per_page', function () { return 12; }, 20 );

/**
 * Winkelmand-teller in de header live bijwerken.
 */
function geloofstegels_cart_fragments( $fragments ) {
	$count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
	$fragments['span.header-cart__count'] = '<span class="header-cart__count">' . esc_html( $count ) . '</span>';
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'geloofstegels_cart_fragments' );

/**
 * Breadcrumb-scheiding en wrapper aanpassen.
 */
add_filter(
	'woocommerce_breadcrumb_defaults',
	function ( $defaults ) {
		$defaults['delimiter']   = ' <span class="gt-bc-sep">/</span> ';
		$defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb gt-container">';
		return $defaults;
	}
);

/**
 * "Toevoegen aan winkelmand" tekst verfraaien.
 */
add_filter( 'woocommerce_product_add_to_cart_text', function ( $text ) {
	return __( 'In winkelmand', 'geloofstegels' );
} );

/**
 * Resultaatcount en sortering netjes plaatsen.
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

/**
 * Sidebar voor winkelpagina's gebruiken.
 */
add_action( 'after_setup_theme', function () {
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
} );

/**
 * Categorie-pagina: introductie tonen op basis van de term-omschrijving (al
 * standaard) plus een nette koptekst. We voegen een eyebrow toe.
 */
add_action( 'woocommerce_archive_description', 'geloofstegels_category_eyebrow', 1 );
function geloofstegels_category_eyebrow() {
	if ( is_product_category() ) {
		echo '<span class="gt-eyebrow">' . esc_html__( 'Categorie', 'geloofstegels' ) . '</span>';
	} elseif ( is_tax( 'moment' ) ) {
		echo '<span class="gt-eyebrow">' . esc_html__( 'Moment', 'geloofstegels' ) . '</span>';
	} elseif ( is_tax( 'inspiratie' ) ) {
		echo '<span class="gt-eyebrow">' . esc_html__( 'Inspiratie', 'geloofstegels' ) . '</span>';
	}
}

/**
 * Zorg dat producten met onze maatwerk-taxonomieën (moment/inspiratie/
 * doelgroep) ook op die archief-pagina's verschijnen als WooCommerce-loop.
 */
add_action( 'pre_get_posts', function ( $q ) {
	if ( is_admin() || ! $q->is_main_query() ) {
		return;
	}
	if ( $q->is_tax( array( 'moment', 'inspiratie', 'doelgroep', 'bijbeltekst' ) ) ) {
		$q->set( 'post_type', 'product' );
	}
} );
