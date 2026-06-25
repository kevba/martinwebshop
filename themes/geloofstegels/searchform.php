<?php
/**
 * Maatwerk zoekformulier.
 *
 * @package Geloofstegels
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="gt-s"><?php esc_html_e( 'Zoeken naar:', 'geloofstegels' ); ?></label>
	<input type="search" id="gt-s" class="search-field" placeholder="<?php esc_attr_e( 'Zoek op product of bijbeltekst…', 'geloofstegels' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
	<button type="submit" class="search-submit"><?php esc_html_e( 'Zoeken', 'geloofstegels' ); ?></button>
</form>
