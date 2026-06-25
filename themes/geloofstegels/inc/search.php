<?php
/**
 * Krachtige zoekfunctie.
 *
 * Standaard WordPress zoekt enkel in titel/inhoud. Deze module breidt de
 * zoekopdracht uit zodat ook gezocht wordt op:
 *  - Productnaam en -omschrijving (WooCommerce-producten worden meegenomen).
 *  - Termen in de taxonomie `bijbeltekst` (bijbeltekst-tags).
 *  - Termen in de taxonomieën `moment` en `inspiratie`.
 *
 * @package Geloofstegels
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Zorg dat producten meegenomen worden in de zoekresultaten.
 */
function geloofstegels_search_post_types( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_search() ) {
		return;
	}

	$post_types = array( 'post', 'page' );
	if ( post_type_exists( 'product' ) ) {
		$post_types[] = 'product';
	}
	$query->set( 'post_type', $post_types );
}
add_action( 'pre_get_posts', 'geloofstegels_search_post_types' );

/**
 * Verzamel post-ID's die matchen op taxonomie-termen (bijbeltekst, moment,
 * inspiratie) en voeg ze toe aan de zoekresultaten via een posts_search filter.
 */
function geloofstegels_search_taxonomy_join( $search, $wp_query ) {
	global $wpdb;

	if ( is_admin() || empty( $search ) || ! $wp_query->is_search() || ! $wp_query->is_main_query() ) {
		return $search;
	}

	$term = $wp_query->get( 's' );
	if ( empty( $term ) ) {
		return $search;
	}

	// Zoek bijpassende termen in onze taxonomieën.
	$taxonomies = array( 'bijbeltekst', 'moment', 'inspiratie', 'doelgroep' );
	$object_ids = array();

	$found_terms = get_terms(
		array(
			'taxonomy'   => $taxonomies,
			'name__like' => $term,
			'hide_empty' => false,
		)
	);

	if ( ! is_wp_error( $found_terms ) && ! empty( $found_terms ) ) {
		foreach ( $found_terms as $found_term ) {
			$objects = get_objects_in_term( $found_term->term_id, $found_term->taxonomy );
			if ( ! is_wp_error( $objects ) ) {
				$object_ids = array_merge( $object_ids, $objects );
			}
		}
	}

	$object_ids = array_unique( array_map( 'absint', $object_ids ) );

	if ( empty( $object_ids ) ) {
		return $search;
	}

	// Voeg de gevonden ID's als OR-conditie toe aan de bestaande WHERE-clause.
	$ids_sql = implode( ',', $object_ids );

	// $search begint met " AND (...)". We breiden uit met een OR op post-ID.
	$search = preg_replace(
		'/^\s*AND\s*\((.*)\)\s*$/is',
		" AND ( $1 OR {$wpdb->posts}.ID IN ($ids_sql) )",
		$search
	);

	return $search;
}
add_filter( 'posts_search', 'geloofstegels_search_taxonomy_join', 10, 2 );

/**
 * Voorkom dubbele resultaten.
 */
function geloofstegels_search_distinct( $distinct, $wp_query ) {
	if ( $wp_query->is_search() && $wp_query->is_main_query() ) {
		return 'DISTINCT';
	}
	return $distinct;
}
add_filter( 'posts_distinct', 'geloofstegels_search_distinct', 10, 2 );
