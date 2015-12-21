<?php namespace Leean;
/**
 * Configuration file to handle different common areas of the project to have
 * a better organizades structure of the code.
 *
 * @package Leean
 * @since 1.0.0
 */

// Text domain for the theme.
define( __NAMESPACE__ . '\TEXT_DOMAIN', 'lean' );
// Absolute server path to the theme.
define( __NAMESPACE__ . '\THEME_PATH', get_template_directory() );
// Stylesheet directory URI for the current theme/child theme.
define( __NAMESPACE__ . '\THEME_URL', get_stylesheet_directory_uri() );
// Stylesheet URL with minification process.
define( __NAMESPACE__ . '\EDITOR_STYLESHEET', THEME_URL . '/assets/css/style-min.css' );
// Production styles.
define( __NAMESPACE__ . '\EDITOR_STYLESHEET_UNMINIFIED', THEME_URL . '/assets/css/style.css' );
// Path to the composer file.
define( __NAMESPACE__ . '\COMPOSER', THEME_PATH . '/vendor' );
// Lib directory.
define( __NAMESPACE__ . '\INC', THEME_PATH . '/inc' );

/**
 * Dependencies from other files like external classes from a composer directory
 * or something different like a custom class to load into the project.
 */
include THEME_PATH . '/config/dependencies.php';
