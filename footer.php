<?php namespace Leean;
/**
 * The template for displaying the footer.
 *
 * @package Leean
 * @since 1.0.0
 */

?>

		<footer id="colophon" class="footer" role="contentinfo"
			itemscope="itemscope" itemtype="http://schema.org/WPFooter">
			<div class="footer__info">
				<a href="http://wordpress.org/" rel="generator">
				<?php
				printf(
					esc_html_e( 'Proudly powered by', TRANSLATED_TEXT_DOMAIN )
				); ?>
				<span class="genericon genericon-wordpress"></span> Wordpress
				</a>
			</div>
		</footer>
	</div>

<?php wp_footer(); ?>
</body>
</html>
