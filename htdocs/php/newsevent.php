<?php
	class NewsEvent extends TextContent {
		private $dateDisplayed;
		private $type;
		
		public function loadFromArray($array) {
			parent::loadFromArray($array);
			$this->setDateDisplayed($array['datedisplayed']);
			$this->setType($array['type']);
		}
		
		//GETTERS + SETTERS
		public function getDateDisplayed() {
			return $this->dateDisplayed;
		} 
		public function getType() {
			return $this->type;
		}
		public function setDateDisplayed($dateDisplayed) {
			$this->dateDisplayed = $dateDisplayed;
		} 
		public function setType($type) {
			$this->type = $type;
		}
	}