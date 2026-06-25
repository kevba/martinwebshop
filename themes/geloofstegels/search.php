<?php
/**
 * Zoekresultaten-template.
 *
 * Toont gecombineerde resultaten: producten (op naam + bijbeltekst-tags) en pagina's/berichten.
 *
 * @package Geloofstegels
 */

get_header();
?>

<div class="gt-container gt-content">
	<header class="gt-page-header">
		<h1 class="page-title">
			<?php
			/* translators: %s: zoekterm. */
			printf( esc_html__( 'Zoekresultaten voor: %s', 'geloofstegels' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
			?>
		</h1>
		<div style="max-width:560px;margin:1.5rem auto 0;"><?php get_search_form(); ?></div>
	</header>

	<main id="primary" class="site-main">
		<?php if ( have_posts() ) : ?>

			<?php
			// Splits producten van overige content voor nette weergave.
			$gt_products = array();
			$gt_other    = array();
			while ( have_posts() ) :
				the_post();
				if ( 'product' === get_post_type() ) {
					$gt_products[] = get_the_ID();
				} else {
					$gt_other[] = get_the_ID();
				}
			endwhile;
			?>

			<?php if ( ! empty( $gt_products ) && class_exists( 'WooCommerce' ) ) : ?>
				<h2><?php esc_html_e( 'Producten', 'geloofstegels' ); ?></h2>
				<ul class="products columns-4 gt-product-grid">
					<?php
					foreach ( $gt_products as $gt_pid ) {
						$GLOBALS['post'] = get_post( $gt_pid ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
						setup_postdata( $GLOBALS['post'] );
						wc_get_template_part( 'content', 'product' );
					}
					wp_reset_postdata();
					?>
				</ul>
			<?php endif; ?>

			<?php if ( ! empty( $gt_other ) ) : ?>
				<h2 style="margin-top:3rem;"><?php esc_html_e( 'Pagina\'s & artikelen', 'geloofstegels' ); ?></h2>
				<?php
				foreach ( $gt_other as $gt_oid ) {
					$GLOBALS['post'] = get_post( $gt_oid ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
					setup_postdata( $GLOBALS['post'] );
					get_template_part( 'template-parts/content', 'search' );
				}
				wp_reset_postdata();
				?>
			<?php endif; ?>

			<?php
			the_posts_pagination(
				array(
					'prev_text' => __( '&larr; Vorige', 'geloofstegels' ),
					'next_text' => __( 'Volgende &rarr;', 'geloofstegels' ),
				)
			);
			?>

		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
	</main>
</div>

<?php
get_footer();
