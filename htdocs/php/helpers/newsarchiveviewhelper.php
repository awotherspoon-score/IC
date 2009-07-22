<?php
	class NewsArchiveViewHelper extends ViewHelper {
		function breadcrumbs() {
			return '';
		}
		function sidebar() {
			//this also sucks, but again it's quick, well encapsulated and it works
			$newsview = new NewsViewHelper($this->content);
			return $newsview->sidebar();
		}
	}
