<?php
	class AlbumsIndexViewHelper extends ViewHelper {
		public function sidebar() {
			return '';
		}

		public function breadcrumbs() {
			return '';
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