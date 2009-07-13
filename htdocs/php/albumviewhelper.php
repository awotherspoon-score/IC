<?php
	class AlbumViewHelper extends ViewHelper {
		function breadcrumbs() {
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

				$grid .= "<td><img src='{$image->getSource()}' /><span class='gallery-caption'>{$image->getTitle()}</span></td>\n";

				if ( ( $cell_counter % 3 ) == 0 ) {
					$grid .= "\n</tr>\n<tr>\n";
				}

			}

			$grid .= "</tr>\n";
			$grid .= "</table>";

			return $grid;
		}
	}
