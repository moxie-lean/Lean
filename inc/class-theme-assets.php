<?php
/**
 * Assets loader class
 *
 * @package Lean
 * @subpackage inc
 * @since 1.0.0
 */

// Exit if this fiel is loaded directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Theme_Assets' ) ) :

	/**
	 * Class for loading assets based on environment.
	 *
	 * Load development files on development env, and load minified
	 * and/or concatenated files on production env.
	 *
	 * @since 1.1.0
	 */
	class Theme_Assets {

		/**
		 * Which environment we are in. Defaults to development.
		 *
		 * @since 1.1.0
		 * @access private
		 * @var string $environment
		 */
		private $environment = 'development';

		/**
		 * Whether to load the comment__reply script or not.
		 *
		 * @since 1.1.0
		 * @access private
		 * @var bool $load_comments
		 */
		private $load_comments = false;

		/**
		 * The JS version number to append to script URLs.
		 *
		 * @since 1.1.0
		 * @access private
		 * @var bool $js_version
		 */
		private $js_version = false;

		/**
		 * The CSS version number to append to stylesheet URLs.
		 *
		 * @since 1.1.0
		 * @access private
		 * @var bool $css_version
		 */
		private $css_version = false;

		/**
		 * Array of configuration options.
		 *
		 * @since 1.1.0
		 * @access private
		 * @var array $options
		 */
		private $options = array();

		/**
		 * PHP5 constructor.
		 *
		 * @since 1.1.0
		 *
		 * @param array $options {
		 *	    Optional array of configuration options.
		 *
		 *      @type string 	$environment   Which environment we are in.
		 *      @type bool|int 	$js_verion 	   Version number to use for scripts.
		 *      @type bool|int  $css_version   Version number to user for stylesheets.
		 *      @type bool      $load_comments Whether to load the comment__reply script.
		 *      @type bool      $remove_emoji  Whether to remove emoji libraries.
		 * }
		 */
		public function __construct( $options = array() ) {
			$this->options = is_array( $options ) ? $options : array();
			$this->set_up_environment();
			$this->set_up_version_numbers();
		}

		/**
		 * Setup the environment based on options given.
		 *
		 * @since 1.1.0
		 * @access private
		 *
		 * @return void
		 */
		private function set_up_environment() {
			if ( $this->it_has( 'environment' ) ) {
				$this->environment = $this->options['environment'];
			} else {
				$this->environment = defined( 'WP_DEBUG' ) && WP_DEBUG
					? 'development'
					: 'production';
			}
		}

		/**
		 * Setup JS and CSS version numbers based on options given.
		 *
		 * @since 1.1.0
		 * @access private
		 *
		 * @return void
		 */
		private function set_up_version_numbers() {
			if ( $this->it_has( 'js_version' ) ) {
				$this->js_version = $this->options['js_version'];
			}
			if ( $this->it_has( 'css_version' ) ) {
				$this->css_version = $this->options['css_version'];
			}
		}

		/**
		 * Check whether a given option exists in the options array.
		 *
		 * @since 1.1.0
		 * @access private
		 *
		 * @param string $option_name The name of the option to check for existence.
		 * @return bool Whether the given option key exists.
		 */
		private function it_has( $option_name ) {
			return array_key_exists( $option_name, $this->options ) && ! empty( $this->options[ $option_name ] );
		}

		/**
		 * Enqueues the theme assets.
		 *
		 * @since 1.1.0
		 *
		 * @return void
		 */
		public function load() {
			$this->load_comments = $this->it_has( 'load_coments', $this->options )
				? $this->options['load_comments']
				: false;
			$this->enqueue_assets();
		}

		/**
		 * Returns the suffix production assets.
		 *
		 * @since 1.1.0
		 *
		 * @return string The suffix to use for production assets.
		 */
		public function get_assets_suffix() {
			$assets_suffix = '';
			if ( 'development' !== $this->environment ) {
				$assets_suffix = '-min';
			}
			return $assets_suffix;
		}

		/**
		 * Enqueues JS and CSS assets based on options passed.
		 *
		 * @since 1.1.0
		 *
		 * @return void
		 */
		public function setup_assets() {
			$suffix = $this->get_assets_suffix();

			if ( ! is_admin() ) {
				$this->update_jquery();
				$remove_emoji_exists = array_key_exists( 'remove_emoji', $this->options );
				if ( ! $remove_emoji_exists ||
					( $remove_emoji_exists && $this->options['remove_emoji'] )
				) {
					$this->remove_emoji();
				}
			}

			// Load the JS files.
			wp_enqueue_script(
				sprintf( '%s-%s', $this->environment, 'js' ),
				sprintf( '%s/assets/js/production%s.js', FULL_THEME_URL, $suffix ),
				array( 'jquery' ),
				$this->js_version,
				true
			);

			// Load the CSS files.
			wp_enqueue_style(
				sprintf( '%s-%s', $this->environment, 'style' ),
				sprintf( '%s/assets/css/style%s.css', FULL_THEME_URL, $suffix ),
				array(),
				$this->css_version,
				'all'
			);

			if ( $this->load_comments ) {
				$this->load_comments_assets();
			}
		}

		/**
		 * Enqueues theme-bundled jQuery instead of default one in WordPress.
		 *
		 * @since 1.1.0
		 * @access private
		 *
		 * @return void
		 */
		private function update_jquery() {
			$jquery_path = './bower_components/jquery/dist/jquery.min.js';
			$jquery_version = '2.1.4';

			wp_deregister_script( 'jquery' );
			wp_register_script(
				'jquery', // Handle
				sprintf( '%s/%s', FULL_THEME_URL, $jquery_path ), // source
				false, // No dependency
				$jquery_version, // No version
				false // Don't load on footer.
			);
			wp_enqueue_script( 'jquery' );
		}

		/**
		 * Remove emoji libries, it causes different issues in the console
		 * during the development phase.
		 *
		 * @since 1.1.0
		 * @access private
		 *
		 * @return void
		 */
		private function remove_emoji() {
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );
		}

		/**
		 * Enqueues the theme comment__reply script.
		 *
		 * @since 1.1.0
		 * @access private
		 *
		 * @return void
		 */
		private function load_comments_assets() {
			$load_comments = is_singular() && comments_open()
				&& get_option( 'thread_comments' );

			if ( $load_comments ) {
				wp_enqueue_script( 'comment__reply' );
			}
		}

		/**
		 * Bind the setup function to the wp_enqueue_scripts to load assets to the front end.
		 *
		 * @since 1.1.0
		 *
		 * @return void
		 */
		public function enqueue_assets() {
			add_action( 'wp_enqueue_scripts', array( $this, 'setup_assets' ) );
		}
	}
endif;
