<?php
	class SessionRegistry extends Registry {
		private static $instance;
		private function __construct() {
			session_start();
		}

		public static function instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		protected function get( $key ) {
			if ( isset( $_SESSION[__CLASS__][$key] ) ) {
				return $_SESSION[__CLASS__][$key];
			}
			return null;
		}

		protected function set( $key, $value ) {
			$_SESSION[__CLASS__][$key] = $value;
		}

		public function setStyleCode($code) {
			self::set('stylecode', $code);
		}

		public function getStyleCode() {
			return self::get('stylecode');
		}
	}
