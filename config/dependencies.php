<?php
/**
 * Theme dependencies
 *
 * @package Lean
 * @subpackage config
 * @since 1.0.0
 */

// Exit if this fiel is loaded directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'load_dependencies' ) ) {
	/**
	 * Load theme dependencies.
	 */
	function load_dependencies() {
		/*
		 * Including Theme Hook Alliance
		 *
		 * @linkg https://github.com/zamoose/themehookalliance.
		 *
		 * Use add_theme_support( 'tha_hooks', array('all') ) to add support.
		 */
		require COMPOSER_DIR . '/zamoose/themehookalliance/tha-theme-hooks.php';

		/*
		 * Custom template tags for this theme.
		 */
		require INC_DIR . '/vendors/template-tags.php';

		require INC_DIR . '/class-theme-assets.php';
	}
}
