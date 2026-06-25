<?php
/**
 * Reacties-template.
 *
 * @package Geloofstegels
 */

if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$gt_count = get_comments_number();
			printf(
				esc_html( _n( '%s reactie', '%s reacties', $gt_count, 'geloofstegels' ) ),
				esc_html( number_format_i18n( $gt_count ) )
			);
			?>
		</h2>
		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => 48,
				)
			);
			?>
		</ol>
		<?php the_comments_navigation(); ?>
	<?php endif; ?>

	<?php comment_form(); ?>
</div>
