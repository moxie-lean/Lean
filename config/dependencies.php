<?php
if( ! function_exists('load_dependencies') ){
	function load_dependencies(){
		/**
		 * Including Theme Hook Alliance
		 * https://github.com/zamoose/themehookalliance.
		 */
		include FULL_THEME_PATH . '/library/vendors/tha-theme-hooks/tha-theme-hooks.php';
		/**
		 * Custom template tags for this theme.
		 */
		require FULL_THEME_PATH . '/library/vendors/template-tags.php';

		include FULL_THEME_PATH . '/library/class-theme-assets.php';
	}
}
