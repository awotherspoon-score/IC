<?php
	class ViewHelperFactory {
		static function createViewHelper(Content $content) {
			if ( $content instanceof Page ) {
				return new PageViewHelper($content);
			} 
		}
	}
