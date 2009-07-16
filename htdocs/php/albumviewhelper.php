<?php
  /**
   * View Helper For Individual Album View
   */
	class AlbumViewHelper extends ViewHelper {
    /**
     * Generates Breadcrumbs
     *
     * Displayed as Home | Gallery | {Gallery Title}
     */
		function breadcrumbs() {
      $gallery = $this->content;
      $breadcrumbs = "<div id='breadcrumb'>\n";
      $breadcrumbs .= "<a href='/'>Home</a> | \n";
      $breadcrumbs .= "<a href='/gallery/'>Gallery</a> | \n";
      $breadcrumbs .= "<a class='thispage' href='{$this->url( $gallery )}'>{$gallery->getTitle()}</a>\n";
      $breadcrumbs .= "</div>\n";
      return $breadcrumbs;
		}

		function sidebar() {
      $album = $this->content;

      //Archive Albums Links List
      $this_year = date('Y');
      $last_year = $this_year - 1;
      $year_before_last = $last_year - 1;
      $this_month = date('F');
      $last_month = date('F', mktime( 0, 0, 0, date('n') - 1, 1, date('Y') ) );
      $month_before_last = date('F', mktime( 0, 0, 0, date('n') - 2, 1, date('Y') ) );
      $archive_array = array(
        $this_month,
        $last_month,
        $month_before_last,
        $this_year,
        $last_year,
        $year_before_last
      );

      $archive_section = "<div class='sidebar-links-title'>\n"
                        ."<p>Gallery Archive</p>\n"
                        ."</div>\n"
                        ."<ul class='sidebar-links-list'>\n";

      foreach ( $archive_array as $period ) {
        $lower_period = strtolower( $period );
        $content = array( 
          'type' => 'gallery/archive', 
          'period' => $lower_period 
        );
        $archive_section .= "<li>"
          ."<a href='{$this->url( $content )}'>{$period}</a></li>\n";

      }

      $archive_section .= "</ul>\n";

      //Recent Albums Link List
      $five_recent_albums = RequestRegistry::getAlbumMapper()->findFiveMostRecentLiveAlbums();

      $recent_section = "<div class='sidebar-links-title'>\n"
                        ."<p>Recent Galleries</p>\n"
                        ."</div>\n"
                        ."<ul class='sidebar-links-list'>\n";

      foreach ( $five_recent_albums as $album ) {
        if ( ! $album->hasImages() ) { continue; }
        $recent_section .= "<li><a href='{$this->url( $album )}'>{$album->getTitle()}</a></li>\n";
      }
      $recent_section .= "</ul>\n";


      $sidebar = "<div id='sidebar'>\n";
      $sidebar .= $recent_section . $archive_section;
      $sidebar .= "</div>\n";
      return $sidebar;
      
		}

		function gallery_grid() {
			$album = $this->content;
			$images = $album->getImages();
			$cell_counter = 0;

			$grid = "<table id='gallery-grid'>\n";
			$grid .= "<tr>\n";

			foreach ( $images as $image ) {
				$cell_counter++;

				$grid .= "<td><a class='image-link' href='{$image->getSource()}'><img src='{$image->getSource()}' /></a><span class='gallery-caption'>{$image->getTitle()}</span></td>\n";

				if ( ( $cell_counter % 3 ) == 0 ) {
					$grid .= "\n</tr>\n<tr>\n";
				}

			}

			$grid .= "</tr>\n";
			$grid .= "</table>";

			return $grid;
		}
	}
