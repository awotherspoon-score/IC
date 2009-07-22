<?php
	class HomeViewHelper extends ViewHelper {

		function news_column() {
			$news = RequestRegistry::getNewsEventMapper()->findNewsForHomepage();	
			$column = "
			<div id='news-column'>
			<h3 class='cufoned-headers'>News</h3>";

			foreach ( $news as $story ) {
				$column .= "<p>{$story->getTitle()} - {$story->getIntroduction(10)}...&nbsp;<a href='{$this->url( $story )}' class='morelink'>more</a></p>";
			}

			$column .= "
			<div class='rss-box'>
				<a href=''><img src='img/icons/big-rss-icon.jpg' /></a>
				<p class='rss-box-text'><a href=''>Subscribe</a> to receive updates<br /><a href=''>What is RSS?</a></p>
			</div>
			</div><!-- /news-column -->";
			
			return $column;

		}

		function calendar_column() {
			$events = RequestRegistry::getNewsEventMapper()->findEventsForHomepage();
			$column = "
			<div id='events-column'>
			<h3 class='cufoned-headers'>Calendar</h3>";

			foreach ( $events as $story ) {
				$column .= "<p>{$story->getTitle()} - {$story->getIntroduction(10)}...&nbsp;<a href='{$this->url( $story )}' class='morelink'>more</a></p>";
			}

			$column .= "
			<div class='rss-box'>
				<a href=''><img src='img/icons/big-rss-icon.jpg' /></a>
				<p class='rss-box-text'><a href=''>Subscribe</a> to receive updates<br /><a href=''>What is RSS?</a></p>
			</div>
			</div><!-- /news-column -->";
			
			return $column;

		}	






		/**
		 * Sign of bad OO design here:
		 * we need to have these functions because viewhelpers must implement them
		 * BUT they're irrelevant for the homepage. No time to refactor.
		 * But hey, we get a bunch of other stuff for free, so it's not the end of the world
		 *
		 * Moral: Favour composition over inheritance
		 */
		function sidebar() {
		}
		function breadcrumbs() {
		}
	}
