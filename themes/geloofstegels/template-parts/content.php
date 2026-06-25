<?php
/**
 * Standaard content (lijst/archief).
 *
 * @package Geloofstegels
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php echo esc_html( get_the_date() ); ?> &middot; <?php the_author(); ?>
			</div>
		<?php endif; ?>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<a class="entry-thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
	<?php endif; ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

	<a class="gt-btn gt-btn--outline" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Lees verder', 'geloofstegels' ); ?></a>
</article>
