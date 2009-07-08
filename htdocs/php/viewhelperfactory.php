<?php
	class ViewHelperFactory {
		static function createViewHelper(Content $content) {
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
		}
	}
