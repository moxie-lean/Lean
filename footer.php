<?php // The template for displaying the footer.  ?>
		<?php tha_content_bottom(); ?>
		</div>
		<?php tha_content_after(); ?>
   		<?php tha_footer_before(); ?>
		<footer id="colophon" class="site-footer" role="contentinfo"
			itemscope="itemscope" itemtype="http://schema.org/WPFooter">
			<?php tha_footer_top(); ?>
			<div class="site-info">
				<a href="http://wordpress.org/" rel="generator">
				<?php
				printf(
					__( 'Proudly powered by <span class="genericon genericon-wordpress"></span> %s', 'lean' ),
					'WordPress'
				); ?>
				</a>
			</div>
			<?php tha_footer_bottom(); ?>
		</footer>
		<?php tha_footer_after(); ?>
	</div>
</div>

<?php tha_body_bottom(); ?>
<?php wp_footer(); ?>
</body>
</html>
