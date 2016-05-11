<?php namespace Lean\Inc\Helpers;
/**
 * Functions to load files fro mthe partials directory also allows to send
 * custom partials to the files.
 *
 * @since 2.0.0
 *
 * @package Lean
 * @subpackage helpers
 */

/**
 * Custom wrapper to load the partials files enabling the pass of parameters
 * to the partial as local variables.
 *
 * @since 2.0.0
 *
 * @param string $file_name The name of the file to load.
 * @param array  $args Extra variables to pass to the partial.
 */
function load_partial( $file_name = '', $args = [] ) {
	$path = '/partials/' . $file_name;
	load_template_part( $path, $args );
}

/**
 * Custom wrapper to load the template parts enabling the pass of parameters
 * to the partial as local variables.
 *
 * @since 2.0.0
 *
 * @param string $file_name The name of the file to load.
 * @param array  $args Extra variables to pass to the template.
 */
function load_template_part( $file_name = '', $args = [] ) {
	$path = \Lean\THEME_PATH . $file_name . '.php';

	if ( ! file_exists( $path ) ) {
		$message = sprintf( '<code>%s</code> does not exist.', $path );
		$allowed_html = [
			'code' => [],
		];
		_doing_it_wrong( __FUNCTION__, wp_kses( $message, $allowed_html ), '4.3.1' );
		return;
	}

	// Include the file.
	include $path;
	// Clear arguments.
	unset( $args );
}

/**
 * Get the value from an array and allow the option to get the default value from
 * the array pased in the second variable
 *
 * @since 2.0.0
 *
 * @param string $var The name of the variable to search.
 * @param array  $args The array where to search.
 * @param mixed  $default The default value if not exist.
 */
function get_var( $var = '', $args = null, $default = '' ) {
	if ( ! isset( $args[ $var ] ) ) {
		return $default;
	} else {
		return $args[ $var ];
	}
}

