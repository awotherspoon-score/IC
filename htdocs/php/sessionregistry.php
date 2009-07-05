<?php
	class SessionRegistry extends Registry {
		private function __construct() {
			session_start();
		}

		protected static function get( $key ) {
			if ( isset( $_SESSION[__CLASS__][$key] ) ) {
				return $_SESSION[__CLASS__][$key];
			}
			return null;
		}

		protected static function set( $key, $value ) {
			$_SESSION[__CLASS__][$key] = $value;
		}

		public static function setStyleCode($code) {
			self::set('stylecode', $code);
		}

		public static function getStyleCode() {
			return self::get('stylecode');
		}
	}
