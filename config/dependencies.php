<?php namespace Leean\Config;

/**
 * Load theme dependencies.
 * @package Leean
 * @since 1.0.0
 */
add_action( '_lean_after_setup', function() {
	/*
	 * Require of the autoloading of composer.
	 */
	require _COMPOSER_PATH_ . '/autoload.php';

	/*
	 * Custom template tags for this theme.
	 */
	require _INC_PATH_ . '/helpers/loader.php';
	require _INC_PATH_ . '/helpers/template-tags.php';
	require _INC_PATH_ . '/helpers/comment.php';
});
