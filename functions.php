<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook.
 *
 * @since 1.0.0
 */

use Leean\Config;
use Leean\Assets;

add_action( 'after_setup_theme', function(){
	include 'config.php';
	// Make theme available for translation.
	load_theme_textdomain( _TEXT_DOMAIN_ , _THEME_PATH_ . '/languages' );
	add_theme_support( 'post-thumbnails' );
	// Add Editor Style for adequate styling in text editor.
	if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
		add_editor_style( _THEME_PATH_ . '/assets/css/style.css' );
	} else {
		add_editor_style( _THEME_PATH_ . '/assets/css/style-min.css' );
	}
	// This theme uses wp_nav_menu() in one location.
	register_nav_menu(
		'primary-navigation',
		__( 'Primary Menu', _TEXT_DOMAIN_ )
	);
	$args = [
		'css_version' => false,
		'js_version' => time(),
		'theme_path' => _THEME_URL_,
	];
	$assets = new Assets( $args );
	$assets->load();
});
