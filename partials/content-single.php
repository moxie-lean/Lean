<?php namespace Lean;
/**
 * Template part to display the content from single.php
 *
 * @package Lean
 * @subpackage partials
 * @since 1.0.0
 */

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
		edit_post_link(
			esc_html__( 'Edit', _TEXT_DOMAIN_ ),
			'<span class="edit-link">', '</span>'
		);
		?>
	</footer>
</article>
