<?php namespace Leean;

/**
 * Load theme dependencies.
 * @package Leean
 * @since 1.0.0
 */
function load_dependencies() {
	/*
	 * Require of the autoloading of composer.
	 */
	require COMPOSER . '/autoload.php';

	/*
	 * Custom template tags for this theme.
	 */
	require INC . '/helpers/loader.php';
	require INC . '/helpers/template-tags.php';
	require INC . '/helpers/comment.php';
}
