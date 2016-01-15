<?php namespace Leean\Inc;
/**
 * Theme dependencies
 *
 * @package Leean
 * @subpackage config
 * @since 1.1.0
 */

add_action( 'widgets_init', function(){
	register_sidebar( [
		'name' => __( 'Sidebar', TRANSLATED_TEXT_DOMAIN ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title' => '<h4 class="widget___title">',
		'after_title' => '</h4>',
	] );
});
