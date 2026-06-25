<?php
/**
 * Enkel bericht content.
 *
 * @package Geloofstegels
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="gt-page-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta"><?php echo esc_html( get_the_date() ); ?> &middot; <?php the_author(); ?></div>
		<?php endif; ?>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-thumbnail"><?php the_post_thumbnail( 'large' ); ?></div>
	<?php endif; ?>

	<div class="entry-content">
		<?php
		the_content();
		wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( "Pagina's:", 'geloofstegels' ), 'after' => '</div>' ) );
		?>
	</div>

	<footer class="entry-footer">
		<?php
		the_tags( '<span class="tags-links">' . esc_html__( 'Tags:', 'geloofstegels' ) . ' ', ', ', '</span>' );
		?>
	</footer>
</article>
