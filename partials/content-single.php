<?php namespace Leean;
/**
 * Template part to display the content from single.php
 *
 * @package Leean
 * @subpackage partials
 * @since 1.0.0
 */

use Leean\Inc\Helpers;
?>
<article class="entry" id="post-<?php the_ID(); ?>" <?php post_class(); ?>
	itemscope itemType="http://schema.org/BlogPosting">
	<header class="entry__header">
		<h1 class="entry__title" itemprop="name"><?php the_title(); ?></h1>
	</header>

	<div class="entry__content" itemprop="articleBody" >
		<?php the_content(); ?>
		<?php
			wp_link_pages( [
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', _TEXT_DOMAIN_ ),
				'after'  => '</div>',
			] );
		?>

	</div>

	<footer class="entry__meta" itemprop="keywords" >
		<?php
			/**
			 * Translators: used between list items, there is a space after the comma
			 * */
			$categories_list = get_the_category_list( esc_html_e( ', ', _TEXT_DOMAIN_ ) );

			/**
			 * Translators: used between list items, there is a space after the comma
			 * */
			$tags_list = get_the_tag_list( '', esc_html_e( ', ', _TEXT_DOMAIN_ ) );

			if ( ! Helpers\categorized_blog() ) {
				/**
				 * This blog only has 1 category so we just need to worry
				 * about tags in the meta text.
				 */
				if ( ! empty( $tags_list ) ) {
					$meta_text = esc_html__(
						'This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.',
						_TEXT_DOMAIN_
					);
				} else {
					$meta_text = esc_html__(
						'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.',
						_TEXT_DOMAIN_
					);
				}
			} else {
				/**
				 * But this blog has loads of categories so we should
				 * probably display them here
				 */
				if ( ! empty( $tags_list )  ) {
					$meta_text = __(
						'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.',
						_TEXT_DOMAIN_
					);
				} else {
					$meta_text = __(
						'This entry was posted in %1$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.',
						_TEXT_DOMAIN_
					);
				}
			}

			echo wp_kses(
				sprintf(
					$meta_text,
					$categories_list,
					$tags_list,
					get_permalink()
				),
				[
					'a' => [
						'href' => [],
						'class' => [],
						'rel' => [],
					],
				]
			);
		?>
		<?php
			edit_post_link(
				esc_html__( 'Edit', _TEXT_DOMAIN_ ),
				'<span class="edit-link">', '</span>'
			);
		?>
	</footer>
</article>
