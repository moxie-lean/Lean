<?php
/**
 * Template part for displaying video post formats.
 * @package lean
 */

?>

<?php tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>
		itemscope itemprop="video" itemtype="http://schema.org/VideoObject">
	<?php tha_entry_top(); ?>
	<header class="entry-header">
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h1>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<span class="genericon genericon-time"></span>
		</div>
		<?php endif; ?>
	</header>

	<?php if ( is_search() ) : ?>
	<?php // Only display Excerpts for Search. ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
	<?php else : ?>
	<div class="entry-content">
		<?php
			the_content( sprintf(
				esc_html__( 'Continue reading%s &rarr;', TRANSLATED_TEXT_DOMAIN ),
				'<span class="screen-reader-text">  '.get_the_title().'</span>'
			) );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html_e( 'Pages:', TRANSLATED_TEXT_DOMAIN ),
				'after'  => '</div>',
			) );
		?>
	</div>
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' === get_post_type() ) : ?>
			<?php
			/**
			 * Translators: used between list items, there is a space after the comma
			 * */
			$categories_list = get_the_category_list( esc_html_e( ', ', TRANSLATED_TEXT_DOMAIN ) );
			if ( $categories_list  ) :
			?>
			<span class="cat-links">
			<?php
				wp_kses(
					sprintf(
						esc_html__( 'Posted in %1$s', TRANSLATED_TEXT_DOMAIN ),
						$categories_list
					),
					array()
				);
			?>
			</span>
			<?php endif; ?>

			<?php
			/**
			 * Translators: used between list items, there is a space after the comma
			 * */
			$tags_list = get_the_tag_list( '', esc_html_e( ', ', TRANSLATED_TEXT_DOMAIN ) );
			if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php
				wp_kses(
					sprintf(
						esc_html__( 'Tagged %1$s', TRANSLATED_TEXT_DOMAIN ), $tags_list
					),
					array()
				);
				?>
			</span>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( ! post_password_required() && ( comments_open() || 0 !== get_comments_number() ) ) : ?>
		<span class="comments-link">
		<?php
			comments_popup_link(
				esc_html__( 'Leave a comment', TRANSLATED_TEXT_DOMAIN ),
				esc_html__( '1 Comment', TRANSLATED_TEXT_DOMAIN ),
				esc_html__( '% Comments', TRANSLATED_TEXT_DOMAIN )
			);
		?>
		</span>
		<?php endif; ?>
		<?php
			edit_post_link(
				esc_html__( 'Edit', TRANSLATED_TEXT_DOMAIN ),
				'<span class="edit-link">', '</span>'
			);
		?>
	</footer>
	<?php tha_entry_bottom(); ?>
</article>
<?php tha_entry_after(); ?>
