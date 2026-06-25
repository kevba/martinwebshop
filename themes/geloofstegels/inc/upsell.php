<?php
/**
 * Upsell-functionaliteit: "Houten houder" checkbox op tegeltjes-productpagina's.
 *
 * Werking:
 *  - Op de productpagina van een tegeltje (categorie "tegeltjes") verschijnt
 *    een nette checkbox: "Voeg een houten houder toe (+ €X,XX)".
 *  - Bij het toevoegen aan de winkelmand wordt, indien aangevinkt, automatisch
 *    het houder-product meegestuurd, gekoppeld aan het tegeltje.
 *
 * Het houder-product wordt gevonden via:
 *  1. De optie `geloofstegels_holder_product_id` (in te stellen in Customizer).
 *  2. Anders een product met SKU `houten-houder`.
 *
 * @package Geloofstegels
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Bepaal het ID van het houder-product.
 */
function geloofstegels_get_holder_id() {
	$id = absint( get_option( 'geloofstegels_holder_product_id' ) );
	if ( ! $id ) {
		$id = wc_get_product_id_by_sku( 'houten-houder' );
	}
	return apply_filters( 'geloofstegels_holder_product_id', $id );
}

/**
 * Controleer of een product een tegeltje is (categorie "tegeltjes").
 */
function geloofstegels_is_tegeltje( $product_id ) {
	$is = has_term( array( 'tegeltjes', 'tegeltje' ), 'product_cat', $product_id );
	return apply_filters( 'geloofstegels_is_tegeltje', $is, $product_id );
}

/**
 * Toon de upsell-checkbox vóór de "in winkelmand"-knop.
 */
function geloofstegels_render_holder_checkbox() {
	global $product;
	if ( ! $product instanceof WC_Product ) {
		return;
	}
	$holder_id = geloofstegels_get_holder_id();
	if ( ! $holder_id || $holder_id === $product->get_id() || ! geloofstegels_is_tegeltje( $product->get_id() ) ) {
		return;
	}

	$holder = wc_get_product( $holder_id );
	if ( ! $holder || ! $holder->is_in_stock() ) {
		return;
	}

	$price = wc_price( wc_get_price_to_display( $holder ) );
	?>
	<div class="gt-upsell">
		<label class="gt-upsell__label">
			<input type="checkbox" name="gt_add_holder" value="1" />
			<span class="gt-upsell__text">
				<strong><?php esc_html_e( 'Voeg een houten houder toe', 'geloofstegels' ); ?></strong>
				<span class="gt-upsell__price">+ <?php echo wp_kses_post( $price ); ?></span>
				<small><?php esc_html_e( 'Zet je tegeltje stijlvol neer op tafel, kast of vensterbank.', 'geloofstegels' ); ?></small>
			</span>
		</label>
	</div>
	<?php
}
add_action( 'woocommerce_before_add_to_cart_button', 'geloofstegels_render_holder_checkbox', 15 );

/**
 * Voeg de houten houder toe aan de winkelmand wanneer de checkbox is aangevinkt.
 */
function geloofstegels_add_holder_to_cart( $cart_item_data, $product_id, $variation_id ) {
	if ( isset( $_REQUEST['gt_add_holder'] ) && '1' === sanitize_text_field( wp_unslash( $_REQUEST['gt_add_holder'] ) ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		// Markeer het tegeltje zodat we de koppeling kunnen tonen.
		$cart_item_data['gt_has_holder'] = true;
	}
	return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'geloofstegels_add_holder_to_cart', 10, 3 );

/**
 * Nadat het tegeltje is toegevoegd, voeg ook de houder toe (zelfde aantal).
 */
function geloofstegels_after_add_to_cart( $cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data ) {
	if ( empty( $cart_item_data['gt_has_holder'] ) ) {
		return;
	}
	$holder_id = geloofstegels_get_holder_id();
	if ( ! $holder_id ) {
		return;
	}

	// Voorkom oneindige lus: koppel de houder aan het tegeltje en markeer apart.
	WC()->cart->add_to_cart(
		$holder_id,
		$quantity,
		0,
		array(),
		array(
			'gt_is_holder_for' => $cart_item_key,
		)
	);
}
add_action( 'woocommerce_add_to_cart', 'geloofstegels_after_add_to_cart', 10, 6 );

/**
 * Toon in de winkelmand dat de houder bij een tegeltje hoort.
 */
function geloofstegels_holder_cart_item_name( $name, $cart_item ) {
	if ( ! empty( $cart_item['gt_is_holder_for'] ) ) {
		$name .= ' <small class="gt-cart-note">(' . esc_html__( 'bij je tegeltje', 'geloofstegels' ) . ')</small>';
	}
	return $name;
}
add_filter( 'woocommerce_cart_item_name', 'geloofstegels_holder_cart_item_name', 10, 2 );

/**
 * Customizer-instelling voor het houder-product-ID.
 */
function geloofstegels_upsell_customizer( $wp_customize ) {
	$wp_customize->add_section(
		'gt_upsell',
		array(
			'title'       => __( 'Upsell – Houten houder', 'geloofstegels' ),
			'description' => __( 'Kies het product dat als "houten houder" wordt aangeboden bij tegeltjes. Laat leeg om het product met SKU "houten-houder" te gebruiken.', 'geloofstegels' ),
			'priority'    => 160,
		)
	);
	$wp_customize->add_setting( 'gt_holder_product_id_mod', array( 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control(
		'gt_holder_product_id_mod',
		array(
			'label'   => __( 'Product-ID van de houten houder', 'geloofstegels' ),
			'section' => 'gt_upsell',
			'type'    => 'number',
		)
	);
}
add_action( 'customize_register', 'geloofstegels_upsell_customizer' );

/**
 * Synchroniseer de Customizer-waarde naar de optie die de upsell gebruikt.
 */
function geloofstegels_sync_holder_option() {
	$mod = absint( get_theme_mod( 'gt_holder_product_id_mod' ) );
	if ( $mod ) {
		update_option( 'geloofstegels_holder_product_id', $mod );
	}
}
add_action( 'customize_save_after', 'geloofstegels_sync_holder_option' );
