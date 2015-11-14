<?php
/**
 * Functions to load files fro mthe partials directory also allows to send
 * custom partials to the files.
 *
 * @since 2.0.0
 *
 * @package Lean
 * @subpackage helpers
 */

namespace lean\inc\helpers;


/**
 */
function comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
	if ( 'pingback' === $comment->comment_type || 'trackback' === $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'digistarter' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'digistarter' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php if ( 0 != $args['avatar_size'] ) { echo get_avatar( $comment, $args['avatar_size'] ); } ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'digistarter' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'digistarter' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
					<?php edit_comment_link( __( 'Edit', 'digistarter' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-metadata -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'digistarter' ); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content" itemprop="comment">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				) ) );
			?>
		</article><!-- .comment-body -->

	<?php
	endif;
}
