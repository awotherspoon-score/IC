<?php
	class Album extends Content {
		private $dateDisplayed;
		private $newsId;
		private $eventId;
		private $featuredImageId;
		private $images;
		private $featured_image;
		
		public function loadFromArray(array $array) {
			parent::loadFromArray($array);
			if (array_key_exists('date', $array)) { $this->setDateDisplayed($array['date']); }
			if (array_key_exists('newsid', $array)) { $this->setNewsId($array['newsid']); }
			if (array_key_exists('eventid', $array)) { $this->setEventId($array['eventid']); }
			if (array_key_exists('featuredimageid', $array)) { $this->setFeaturedImageId($array['featuredimageid']); }
			if (array_key_exists('datedisplayed', $array)) { $this->setDateDisplayed($array['datedisplayed']); }
		}

                public function toArray() {
                        $array = parent::toArray();
                        return array_merge($array, array(
                                'dateDisplayed' => $this->dateDisplayed,
                                'newsId' => $this->newsId,
                                'eventId' => $this->eventId,
                                'featuredImageId' => $this->featuredImageId
                        ));
                }

		public function getImages() {
			if ( ! isset( $this->images ) ) {
				$this->images = RequestRegistry::getImageMapper()->findImagesInAlbum($this);
			}
			return $this->images;
		}

		public function getFeaturedImage() {
			if ( ! isset( $this->featured_image ) ) {
				$this->featured_image = RequestRegistry::getImageMapper()->findFeaturedImageForAlbum( $this );
			}	

			if ( $this->featured_image == null ) { 
				return $this->getFirstImage();
			}

			return $this->featured_image;
		}

		public function getFirstImage() {
			$images = $this->getImages();

			foreach ($images as $image) {
				return $image; //just return the top one
			}
		}

		//GETTERS + SETTERS
		public function getDateDisplayed() {
			return $this->dateDisplayed;
		}
		public function getNewsId() {
			return $this->newsId;
		}
		public function getEventId() {
			return $this->eventId;
		}
		public function getFeaturedImageId() {
			return $this->featuredImageId;
		}
		public function setDateDisplayed($dateDisplayed) {
			$this->dateDisplayed = $dateDisplayed;
		}
		public function setNewsId($newsId) {
			$this->newsId = $newsId;
		}
		public function setEventId($eventId) {
			$this->eventId = $eventId;
		}
		public function setFeaturedImageId($featuredImageId) {
			$this->featuredImageId = $featuredImageId;
		}
	}
