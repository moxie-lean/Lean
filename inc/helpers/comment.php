<?php namespace Leean\Inc\Helpers;

/**
 * Comment callback
 *
 * @param WP_Comment $comment	The comment.
 * @param array      $args		The arguments.
 * @param int        $depth		The depth of the comment.
 */
function comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	if ( 'pingback' === $comment->comment_type || 'trackback' === $comment->comment_type ) :
?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php esc_html_e( 'Pingback:', TRANSLATED_TEXT_DOMAIN ); ?>
			<?php comment_author_link(); ?>
			<?php edit_comment_link( __( 'Edit', TRANSLATED_TEXT_DOMAIN ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
				<?php
				if ( 0 !== absint( $args['avatar_size'] ) ) {
					echo get_avatar( $comment, $args['avatar_size'] );
				}
				$message = sprintf(
					__( '%s <span class="says">says:</span>', TRANSLATED_TEXT_DOMAIN ),
					sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() )
				);
				$allowed = array(
					'cite' => array(
						'class' => array(),
					),
					'a' => array(
						'href' => array(),
						'rel' => array(),
						'class' => array(),
					),
					'span' => array(
						'class' => array(),
					),
				);
				echo wp_kses( $message, $allowed );
				?>
				</div>

				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php
							$message = sprintf(
								_x( '%1$s at %2$s', '1: date, 2: time', TRANSLATED_TEXT_DOMAIN ),
								get_comment_date(),
								get_comment_time()
							);
							echo esc_html( $message );
							?>
						</time>
					</a>
					<?php edit_comment_link( __( 'Edit', TRANSLATED_TEXT_DOMAIN ), '<span class="edit-link">', '</span>' ); ?>
				</div>

				<?php if ( 0 === absint( $comment->comment_approved ) ) : ?>
				<p class="comment-awaiting-moderation">
					<?php esc_html_e( 'Your comment is awaiting moderation.', TRANSLATED_TEXT_DOMAIN ); ?>
				</p>
				<?php endif; ?>
			</footer>

			<div class="comment-content" itemprop="comment">
				<?php comment_text(); ?>
			</div>

			<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				) ) );
			?>
		</article>
<?php
endif;
}
