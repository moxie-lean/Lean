<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook.
 *
 * @since 1.0.0
 */

use Leean\Inc\Helpers;

add_action( 'after_setup_theme', function(){
	include 'config.php';
	Leean\load_dependencies();
	// Make theme available for translation.
	load_theme_textdomain( TRANSLATED_TEXT_DOMAIN , FULL_THEME_PATH . '/config/languages' );
	add_theme_support( 'post-thumbnails' );
	// Add support for all the hooks from tha_hooks.
	add_theme_support( 'tha_hooks', array( 'all' ) );
	// Add Editor Style for adequate styling in text editor.
	if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) {
		add_editor_style( \Leean\EDITOR_STYLESHEET_UNMINIFIED );
	} else {
		add_editor_style( \Leean\EDITOR_STYLESHEET );
	}
	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary-navigation', __( 'Primary Menu', 'lean' ) );
	$args = array(
		'css_version' => false,
		'js_version' => time(),
		'theme_path' => \Leean\THEME_URL,
	);
	$assets = new \Leean\Inc\Assets( $args );
	$assets->load();
});
