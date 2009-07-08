<?php
	class NewsViewHelper extends ViewHelper {
		//TODO Complete this function
		function breadcrumbs() {
			$story = $this->content;
			$date = $story->getDateDisplayed();
			$year = date('Y', $date);
			$month = date('F', $date);

			$breadcrumb = "<div id='breadcrumb'> "
				."<a href='#'>News</a> | "
				."<a href='#'>{$year}</a> | "
				."<a href='#'>{$month}</a> | "
				."<a class='thispage' href='#'>{$story->getTitle()}</a>"
				."</div>";
			return $breadcrumb;

		}

		function sidebar() {
		}
	}
