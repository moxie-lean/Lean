<?php namespace Lean;

/**
 * Load theme dependencies.
 * @package Lean
 * @since 1.0.0
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
	require INC_DIR . '/class-theme-assets.php';
	require INC_DIR . '/helpers/loader.php';
	require INC_DIR . '/helpers/template-tags.php';
	require INC_DIR . '/helpers/comment.php';

}
