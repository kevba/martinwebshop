<?php
/**
 * 404 template.
 *
 * @package Geloofstegels
 */

get_header();
?>
<div class="gt-container gt-404">
	<h1><?php esc_html_e( 'Pagina niet gevonden', 'geloofstegels' ); ?></h1>
	<p><?php esc_html_e( 'Deze pagina bestaat niet (meer). Misschien helpt zoeken of ga terug naar de homepage.', 'geloofstegels' ); ?></p>
	<div style="max-width:480px;margin:2rem auto;"><?php get_search_form(); ?></div>
	<a class="gt-btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Naar de homepage', 'geloofstegels' ); ?></a>
</div>
<?php
get_footer();
