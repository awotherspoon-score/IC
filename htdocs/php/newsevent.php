<?php
	class NewsEvent extends TextContent {
		private $dateDisplayed;
		private $type;
		
		public function loadFromArray($array) {
			parent::loadFromArray($array);
			if (array_key_exists('datedisplayed', $array)) { $this->setDateDisplayed($array['datedisplayed']); }
			if (array_key_exists('type', $array)) { $this->setType($array['type']); }
		}

                public function toArray() {
                        return array_merge(parent::toArray(), array(
                                'dateDisplayed' => $this->dateDisplayed,
                                'type' => $this->type
                        ));
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
