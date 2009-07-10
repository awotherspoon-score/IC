<?php
	class UrlHelper {
		function url( $content ) {
			if ($content instanceof Page) {
				return "/pages/{$content->getSlug()}/";
			}

			if ( $content instanceof NewsEvent ) {
				if ( $content->getContentType() == NewsEvent::TYPE_NEWS ) {
					return "/news/{$content->getSlug()}/";
				}
				if ( $content->getContentType() == NewsEvent::TYPE_EVENT ) {
					return "/events/{$content->getSlug()}/";
				}
			}

			if ( $content instanceof Image ) {
				return "/img/photos/{$content->getFilename()}/";
			}


			if ( is_array( $content ) && array_key_exists( 'type', $content ) && array_key_exists( 'period', $content) ) {
				return '/' . $content['type'] . '/' . $content['period'] . '/';
			}
		}
	}
