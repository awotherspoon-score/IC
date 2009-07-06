<?php
	class UrlHelper {
		function url( Content $content ) {
			if ($content instanceof Page) {
				return "/pages/{$content->getSlug()}/";
			}

			if ($content instanceof Image) {
				return "/img/photos/{$content->getFilename()}/";
			}
		}
	}
