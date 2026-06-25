<?php
/**
 * Customizer-instellingen voor de homepage-secties en huisstijl.
 *
 * @package Geloofstegels
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function geloofstegels_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	/* ===== Panel: Homepage ===== */
	$wp_customize->add_panel(
		'geloofstegels_home',
		array(
			'title'    => __( 'Geloofstegels – Homepage', 'geloofstegels' ),
			'priority' => 30,
		)
	);

	/* --- Sectie: Hero --- */
	$wp_customize->add_section(
		'gt_hero',
		array(
			'title' => __( '1. Hero banner', 'geloofstegels' ),
			'panel' => 'geloofstegels_home',
		)
	);

	$hero_defaults = array(
		'gt_hero_title'       => __( 'Geloof voor iedere gelegenheid', 'geloofstegels' ),
		'gt_hero_subtitle'    => __( 'Handgemaakte tegeltjes, posters en accessoires met bijbelteksten – voor elk bijzonder moment.', 'geloofstegels' ),
		'gt_hero_btn1_text'   => __( 'Bekijk collectie', 'geloofstegels' ),
		'gt_hero_btn1_url'    => '/winkel/',
		'gt_hero_btn2_text'   => __( 'Eigen ontwerp', 'geloofstegels' ),
		'gt_hero_btn2_url'    => '/eigen-ontwerp/',
	);

	foreach ( $hero_defaults as $key => $default ) {
		$wp_customize->add_setting( $key, array( 'default' => $default, 'sanitize_callback' => 'wp_kses_post' ) );
		$wp_customize->add_control(
			$key,
			array(
				'label'   => ucfirst( str_replace( array( 'gt_hero_', '_' ), array( '', ' ' ), $key ) ),
				'section' => 'gt_hero',
				'type'    => ( false !== strpos( $key, 'url' ) ) ? 'url' : 'text',
			)
		);
	}

	$wp_customize->add_setting( 'gt_hero_image', array( 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control(
		new WP_Customize_Cropped_Image_Control(
			$wp_customize,
			'gt_hero_image',
			array(
				'label'   => __( 'Hero achtergrondfoto', 'geloofstegels' ),
				'section' => 'gt_hero',
				'width'   => 1920,
				'height'  => 1080,
			)
		)
	);

	/* --- Sectie: Bijbeltekst van de week --- */
	$wp_customize->add_section(
		'gt_verse',
		array(
			'title' => __( '5. Bijbeltekst van de week', 'geloofstegels' ),
			'panel' => 'geloofstegels_home',
		)
	);

	$verse_defaults = array(
		'gt_verse_text' => __( 'Wees sterk en moedig, laat je door niets weerhouden of ontmoedigen, want waar je ook gaat, de HEER, je God, staat je bij.', 'geloofstegels' ),
		'gt_verse_ref'  => __( 'Jozua 1:9', 'geloofstegels' ),
		'gt_verse_btn'  => __( 'Bekijk deze tegel', 'geloofstegels' ),
		'gt_verse_url'  => '/winkel/',
	);
	foreach ( $verse_defaults as $key => $default ) {
		$wp_customize->add_setting( $key, array( 'default' => $default, 'sanitize_callback' => 'wp_kses_post' ) );
		$wp_customize->add_control(
			$key,
			array(
				'label'   => ucfirst( str_replace( array( 'gt_verse_', '_' ), array( '', ' ' ), $key ) ),
				'section' => 'gt_verse',
				'type'    => ( 'gt_verse_text' === $key ) ? 'textarea' : ( ( false !== strpos( $key, 'url' ) ) ? 'url' : 'text' ),
			)
		);
	}

	/* --- Sectie: Populaire producten --- */
	$wp_customize->add_section(
		'gt_popular',
		array(
			'title' => __( '4. Populaire tegeltjes', 'geloofstegels' ),
			'panel' => 'geloofstegels_home',
		)
	);
	$wp_customize->add_setting( 'gt_popular_count', array( 'default' => 8, 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control(
		'gt_popular_count',
		array(
			'label'       => __( 'Aantal producten', 'geloofstegels' ),
			'description' => __( 'Aantal bestsellers in de productgrid (standaard 8).', 'geloofstegels' ),
			'section'     => 'gt_popular',
			'type'        => 'number',
		)
	);
}
add_action( 'customize_register', 'geloofstegels_customize_register' );

/**
 * Live preview JS voor titel/omschrijving.
 */
function geloofstegels_customize_preview_js() {
	wp_enqueue_script( 'geloofstegels-customizer', GELOOFSTEGELS_URI . '/assets/js/customizer.js', array( 'customize-preview' ), GELOOFSTEGELS_VERSION, true );
}
add_action( 'customize_preview_init', 'geloofstegels_customize_preview_js' );
