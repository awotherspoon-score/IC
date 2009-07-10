<?php
	class NewsViewHelper extends ViewHelper {
		//TODO Complete this function (URLS)
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
			$story = $this->content;

			$this_months_news = CommandRunner::run('get-live-news-for-month', array('month' => date('n')))->get('news');
			$this_month_list = '';

			if ( count( $this_months_news ) > 0 ) {
				$this_month_list = "<div class='sidebar-links-title'>\n"
						  ."<p>" . date( 'F', $story->getDateDisplayed() )  . "</p>\n"
						  ."</div>\n"
						  ."<ul class='sidebar-links-list'>\n";

				foreach ( $this_months_news as $news_story ) {
					$this_month_list .= "<li><a href='#'>{$news_story->getTitle()}</a></li>\n";
				}

				$this_month_list .= "</ul>\n";	
			}

			$this_year = date('Y');
			$last_year = $this_year - 1;
			$two_years_ago = $last_year -1;

			$archive_list = "<div class='sidebar-links-title'>\n"
					  ."<p>{$this_year}</p>\n"
					  ."</div>\n"
					  ."<ul class='sidebar-links-list'>\n";
			foreach ( array($this_year, $last_year, $two_years_ago) as $year) {
				$archive_list .= "<li><a href='#'>{$year}</a></li>\n";
			}
			$archive_list .= "</ul>\n";	
			//$archive_list .= "</div>\n";

			$sidebar =  "<div id='sidebar'>\n";
			$sidebar .= $this_month_list . $archive_list;
			$sidebar .= "</div>";
			return $sidebar;
		}

	}
