<?php
/**
 * Configuration file to handle different common areas of the project to have
 * a better organizades structure of the code.
 */

if( ! defined('BASE_THEME_PATH') ){
	define('BASE_THEME_PATH', get_template_directory() );
}

/**
 * Dependencies from other files like external classes from a composer directory
 * or something different like a custom class to load into the project.
 */
include BASE_THEME_PATH . '/config/dependencies.php';

/**
 * Specific constants to the project can be store in this file, different things
 * like ACF fields.
 */
include BASE_THEME_PATH . '/config/constans.php';
