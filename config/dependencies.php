<?php
if( ! function_exists('load_dependencies') ){
	function load_dependencies(){
		/**
		 * Including Theme Hook Alliance
		 * https://github.com/zamoose/themehookalliance.
		 */
		include BASE_THEME_PATH . '/library/vendors/tha-theme-hooks/tha-theme-hooks.php';
		/**
		 * Custom template tags for this theme.
		 */
		require BASE_THEME_PATH . '/library/vendors/template-tags.php';

		include BASE_THEME_PATH . '/library/class-assets.php';
	}
}
