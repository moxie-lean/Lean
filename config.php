<?php
/**
 * Configuration file to handle different common areas of the project to have
 * a better organizades structure of the code.
 * @package Lean
 */

// Exit if this fiel is loaded directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Absolute server path to the theme.
define( 'FULL_THEME_PATH', get_template_directory() );
// Stylesheet directory URI for the current theme/child theme.
define( 'FULL_THEME_URL', get_stylesheet_directory_uri() );
// Stylesheet URL with minification process.
define( 'EDITOR_STYLESHEET', FULL_THEME_URL . '/assets/css/style-min.css' );
// Production styles.
define( 'EDITOR_STYLESHEET_UNMINIFIED', FULL_THEME_URL . '/assets/css/style.css' );
// Path to the composer file.
define( 'COMPOSER_DIR', FULL_THEME_PATH . '/vendor' );
// Lib directory.
define( 'INC_DIR', FULL_THEME_PATH . '/inc' );

/**
 * Dependencies from other files like external classes from a composer directory
 * or something different like a custom class to load into the project.
 */
include FULL_THEME_PATH . '/config/dependencies.php';

/**
 * Specific constants to the project can be store in this file, different things
 * like ACF fields.
 */
include FULL_THEME_PATH . '/config/constants.php';
