<?php
if( ! function_exists('load_dependencies') ){
	function load_dependencies(){
		/**
		 * Including Theme Hook Alliance
		 * https://github.com/zamoose/themehookalliance.
		 */
		require  COMPOSER_DIR . '/zamoose/themehookalliance/tha-theme-hooks.php';
		// add_theme_support( 'tha_hooks', array('all') );
		/**
		 * Custom template tags for this theme.
		 */
		require LIB_DIR . '/vendors/template-tags.php';

		require LIB_DIR . '/class-theme-assets.php';
	}
}
