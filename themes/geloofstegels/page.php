<?php
/**
 * Pagina-template.
 *
 * @package Geloofstegels
 */

get_header();
?>

<div class="gt-container gt-content">
	<div class="gt-layout gt-layout--full">
		<main id="primary" class="site-main">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="gt-page-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="entry-thumbnail"><?php the_post_thumbnail( 'large' ); ?></div>
					<?php endif; ?>

					<div class="entry-content">
						<?php
						the_content();
						wp_link_pages(
							array(
								'before' => '<div class="page-links">' . esc_html__( 'Pagina\'s:', 'geloofstegels' ),
								'after'  => '</div>',
							)
						);
						?>
					</div>
				</article>

				<?php
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			endwhile;
			?>
		</main>
	</div>
</div>

<?php
get_footer();
