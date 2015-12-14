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
	require COMPOSER . '/zamoose/themehookalliance/tha-theme-hooks.php';

	/*
	 * Custom template tags for this theme.
	 */
	require INC . '/class-theme-assets.php';
	require INC . '/helpers/loader.php';
	require INC . '/helpers/template-tags.php';
	require INC . '/helpers/comment.php';
}
