<?php
	class NewsIndexViewHelper extends ViewHelper {
		function breadcrumbs() {
			return '';
		}
		function sidebar() {
			//this sucks, but it's quick, well encapsulated and it works
			//tells me we need to pull sidebar generation into another class
			$newsview = new NewsViewHelper($this->content);
			return $newsview->sidebar();
		}
	}
