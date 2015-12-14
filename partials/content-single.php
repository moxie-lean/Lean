<?php
/**
 * Template part to display the content from single.php
 *
 * @package Lean
 * @subpackage partials
 * @since 1.0.0
 */

?>
<?php tha_entry_before(); ?>
<article class="entry" id="post-<?php the_ID(); ?>" <?php post_class(); ?>
	itemscope itemType="http://schema.org/BlogPosting">
	<?php tha_entry_top(); ?>
	<header class="entry__header">
		<h1 class="entry__title" itemprop="name"><?php the_title(); ?></h1>
	</header>

	<div class="entry__content entry__a--transition" itemprop="articleBody" >
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', TRANSLATED_TEXT_DOMAIN ),
				'after'  => '</div>',
			) );
		?>

	</div>

	<footer class="entry__meta" itemprop="keywords" >
		<?php
			/**
			 * Translators: used between list items, there is a space after the comma
			 * */
			$categories_list = get_the_category_list( esc_html_e( ', ', TRANSLATED_TEXT_DOMAIN ) );

			/**
			 * Translators: used between list items, there is a space after the comma
			 * */
			$tags_list = get_the_tag_list( '', esc_html_e( ', ', TRANSLATED_TEXT_DOMAIN ) );

			if ( ! digistarter_categorized_blog() ) {
				/**
				 * This blog only has 1 category so we just need to worry
				 * about tags in the meta text.
				 */
				if ( ! empty( $tag_list ) ) {
					$meta_text = esc_html__(
						'This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.',
						TRANSLATED_TEXT_DOMAIN
					);
				} else {
					$meta_text = esc_html__(
						'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.',
						TRANSLATED_TEXT_DOMAIN
					);
				}
			} else {
				/**
				 * But this blog has loads of categories so we should
				 * probably display them here
				 */
				if ( ! empty( $tag_list )  ) {
					$meta_text = __(
						'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.',
						TRANSLATED_TEXT_DOMAIN
					);
				} else {
					$meta_text = __(
						'This entry was posted in %1$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.',
						TRANSLATED_TEXT_DOMAIN
					);
				}
			}

			echo wp_kses(
				sprintf(
					$meta_text,
					$category_list,
					$tag_list,
					get_permalink()
				),
				array(
					'a' => array(
						'href' => array(),
						'class' => array(),
						'rel' => array(),
					),
				)
			);
		?>
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
