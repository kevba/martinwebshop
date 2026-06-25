<?php
/**
 * Geloofstegels thema functies en setup.
 *
 * @package Geloofstegels
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Directe toegang voorkomen.
}

define( 'GELOOFSTEGELS_VERSION', '1.0.0' );
define( 'GELOOFSTEGELS_DIR', get_template_directory() );
define( 'GELOOFSTEGELS_URI', get_template_directory_uri() );

/**
 * Thema ondersteuning en setup.
 */
function geloofstegels_setup() {
	// Vertalingen laden.
	load_theme_textdomain( 'geloofstegels', GELOOFSTEGELS_DIR . '/languages' );

	// Standaard WordPress functies.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'customize-selective-refresh-widgets' );

	// HTML5 markup.
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);

	// Logo upload via Customizer.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 240,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Gutenberg / blok-editor ondersteuning.
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor-style.css' );

	// Huisstijl kleurenpalet voor de blok-editor.
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => __( 'Donkerblauw', 'geloofstegels' ),
				'slug'  => 'donkerblauw',
				'color' => '#1E3A6E',
			),
			array(
				'name'  => __( 'Warm beige', 'geloofstegels' ),
				'slug'  => 'warm-beige',
				'color' => '#F0E8D8',
			),
			array(
				'name'  => __( 'Wit', 'geloofstegels' ),
				'slug'  => 'wit',
				'color' => '#FFFFFF',
			),
			array(
				'name'  => __( 'Inktblauw', 'geloofstegels' ),
				'slug'  => 'inktblauw',
				'color' => '#14264A',
			),
			array(
				'name'  => __( 'Zachtgrijs', 'geloofstegels' ),
				'slug'  => 'zachtgrijs',
				'color' => '#6B7280',
			),
		)
	);

	// Navigatiemenu's registreren.
	register_nav_menus(
		array(
			'primary'        => __( 'Hoofdmenu', 'geloofstegels' ),
			'footer-shop'    => __( 'Footer – Producten', 'geloofstegels' ),
			'footer-moments' => __( 'Footer – Momenten', 'geloofstegels' ),
			'footer-inspo'   => __( 'Footer – Inspiratie', 'geloofstegels' ),
			'footer-service' => __( 'Footer – Klantenservice', 'geloofstegels' ),
			'footer-business' => __( 'Footer – Zakelijk & Algemeen', 'geloofstegels' ),
		)
	);

	// WooCommerce ondersteuning.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'geloofstegels_setup' );

/**
 * Inhoudsbreedte.
 */
function geloofstegels_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'geloofstegels_content_width', 1200 );
}
add_action( 'after_setup_theme', 'geloofstegels_content_width', 0 );

/**
 * Scripts en styles inladen.
 */
function geloofstegels_scripts() {
	// Google Fonts: Playfair Display (koppen) + Inter (broodtekst).
	wp_enqueue_style(
		'geloofstegels-fonts',
		'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Inter:wght@300;400;500;600&display=swap',
		array(),
		null
	);

	// Hoofd-stylesheet (thema-header).
	wp_enqueue_style( 'geloofstegels-style', get_stylesheet_uri(), array(), GELOOFSTEGELS_VERSION );

	// Huisstijl CSS.
	wp_enqueue_style( 'geloofstegels-main', GELOOFSTEGELS_URI . '/assets/css/main.css', array( 'geloofstegels-style' ), GELOOFSTEGELS_VERSION );

	// WooCommerce styling alleen op shop-pagina's.
	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_style( 'geloofstegels-woocommerce', GELOOFSTEGELS_URI . '/assets/css/woocommerce.css', array( 'geloofstegels-main' ), GELOOFSTEGELS_VERSION );
	}

	// Navigatie + slider + algemene JS.
	wp_enqueue_script( 'geloofstegels-navigation', GELOOFSTEGELS_URI . '/assets/js/navigation.js', array(), GELOOFSTEGELS_VERSION, true );
	wp_enqueue_script( 'geloofstegels-slider', GELOOFSTEGELS_URI . '/assets/js/slider.js', array(), GELOOFSTEGELS_VERSION, true );
	wp_enqueue_script( 'geloofstegels-main', GELOOFSTEGELS_URI . '/assets/js/main.js', array(), GELOOFSTEGELS_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'geloofstegels_scripts' );

/**
 * Widget-gebieden registreren.
 */
function geloofstegels_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Zijbalk', 'geloofstegels' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Voeg widgets toe aan de zijbalk.', 'geloofstegels' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Winkel zijbalk', 'geloofstegels' ),
			'id'            => 'shop-sidebar',
			'description'   => __( 'Filters en widgets voor WooCommerce categorie- en winkelpagina\'s.', 'geloofstegels' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'geloofstegels_widgets_init' );

// Losse modules.
require GELOOFSTEGELS_DIR . '/inc/template-functions.php';
require GELOOFSTEGELS_DIR . '/inc/customizer.php';
require GELOOFSTEGELS_DIR . '/inc/menu-walker.php';
require GELOOFSTEGELS_DIR . '/inc/blocks.php';
require GELOOFSTEGELS_DIR . '/inc/search.php';
require GELOOFSTEGELS_DIR . '/inc/taxonomies.php';

if ( class_exists( 'WooCommerce' ) ) {
	require GELOOFSTEGELS_DIR . '/inc/woocommerce.php';
	require GELOOFSTEGELS_DIR . '/inc/upsell.php';
}
