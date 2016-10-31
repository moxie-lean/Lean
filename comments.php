<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Lean
 * @since 1.0.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div class="clear">

</div>
<div class="comments__area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments__title">
			<?php
			$message = sprintf(
				_nx(
					'One thought on &ldquo;%2$s&rdquo;',
					'%1$s thoughts on &ldquo;%2$s&rdquo;',
					get_comments_number(),
					'comments title',
					_TEXT_DOMAIN_
				),
				number_format_i18n( get_comments_number() ),
				'<span>' . get_the_title() . '</span>'
			);
			$allowed = [
				'span' => [],
			];
			echo wp_kses( $message, $allowed );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav class="comment__navigation" role="navigation">
			<h1 class="screen-reader-text">
				<?php esc_html_e( 'Comment navigation', _TEXT_DOMAIN_ ); ?>
			</h1>
			<div class="nav__previous">
				<?php
				previous_comments_link(
					esc_html_e( '&larr; Older Comments', _TEXT_DOMAIN_ )
				);
				?>
			</div>
			<div class="nav__next">
				<?php
				next_comments_link(
					esc_html_e( 'Newer Comments &rarr;', _TEXT_DOMAIN_ )
				);
				?>
			</div>
		</nav>
		<?php endif; ?>

		<ol class="comment__list">
			<?php wp_list_comments(); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav class="comment__navigation" role="navigation">
			<h1 class="screen-reader-text">
				<?php esc_html_e( 'Comment navigation', _TEXT_DOMAIN_ ); ?>
			</h1>
			<div class="nav__previous">
				<?php
				previous_comments_link(
					esc_html_e( '&larr; Older Comments', _TEXT_DOMAIN_ )
				);
				?>
			</div>
			<div class="nav__next">
				<?php
				next_comments_link(
					esc_html_e( 'Newer Comments &rarr;', _TEXT_DOMAIN_ )
				);
				?>
			</div>
		</nav>
		<?php endif; ?>

	<?php endif; ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open()
		&& 0 !== intval( get_comments_number() )
		&& post_type_supports( get_post_type(), 'comments' )
	) :
	?>
		<p class="no-comments">
			<?php esc_html_e( 'Comments are closed.', _TEXT_DOMAIN_ ); ?>
		</p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div>
