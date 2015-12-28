<?php namespace Leean;
/**
 * The template for displaying the footer.
 *
 * @package Leean
 * @since 1.0.0
 */

?>
		<?php tha_content_bottom(); ?>

		<?php tha_content_after(); ?>
   		<?php tha_footer_before(); ?>
		<footer id="colophon" class="footer" role="contentinfo"
			itemscope="itemscope" itemtype="http://schema.org/WPFooter">
			<?php tha_footer_top(); ?>
			<div class="footer__info">
				<a href="http://wordpress.org/" rel="generator">
				<?php
				printf(
					esc_html_e( 'Proudly powered by', TRANSLATED_TEXT_DOMAIN )
				); ?>
				<span class="genericon genericon-wordpress"></span> Wordpress
				</a>
			</div>
			<?php tha_footer_bottom(); ?>
		</footer>
		<?php tha_footer_after(); ?>
	</div>

<?php tha_body_bottom(); ?>
<?php wp_footer(); ?>
</body>
</html>
