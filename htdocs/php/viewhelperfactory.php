<?php
	class ViewHelperFactory {
		static function createViewHelper( $content ) {


			//takes a content object for single page displays

			if ( $content instanceof Page ) {
				return new PageViewHelper($content);
			}

			if ( $content instanceof NewsEvent ) {
				switch ( $content->getContentType() ) {
					case NewsEvent::TYPE_NEWS :
						return new NewsViewHelper($content);
						break;
					case NewsEvent::TYPE_EVENT :
						return new EventViewHelper($content);
						break;
				}
			}

			if ( $content instanceof Album ) {
				return new AlbumViewHelper( $content );
			}

			//or an array will do the job when returning a view helper for a page designed to display multiple content items
			//in this case we need an array such that...
			// $content = array(
			// 			'type' => 'news/index' | 'news/archive' | 'events/index' | 'events/calendar',
			// 			'period' => '2009' | '2008' | 'january' | 'march' ...,
			// );
			// where only type is mandatory for all instances. Archives require a 'period', and there will probably be
			// more constraints to follow. Not very well designed but hey, deadlines! 

			if ( is_array( $content ) ) {
				switch ( $content['type'] ) {
					case 'news/index':
						return new NewsIndexViewHelper( $content );
						break;
					case 'news/archive':
						return new NewsArchiveViewHelper( $content );
						break;
					case 'events/index':
						return new EventsIndexViewHelper( $content );
						break;
					case 'events/calendar':
						return new EventsArchiveViewHelper( $content );
						break;
				}
			}
		}
	}
