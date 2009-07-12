<?php
	class RequestRegistry extends Registry {
		private $values = array();
		private static $instance;
		
		private function __construct() {}
		
		static function instance() {
			if (! isset(self::$instance)) {
				self::$instance = new self();
			}
			return self::$instance;
		}
		
		protected function get( $key ) {
			if (isset($this->values[$key])) {
				return $this->values[$key];
			}
			return null;
		}
		
		protected function set( $key, $val ) {
			$this->values[$key] = $val;
		}
		
		static function getConfig() {
			if (self::instance()->get('config') == null) {
				self::instance()->set('config', new Config(CONFIG_FILENAME));
			}
			return self::instance()->get('config');
		}
		
		static function getMySQLi() {
			if (self::instance()->get('mysqli') == null) {
				$config = self::getConfig();
				self::instance()->set('mysqli', new mysqli($config->getDatabaseHost(), $config->getDatabaseUser(), $config->getDatabasePassword(), $config->getDatabaseName()));
			}
			return self::instance()->get('mysqli');
		}
		
		static function getContentWatcher() {
			if (self::instance()->get('contentwatcher') == null) {
				self::instance()->set('contentwatcher', new ContentWatcher());
			}
			return self::instance()->get('contentwatcher');
		}

		//TODO: Write the rest of this method!!!
		static function getMapper($type) {
			switch ($type) {
				case 'page' :
					return self::getPageMapper();
					break;
				case 'newsevent' :
					return self::getNewsEventMapper();
					break;
				case 'image' :
					return self::getImageMapper();
					break;
			}
		}

		static function getViewHelper( $content ) {
			return ViewHelperFactory::createViewHelper($content);
		}

		static function getUrlHelper() {
			if (self::instance()->get('urlhelper') == null) {
				self::instance()->set('urlhelper', new UrlHelper());
			}
			return self::instance()->get('urlhelper');
		}


                static function getPageMapper() {
                        if (self::instance()->get('pagemapper') == null) {
                                self::instance()->set('pagemapper', new PageMapper());
                        }
                        return self::instance()->get('pagemapper');
                }

		static function getNewsEventMapper() {
                        if (self::instance()->get('newseventmapper') == null) {
                                self::instance()->set('newseventmapper', new NewsEventMapper());
                        }
                        return self::instance()->get('newseventmapper');
		}

                static function getImageMapper() {
                        if (self::instance()->get('imagemapper') == null) {
                                self::instance()->set('imagemapper', new ImageMapper());
                        }
                        return self::instance()->get('imagemapper');
                }

                static function getAlbumMapper() {
                        if (self::instance()->get('albummapper') == null) {
                                self::instance()->set('albummapper', new AlbumMapper());
                        }
                        return self::instance()->get('albummapper');
                }

                static function getFormHelper() {
                        if (self::instance()->get('formhelper') == null) {
                                self::instance()->set('formhelper', new FormHelper());
                        }
                        return self::instance()->get('formhelper');
                }

                
	}
