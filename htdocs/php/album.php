<?php
	class Album extends Content {
		private $dateDisplayed
		private $newsId;
		private $eventId;
		private $featuredImageId;
		
		public function loadFromArray(array $array) {
			parent::loadFromArray($array);
			if (array_key_exists('date', $array)) { $this->setDateDisplayed($array['date']); }
			if (array_key_exists('newsid', $array)) { $this->setNewsId($array['newsid']); }
			if (array_key_exists('eventid', $array)) { $this->setEventId($array['eventid']); }
			if (array_key_exists('featuredimageid', $array)) { $this->setFeaturedImageId($array['featuredimageid']); }
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
		public function getFreaturedImageId() {
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
