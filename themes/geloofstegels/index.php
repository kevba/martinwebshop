<?php
/**
 * Hoofd-template (fallback / blog).
 *
 * @package Geloofstegels
 */

get_header();
?>

<div class="gt-container gt-content">
	<div class="gt-layout">
		<main id="primary" class="site-main">
			<?php if ( have_posts() ) : ?>

				<?php if ( ! is_front_page() && ( is_home() || is_archive() ) ) : ?>
					<header class="gt-page-header">
						<h1 class="page-title"><?php echo wp_kses_post( get_the_archive_title() ); ?></h1>
						<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
					</header>
				<?php endif; ?>

				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', get_post_type() );
				endwhile;

				the_posts_pagination(
					array(
						'prev_text' => __( '&larr; Vorige', 'geloofstegels' ),
						'next_text' => __( 'Volgende &rarr;', 'geloofstegels' ),
					)
				);

			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
		</main>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php
get_footer();
