<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook.
 *
 * @since 1.0.0
 */

use Lean\Config;
use Lean\Assets;

/**
 * Action to load the configuration file and define constant values, this action
 * has priority of 1 in order to be executed before any other action using the
 * defined constant values on the config.php file.
 */
add_action( 'after_setup_theme', function(){
	include 'config.php';
	load_theme_textdomain( _TEXT_DOMAIN_ , _THEME_PATH_ . '/languages' );
}, 1);

/**
 * Action created to add theme supports or specific of the theme.
 */
add_action( 'after_setup_theme', function(){
	add_theme_support( 'post-thumbnails' );
});

/**
 * Action that adds the styles from the theme to the editor in order to see the
 * same styles from the front end in the dashboard on the editor section.
 */
add_action( 'after_setup_theme', function(){
	if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
		add_editor_style( _THEME_PATH_ . '/assets/css/style.css' );
	} else {
		add_editor_style( _THEME_PATH_ . '/assets/css/style-min.css' );
	}
});

/**
 * Action that is responsable for register the menus used on the theme.
 */
add_action( 'after_setup_theme', function(){
	register_nav_menu(
		'primary-navigation',
		__( 'Primary Menu', _TEXT_DOMAIN_ )
	);
});

/**
 * This actions register the assets and some configuration about the assets
 * in order to load the CSS and JS files into the theme.
 */
add_action( 'after_setup_theme', function() {
	$args = [
		'css_version' => false,
		'js_version' => time(),
		'theme_path' => _THEME_URL_,
	];
	$assets = new Assets( $args );
	$assets->load();
});

add_filter('loader_alias', function( $alias ) {
	$alias['partial'] = 'partials';
	return $alias;
});
