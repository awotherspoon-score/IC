<?php
	class EventViewHelper extends ViewHelper {
		//TODO Complete this function (URLS)
		function breadcrumbs() {
			$story = $this->content;
			$date = $story->getDateDisplayed();
			$year = date('Y', $date);
			$month = date('F', $date);

			$breadcrumb = "<div id='breadcrumb'> "
				."<a href='". $this->url( array( 'type' => 'events/index' ) )  ."'>Events</a> | "
				."<a href='". $this->url( array( 'type' => 'events/calendar', 'period' => $year ) ) ."'>{$year}</a> | "
				."<a href='". $this->url( array( 'type' => 'events/calendar', 'period' => strtolower($month) ) )."'>{$month}</a> | "
				."<a class='thispage' href='#'>{$story->getTitle()}</a>"
				."</div>";
			return $breadcrumb;
		}

		function sidebar() {
			$event = $this->content;

			$this_months_events = RequestRegistry::getNewsEventMapper()->findEventsForIndex(); //change these out later if required
			$this_month_list = '';

			if ( count( $this_months_events ) > 0 ) {
				$this_month_list = "<div class='sidebar-links-title'>\n"
						  ."<p>Upcoming Events</p>\n"
						  ."</div>\n"
						  ."<ul class='sidebar-links-list'>\n";

				foreach ( $this_months_events as $news_event ) {
					$this_event_arrow = ( $news_event == $event ) ? '> ' : '' ;
					$title = $this_event_arrow . $news_event->getTitle();
					$this_month_list .= "<li>"
							."<a href='{$this->url($news_event)}'>{$title}</a>"
							."</li>\n";
				}

				$this_month_list .= "</ul>\n";	
			}
			$this_year 	= date('Y');
			$next_year 	= $this_year + 1;
			$two_years_later 	= $last_year + 1;

			$this_month 	= date('F');
			$next_month 	= date( 'F', mktime(0,0,0,date('n') + 1, date('j'), date('Y') ) );
			$two_months_later = date( 'F', mktime(0,0,0,date('n') + 2, date('j'), date('Y') ) );

			$archive_list = "<div class='sidebar-links-title'>\n"
					  ."<p>Events Calendar</p>\n"
					  ."</div>\n"
					  ."<ul class='sidebar-links-list'>\n";

			foreach ( array( $this_month, $next_month, $two_months_later, $this_year, $next_year, $two_years_later ) as $time ) {
				$lower_time = strtolower( $time );
				if ( RequestRegistry::getNewsEventMapper()->eventsExistForPeriod( $lower_time ) ) {
					$content = array( 'type' => 'events/calendar', 'period' => $lower_time );
					$archive_list .= "<li><a href='{$this->url( $content )}'>{$time}</a></li>\n";
				}
			}

			$archive_list .= "</ul>\n";	
			//$archive_list .= "</div>\n";

			 */
			$sidebar =  "<div id='sidebar'>\n";
			$sidebar .= $this_month_list /*. $archive_list*/;
			$sidebar .= "</div>";
			return $sidebar;
		}

	}
