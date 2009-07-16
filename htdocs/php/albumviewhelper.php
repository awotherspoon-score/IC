<?php
  /**
   * View Helper For Individual Album View
   *
   * Displayed as Home | Gallery | {Gallery Title}
   */
	class AlbumViewHelper extends ViewHelper {
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
