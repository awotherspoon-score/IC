<?php
	class ContentHelperFactory {
		public static function getCollection($type, $raw=null, $mapper = null) {
			switch ($type) {
				case 'Album':
					return new AlbumCollection($raw, $mapper);
					break;
				case 'Image':
					return new ImageCollection($raw, $mapper);
					break;
				case 'Page':
					return new PageCollection($raw, $mapper);
					break;
				case 'NewsEvent':
					return new NewsEventCollection($raw, $mapper);
					break;
			}
			throw new Exception("Bad Type For ContentHelper::getCollection");
		}
	}