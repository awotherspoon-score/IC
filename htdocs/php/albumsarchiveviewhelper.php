<?php
  class AlbumsArchiveViewHelper extends ViewHelper {
    function sidebar(){
      $vh = new AlbumViewHelper();
      return $vh->sidebar();
    }

    function breadcrumbs() {
      return '';
    }

    function gallery_grid() {
			$albums = RequestRegistry::getAlbumMapper()->findAllLiveAlbumsForPeriod( $this->content['period'] );
			$cell_counter = 0;

			$grid = "<table id='gallery-grid'>\n";
			$grid .= "<tr>\n";

			foreach ( $albums as $album ) {
        if ( ! $album->hasImages() ) { continue; }
        $image = $album->getFeaturedImage();
				$cell_counter++;

				$grid .= "<td><a href='{$this->url( $album )}'><img src='{$image->getSource()}' /></a><br /><span class='gallery-caption'>{$album->getTitle()}</span></td>\n";

				if ( ( $cell_counter % 3 ) == 0 ) {
					$grid .= "\n</tr>\n<tr>\n";
				}

			}

			$grid .= "</tr>\n";
			$grid .= "</table>";

			return $grid;
    }

  }
