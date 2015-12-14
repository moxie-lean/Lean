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
<?php tha_entry_before(); ?>
<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title">
			<?php esc_html_e( 'Nothing Found', TRANSLATED_TEXT_DOMAIN ); ?>
		</h1>
	</header>
	<?php tha_content_before(); ?>
	<div class="page-content">
		<?php tha_entry_top(); ?>
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p>
			<?php
			wp_kses(
				sprintf(
					esc_html__(
						'Ready to publish your first post? <a href="%1$s">Get started here</a>.',
						TRANSLATED_TEXT_DOMAIN
					),
					esc_url( admin_url( 'post-new.php' ) )
				),
				array(
					'a' => array(
						'href' => array(),
					),
				)
			);
			?>
			</p>

		<?php elseif ( is_search() ) : ?>

			<p>
			<?php
			esc_html_e(
				'Sorry, but nothing matched your search terms. Please try again with some different keywords.',
				TRANSLATED_TEXT_DOMAIN
			);
			?>
			</p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p>
			<?php
			esc_html_e(
				'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.',
				TRANSLATED_TEXT_DOMAIN
			);
			?>
			</p>
			<?php get_search_form(); ?>

		<?php endif; ?>
		<?php tha_entry_bottom(); ?>
	</div>
	<?php tha_content_after(); ?>
</section>
<?php tha_entry_after(); ?>
