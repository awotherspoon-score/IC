<?php
  /**
   * View Helper For Individual News Story View
   */
	class NewsViewHelper extends ViewHelper {
    /**
     * Generates Breadcrumbs
     *
     * Displays as News | {Year} | {Month} | {Title}
     */
		function breadcrumbs() {
			$story = $this->content;
			$date = $story->getDateDisplayed();
			$year = date('Y', $date);
			$month = date('F', $date);

			$breadcrumb = "<div id='breadcrumb'> "
				."<a href='". $this->url( array( 'type' => 'news/index' ) )  ."'>News</a> | "
				."<a href='". $this->url( array( 'type' => 'news/archive', 'period' => $year ) ) ."'>{$year}</a> | "
				."<a href='". $this->url( array( 'type' => 'news/archive', 'period' => strtolower($month) ) )."'>{$month}</a> | "
				."<a class='thispage' href='#'>{$story->getTitle()}</a>"
				."</div>";
			return $breadcrumb;
		}

		function sidebar() {
			$story = $this->content;

			//$this_months_news = CommandRunner::run('get-live-news-for-month', array('month' => date('n')))->get('news');
			$this_months_news = RequestRegistry::getNewsEventMapper()->findNewsForIndex(); //change these out later if required
			$this_month_list = '';

			if ( count( $this_months_news ) > 0 ) {
				$this_month_list = "<div class='sidebar-links-title'>\n"
						  ."<p>Recent News</p>\n"
						  ."</div>\n"
						  ."<ul class='sidebar-links-list'>\n";

				foreach ( $this_months_news as $news_story ) {
					$this_story_arrow = ( $news_story == $story ) ? '> ' : '' ;
					$title = $this_story_arrow . $news_story->getTitle();
					$this_month_list .= "<li>"
							."<a href='{$this->url($news_story)}'>{$title}</a>"
							."</li>\n";
				}

				$this_month_list .= "</ul>\n";	
			}

			$this_year 	= date('Y');
			$last_year 	= $this_year - 1;
			$two_years_ago 	= $last_year -1;

			$this_month 	= date('F');
			$last_month 	= date( 'F', mktime(0,0,0,date('n') - 1, date('j'), date('Y') ) );
			$two_months_ago = date( 'F', mktime(0,0,0,date('n') - 2, date('j'), date('Y') ) );

			$archive_list = "<div class='sidebar-links-title'>\n"
					  ."<p>News Archive</p>\n"
					  ."</div>\n"
					  ."<ul class='sidebar-links-list'>\n";
			foreach ( array($this_month, $last_month, $two_months_ago, $this_year, $last_year, $two_years_ago) as $time ) {
				$lower_time = strtolower( $time );
				if ( RequestRegistry::getNewsEventMapper()->newsExistsForPeriod( $lower_time ) ) {
					$content = array( 'type' => 'news/archive', 'period' => $lower_time );
					$archive_list .= "<li><a href='{$this->url( $content )}'>{$time}</a></li>\n";
				}
			}

			$archive_list .= "</ul>\n";	
			//$archive_list .= "</div>\n";

			$sidebar =  "<div id='sidebar'>\n";
			$sidebar .= $this_month_list . $archive_list;
			$sidebar .= "</div>";
			return $sidebar;
		}

	}
