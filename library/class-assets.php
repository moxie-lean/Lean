<?php
if ( ! class_exists( 'Lean_Assets' ) ) :
	class Lean_Assets {
		private $environment = 'development';
		private $load_comments = false;
		private $version = '1.0.0';
		private $js_version = false;
		private $css_version = false;
		private $options = array();

		public function __construct( $options = array() ){
			$this->options = is_array( $options ) ? $options : array();
			$this->set_up_environment();
			$this->set_up_version_numbers();
		}

		private function set_up_environment(){
			if( $this->it_has('environment') ) {
				$this->environment = $this->options['environment'];
			} else {
				$this->environment = defined('WP_DEBUG') && WP_DEBUG
					? 'development'
					: 'production';
			}
		}

		private function set_up_version_numbers(){
			if( $this->it_has('js_version') ){
				$this->js_version = $this->options['js_version'];
			}
			if( $this->it_has('css_version') ){
				$this->css_version = $this->options['css_version'];
			}
		}

		private function it_has( $option_name ){
			return array_key_exists( $option_name, $this->options ) && ! empty( $this->options[ $option_name ] );
		}

		public function load() {
			$this->load_comments = $this->it_has( 'load_coments', $this->options )
				? $this->options['load_comments']
				: false;
			$this->enqueue_assets();
		}

		public function get_assets_suffix(){
			$assets_suffix = '';
			if( 'development' !==  $this->environment ){
				$assets_suffix = '-min';
			}
			return $assets_suffix;
		}

		public function setup_assets() {
			$suffix = $this->get_assets_suffix();

			if ( ! is_admin() ) {
				$this->update_jquery();
				$remove_emoji_exists = array_key_exists('remove_emoji', $this->options);
				if( ! $remove_emoji_exists ||
					( $remove_emoji_exists && $this->options['remove_emoji'] )
				){
					$this->remove_emoji();
				}
			}

			// JS
			wp_enqueue_script(
				sprintf('%s-%s-%s', $this->environment, 'lean', 'js'),
				sprintf('%s/assets/js/production%s.js', FULL_THEME_URL, $suffix),
				array( 'jquery' ),
				$this->js_version,
				true
			);

			// CSS
			wp_enqueue_style(
				sprintf('%s-%s-%s', $this->environment, 'lean', 'style'),
				sprintf('%s/assets/css/style%s.css', FULL_THEME_URL, $suffix),
				array(),
				$this->css_version,
				'all'
			);

			if( $this->load_comments ){
				$this->load_comments_assets();
			}
		}

		private function update_jquery(){
			$jquery_path = './bower_components/jquery/dist/jquery.min.js';
			$jquery_version = '2.1.4';

			wp_deregister_script('jquery');
			wp_register_script(
				'jquery', /// Handle
				sprintf('%s/%s', FULL_THEME_URL, $jquery_path), // source
				false, // No dependency
				$jquery_version, // No version
				false // Don't load on footer
			);
			wp_enqueue_script('jquery');
		}

		/**
		 * Remove emoji libries, it causes different issues in the console
		 * during the development phase.
		 */
		private function remove_emoji(){
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );
		}

		private function load_comments_assets(){
			$load_comments = is_singular() && comments_open()
				&& get_option( 'thread_comments' );

			if ( $load_comments ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

		public function enqueue_assets(){
			add_action( 'wp_enqueue_scripts', array( $this, 'setup_assets') );
		}
	}
endif;
