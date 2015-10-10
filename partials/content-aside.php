<?php
/**
 * Template part for displaying aside post format.
 * @package Lean
 */

?>

<?php tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>
	itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
	<?php tha_entry_top(); ?>
	<header class="entry-header">
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h1>
	</header>

	<div class="entry-content">
		<?php
			the_content( sprintf(
				esc_html__( 'Continue reading%s &rarr;', 'digistarter' ),
				'<span class="screen-reader-text">  ' .get_the_title() . '</span>'
			)  );
		?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', TRANSLATED_TEXT_DOMAIN ) . '</span>',
				'after' => '</div>',
				'link_before' => '<span>',
				'link_after' => '</span>',
			)
		);
		?>
	</div>

	<footer class="entry-meta">
		<?php if ( is_single() ) : ?>
			<?php
				edit_post_link(
					esc_html__( 'Edit', TRANSLATED_TEXT_DOMAIN ),
					'<span class="edit-link">', '</span>'
				);
			?>

			<?php if ( get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
				<?php get_template_part( 'author-bio' ); ?>
			<?php endif; ?>

		<?php else : ?>
			<div class="entry-meta">
				<span class="genericon genericon-time"></span>
			</div>
		<?php
			edit_post_link(
				esc_html__( 'Edit', TRANSLATED_TEXT_DOMAIN ),
				'<span class="edit-link">', '</span>'
			);
		?>
		<?php endif; ?>
	</footer>
	<?php tha_entry_bottom(); ?>
</article><!-- #post -->
<?php tha_entry_after(); ?>
