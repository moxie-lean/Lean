<?php
if ( ! class_exists( 'Lean_Assets' ) ) :
	class Lean_Assets {
		private $environment = 'development';
		private $load_comments = false;
		private $version = '1.0.0';
		private $base_path = '';

		public function __construct( $environment = '' ){
			$this->environment = $this->get_environment( $environment );
		}

		private function get_environment( $environment ){
			if( '' === $environment ){
				$environment = defined('WP_DEBUG') && WP_DEBUG
					? 'development'
					: 'production';
			}
			return $environment;
		}

		public function load( $version = '1.0.0', $load_comments = false ) {
			$this->version = $version;
			$this->load_comments = $load_comments;
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
			$this->base_path = get_stylesheet_directory_uri();

			if ( ! is_admin() ) {
				$this->update_jquery();
				$this->remove_emoji();
			}
			// JS
			wp_enqueue_script(
				sprintf('%s-%s-%s', $this->environment, 'lean', 'js'),
				sprintf('%s/assets/js/production%s.js', $this->base_path, $suffix),
				array( 'jquery' ),
				$this->version,
				true
			);

			// CSS
			wp_enqueue_style(
				sprintf('%s-%s-%s', $this->environment, 'lean', 'style'),
				sprintf('%s/assets/css/style%s.css', $this->base_path, $suffix)
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
				sprintf('%s/%s', $this->base_path, $jquery_path), // source
				false, // No dependency
				$jquery_version, // No version
				false // Don't load on footer
			);
			wp_enqueue_script('jquery');
		}

		private function remove_emoji(){
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );
		}

		private function load_comments_assets(){
			if ( is_singular()
				&& comments_open()
				&& get_option( 'thread_comments' )
			) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

		public function enqueue_assets(){
			$args = array(
				$this, // Instance
				'setup_assets' // Method name
			);
			add_action( 'wp_enqueue_scripts', $args );
		}
	}
endif;
