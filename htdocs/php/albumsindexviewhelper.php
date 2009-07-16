<?php
  /**
   * View Helper For Albums Index Page
   */
	class AlbumsIndexViewHelper extends ViewHelper {
    /**
     * Generates breadcrumbs for the albums index page
     *
     * Dislpayed as Home | Gallery
     */
		public function breadcrumbs() {
      $breadcrumbs = "<div id='breadcrumb'>\n";
      $breadcrumbs .= "<a href='/'>Home</a> | \n";
      $breadcrumbs .= "<a class='thispage' href='/gallery/'>Gallery</a>\n";
      $breadcrumbs .= "</div>\n";
      return $breadcrumbs;
		}

		public function sidebar() {
      $vh = new AlbumViewHelper();
      return $vh->sidebar();
		}


		public function gallery_grid() {
			$albums = CommandRunner::run( 'get-albums-for-index' )->get( 'albums' );
			$cell_counter = 0;

			$grid = "<table id='gallery-grid'>\n";
			$grid .= "<tr>\n";

			foreach ( $albums as $album ) {
				if ( ! $album->hasImages() ) { continue; }
				$cell_counter++;
				$image = $album->getFeaturedImage();
				$grid .= "<td>
						<a href='{$this->url($album)}'><img src='{$image->getSource()}' /></a>
						<br /><span class='gallery-caption'>{$album->getTitle()}</span>
					</td>\n";

				if ( ( $cell_counter % 3 ) == 0 ) {
					$grid .= "\n</tr>\n<tr>\n";
				}

			}
			$grid .= "</tr>\n";
			$grid .= "</table>";

			return $grid;
		}
	}
