<?php
/**
 * Maatwerk menu-walker met ondersteuning voor dropdown-niveaus en de
 * knop-stijl voor het "Eigen ontwerp" menu-item.
 *
 * Voeg de CSS-class `menu-item-button` toe aan een menu-item (via het
 * "CSS Classes" veld in Weergave > Menu's) om het als knop te tonen.
 * De mobiele submenu-toggles worden in assets/js/navigation.js toegevoegd.
 *
 * @package Geloofstegels
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Geloofstegels_Walker_Nav_Menu extends Walker_Nav_Menu {

	/**
	 * Markeer items met submenu's voor styling en toegankelijkheid.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		if ( in_array( 'menu-item-has-children', (array) $item->classes, true ) ) {
			$item->classes[] = 'gt-has-dropdown';
		}

		parent::start_el( $output, $item, $depth, $args, $id );
	}
}
