<?php
/**
 * Template part for displaying posts.
 *
 * @package Lean
 * @subpackage partials
 * @since 1.0.0
 */

?>

<?php tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>
		itemscope itemType="http://schema.org/BlogPosting">
	<?php tha_entry_top(); ?>
	<header class="entry__header">

		<h1 class="entry__title" itemprop="name">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h1>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry__meta">
			<span itemprop="dateModified" style="display:none;">
				Last modified: <?php the_modified_date(); ?>
			</span>
		</div>
		<?php endif; ?>
	</header>

	<?php if ( is_search() ) : ?>
	<div class="entry-summary" itemprop="description">
		<?php the_excerpt(); ?>
	</div>
	<?php else : ?>
	<div class="entry__content" itemprop="articleBody">
		<?php
			the_content( sprintf(
				esc_html__( 'Continue reading%s &rarr;', TRANSLATED_TEXT_DOMAIN ),
				'<span class="screen-reader-text">  '.get_the_title().'</span>'
			)  );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', TRANSLATED_TEXT_DOMAIN ),
				'after'  => '</div>',
			) );
		?>
	</div>
	<?php endif; ?>

	<footer class="entry__meta" itemprop="keywords">
		<?php if ( ! post_password_required() && ( comments_open() || 0 !== get_comments_number() ) ) : ?>
		<span class="comments__link" itemprop="comment" >
		<?php
			comments_popup_link(
				esc_html__( 'Leave a comment', TRANSLATED_TEXT_DOMAIN ),
				esc_html__( '1 Comment', TRANSLATED_TEXT_DOMAIN ),
				esc_html__( '% Comments', TRANSLATED_TEXT_DOMAIN )
			);
		?>
		</span>
		<?php endif; ?>

		- <?php
			edit_post_link(
				esc_html__( 'Edit', TRANSLATED_TEXT_DOMAIN ),
				'<span class="edit-link">', '</span>'
			);
		?>
	</footer>
	<?php tha_entry_bottom(); ?>
</article>
<?php tha_entry_after(); ?>
