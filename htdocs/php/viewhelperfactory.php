<?php
  /**
   * In charge of creating view helpers
   *
   * Defines a single static method that returns
   * A view helper object to display things like sidebars
   * breadcrumbs, etc
   */
	class ViewHelperFactory {

    /**
     * Instantiates and returns view helper objects
     * based on contents of paramter $content
     *
     * $content can be an instance of a subclass of Content
     * or it can be an assoicative array as described in the srouce
     *
     * @param $content mixed determines what sort of view helper this method returns
     */
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
				/*
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
					case 'gallery/index':
						return new GalleryIndexViewHelper( $content );
						break;
					case 'gallery/archive':
						return new GalleryArchiveViewHelper( $content );
						break;
					default:
						$error = "Bad type value in content array for view helper factory";
						throw new Exception( $error );
						break;

				}
				*/

				//this does the equivalent of the above, but in two lines and sans error checking
				$class = str_replace( ' ', '',  ucwords( str_replace( '/', ' ', $content['type'] ) ) ) . 'ViewHelper';
				return new $class( $content );
			}
		}
	}
