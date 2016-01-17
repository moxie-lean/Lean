<?php namespace Leean;
/**
 * Configuration file to handle different common areas of the project to have
 * a better organizades structure of the code.
 *
 * @package Leean
 * @since 1.0.0
 */

// Text domain for the theme.
if ( ! defined( '_TEXT_DOMAIN_' ) ) {
	define( '_TEXT_DOMAIN_', 'leean' );
}
// Absolute server path to the theme.
if ( ! defined( '_THEME_PATH_' ) ) {
	define( '_THEME_PATH_', get_template_directory() );
}
// Stylesheet directory URI for the current theme/child theme.
if ( ! defined( '_THEME_URL_' ) ) {
	define( '_THEME_URL_', get_stylesheet_directory_uri() );
}
// Path to the composer file.
if ( ! defined( '_COMPOSER_PATH_' ) ) {
	define( '_COMPOSER_PATH_', _THEME_PATH_ . '/vendor' );
}
// Lib directory.
if ( ! defined( '_INC_PATH_' ) ){
	define( '_INC_PATH_', _THEME_PATH_ . '/inc' );
}

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
