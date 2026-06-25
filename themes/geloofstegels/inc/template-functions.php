<?php
/**
 * Algemene template-helpers.
 *
 * @package Geloofstegels
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Body-classes uitbreiden.
 */
function geloofstegels_body_classes( $classes ) {
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}
	return $classes;
}
add_filter( 'body_class', 'geloofstegels_body_classes' );

/**
 * Pingback-header.
 */
function geloofstegels_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'geloofstegels_pingback_header' );

/**
 * Excerpt-lengte en "lees verder".
 */
function geloofstegels_excerpt_length( $length ) {
	return 28;
}
add_filter( 'excerpt_length', 'geloofstegels_excerpt_length' );

function geloofstegels_excerpt_more( $more ) {
	return '…';
}
add_filter( 'excerpt_more', 'geloofstegels_excerpt_more' );

/**
 * Afbeeldingsformaten registreren.
 */
function geloofstegels_image_sizes() {
	add_image_size( 'gt-moment', 600, 450, true );   // Moment-kaarten.
	add_image_size( 'gt-hero', 1920, 1080, true );    // Hero banner.
}
add_action( 'after_setup_theme', 'geloofstegels_image_sizes' );
