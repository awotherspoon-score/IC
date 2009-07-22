<?php
	class NewsIndexViewHelper extends ViewHelper {
		/**
		 * Generates breadcrumbs for the news index
		 * TODO Write this function
		 */
		function breadcrumbs() {
			return '';
		}

		/**
		 * Generates sidebar for the news index
		 *
		 * Currently set to display the same sidebar as NewsViewHelper
		 */
		function sidebar() {
			//this sucks, but it's quick, well encapsulated and it works
			//my OO spidey senses tell me we need to pull sidebar generation into another class
			$newsview = new NewsViewHelper($this->content);
			return $newsview->sidebar();
		}
	}
