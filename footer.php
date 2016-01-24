<?php namespace Leean;
/**
 * The template for displaying the footer.
 *
 * @package Leean
 * @since 1.0.0
 */

?>

	<footer class="footer" role="contentinfo"
		itemscope="itemscope" itemtype="http://schema.org/WPFooter">
		<div class="footer__info">
			<a href="http://wordpress.org/" rel="generator">
				<?php esc_html_e( 'Proudly powered by', _TEXT_DOMAIN_ ); ?> Wordpress
			</a>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>
</body>
</html>
