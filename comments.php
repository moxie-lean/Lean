<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to digistarter_comment() which is
 * located in the inc/template-tags.php file.
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

<?php tha_comments_before(); ?>
<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$message = sprintf(
				_nx(
					'One thought on &ldquo;%2$s&rdquo;',
					'%1$s thoughts on &ldquo;%2$s&rdquo;',
					get_comments_number(),
					'comments title',
					TRANSLATED_TEXT_DOMAIN
				),
				number_format_i18n( get_comments_number() ),
				'<span>' . get_the_title() . '</span>'
			);
			$allowed = array(
				'span' => array(),
			);
			echo wp_kses( $message, $allowed );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text">
				<?php esc_html_e( 'Comment navigation', TRANSLATED_TEXT_DOMAIN ); ?>
			</h1>
			<div class="nav-previous">
				<?php
				previous_comments_link(
					esc_html_e( '&larr; Older Comments', TRANSLATED_TEXT_DOMAIN )
				);
				?>
			</div>
			<div class="nav-next">
				<?php
				next_comments_link(
					esc_html_e( 'Newer Comments &rarr;', TRANSLATED_TEXT_DOMAIN )
				);
				?>
			</div>
		</nav>
		<?php endif; ?>

		<ol class="comment-list">
		<?php wp_list_comments( array( 'callback' => 'lean\inc\helpers\comment' ) ); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text">
				<?php esc_html_e( 'Comment navigation', TRANSLATED_TEXT_DOMAIN ); ?>
			</h1>
			<div class="nav-previous">
				<?php
				previous_comments_link(
					esc_html_e( '&larr; Older Comments', TRANSLATED_TEXT_DOMAIN )
				);
				?>
			</div>
			<div class="nav-next">
				<?php
				next_comments_link(
					esc_html_e( 'Newer Comments &rarr;', TRANSLATED_TEXT_DOMAIN )
				);
				?>
			</div>
		</nav>
		<?php endif; ?>

	<?php endif; ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open()
		&& '0' !== intval( get_comments_number() )
		&& post_type_supports( get_post_type(), 'comments' )
	) :
	?>
		<p class="no-comments">
			<?php esc_html_e( 'Comments are closed.', TRANSLATED_TEXT_DOMAIN ); ?>
		</p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div>
<?php tha_comments_after(); ?>
