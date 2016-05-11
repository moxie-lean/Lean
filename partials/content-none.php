<?php namespace Lean;
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Lean
 * @subpackage partials
 * @since 1.0.0
 */

?>
<section class="no-results not-found">
	<header>
		<h1>
			<?php esc_html_e( 'Nothing Found', _TEXT_DOMAIN_ ); ?>
		</h1>
	</header>
	<div class="page__content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p>
			<?php
			wp_kses(
				sprintf(
					esc_html__(
						'Ready to publish your first post? <a href="%1$s">Get started here</a>.',
						_TEXT_DOMAIN_
					),
					esc_url( admin_url( 'post-new.php' ) )
				),
				[
					'a' => [
						'href' => [],
					],
				]
			);
			?>
			</p>

		<?php elseif ( is_search() ) : ?>

			<p>
			<?php
			esc_html_e(
				'Sorry, but nothing matched your search terms. Please try again with some different keywords.',
				_TEXT_DOMAIN_
			);
			?>
			</p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p>
			<?php
			esc_html_e(
				'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.',
				_TEXT_DOMAIN_
			);
			?>
			</p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div>
</section>
