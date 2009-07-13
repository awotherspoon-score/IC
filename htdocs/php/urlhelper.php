<?php
	/**
	 * Generates URLS for content
	 *
	 * We keep all URL generation here so with a bit of .htaccess elbow grease,
	 * we could in theory change the url structure later without much work
	 */
	class UrlHelper {
		/**
		 * Generates URL based on content type
		 *
		 * Big list of if/elses that generate URLs as per a specific type
		 * The object oriented voices in my head tell me we could just delegate url construction to the view helpers
		 *
		 * BUT  then the other voices remind me that we need URL generation separate because within a given view helper, 
		 * we might be generating URLs for various content types. 
		 * For that reason, a view helper we can use to generate all URLs, where it is, is required
		 */
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

			if ( is_array( $content ) && array_key_exists( 'type', $content ) && $content['type'] == 'news/index' ) {
				return '/news/';
			}

			if ( is_array( $content ) && array_key_exists( 'type', $content ) && $content['type'] == 'events/index' ) {
				return '/events/';
			}


			if ( is_array( $content ) && array_key_exists( 'type', $content ) && array_key_exists( 'period', $content) ) {
				return '/' . $content['type'] . '/' . $content['period'] . '/';
			}


		}
	}
