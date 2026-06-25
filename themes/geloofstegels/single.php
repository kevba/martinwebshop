<?php
/**
 * Enkel bericht-template.
 *
 * @package Geloofstegels
 */

get_header();
?>

<div class="gt-container gt-content">
	<div class="gt-layout">
		<main id="primary" class="site-main">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'single' );

				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Vorige', 'geloofstegels' ) . '</span> <span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Volgende', 'geloofstegels' ) . '</span> <span class="nav-title">%title</span>',
					)
				);
			endwhile;
			?>
		</main>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php
get_footer();
