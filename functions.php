<?php
/**
 * Lean functions and definitions
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package Lean
 */

if ( ! function_exists( 'theme_setup_base' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook.
	 */
	function theme_setup_base() {
		include 'config.php';

		/**
		 * Set the content width based on the theme's design and stylesheet
		 * (unit based on pixels).
		 */
		if ( ! isset( $content_width ) ) {
			$content_width = 640;
		}

		// Make theme available for translation.
		load_theme_textdomain( TRANSLATED_TEXT_DOMAIN , FULL_THEME_PATH . '/config/languages' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );
		// Add support for all the hooks from tha_hooks.
		add_theme_support( 'tha_hooks', array( 'all' ) );

		// Add Editor Style for adequate styling in text editor.
		if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) {
			add_editor_style( EDITOR_STYLESHEET_UNMINIFIED );
		} else {
			add_editor_style( EDITOR_STYLESHEET );
		}

		// This theme uses wp_nav_menu() in one location.
		register_nav_menu( 'primary-navigation', __( 'Primary Menu', 'lean' ) );

		// Enable support for Post Formats.
		$supported_formats = array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'status',
			'gallery',
			'chat',
			'audio',
		);
		add_theme_support( 'post-formats', $supported_formats );

		if ( function_exists( 'load_dependencies' ) ) {
			load_dependencies();
		}
		$args = array(
			'css_version' => false,
			'js_version' => time(),
		);
		$assets = new Theme_Assets( $args );
		$assets->load();
	}
endif;
add_action( 'after_setup_theme', 'theme_setup_base' );

if ( ! function_exists( '_widgets_init' ) ) :
	/**
	 * Register widgetized area and update sidebar with default widgets.
	 */
	function _widgets_init() {
		$args = array(
			'name'          => esc_html__( 'Sidebar', TRANSLATED_TEXT_DOMAIN ),
			'id'            => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		);
		register_sidebar( $args );
	}
add_action( 'widgets_init', '_widgets_init' );
endif;

