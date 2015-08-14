<?php
if ( ! function_exists( 'lean_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook.
 */
function lean_setup() {

	/**
	 * Set the content width based on the theme's design and stylesheet.
	 * based on pixels
	 */
	if ( ! isset( $content_width ) ) {
		$content_width = 640;
	}

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'digistarter', get_template_directory() . '/library/languages' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/*
	 * Add Editor Style for adequate styling in text editor.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_editor_style
	 */
	add_editor_style( '/assets/css/style.css' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary-navigation', __( 'Primary Menu', 'digistarter' ) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'status', 'gallery', 'chat', 'audio' ) );

	/**
	 * Including Theme Hook Alliance (https://github.com/zamoose/themehookalliance).
	 */
	include( 'library/vendors/tha-theme-hooks/tha-theme-hooks.php' );

	/**
	 * Custom template tags for this theme.
	 */
	require get_template_directory() . '/library/vendors/template-tags.php';

	include 'library/class-assets.php';
	$assets = new Lean_Assets();
	$assets->load();
}
endif;
add_action( 'after_setup_theme', 'lean_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
if ( !function_exists('digistarter_widgets_init') ) :
	function digistarter_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Sidebar', 'digistarter' ),
			'id'            => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}
	add_action( 'widgets_init', 'digistarter_widgets_init' );
endif;
