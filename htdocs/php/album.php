<?php
	class Album extends Content {
		private $dateDisplayed
		private $newsId;
		private $eventId;
		private $featuredImageId;
		
		public function loadFromArray(array $array) {
			parent::loadFromArray($array);
			$this->setDateDisplayed($array['date']);
			$this->setNewsId($array['newsid']);
			$this->setEventId($array['eventid']);
			$this->setFeaturedImageId($array['featuredimageid']);
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