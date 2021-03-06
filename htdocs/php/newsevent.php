<?php
	class NewsEvent extends TextContent {
		const TYPE_NEWS = 2;
		const TYPE_EVENT = 3;	
		private $dateDisplayed;
		private $type;
		
		public function loadFromArray($array) {
			parent::loadFromArray($array);
			if (array_key_exists('datedisplayed', $array)) { $this->setDateDisplayed($array['datedisplayed']); }
			if (array_key_exists('type', $array)) { $this->setContentType($array['type']); }
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
		public function getContentType() {
			return $this->type;
		}
		public function setDateDisplayed($dateDisplayed) {
			$this->dateDisplayed = $dateDisplayed;
		} 
		public function setContentType($type) {
			$this->type = $type;
		}

		/**
		 * returns the first x words of the content
		 *
		 * @param $length int size of the snippet, optional, defaults to 50 words
		 * @return $intro string the intro to return
		 */
		public function getIntroduction( $length = 50 ) {
			$intro = strip_tags( $this->getText() );
			$textArray = explode( ' ', $intro);
			$textArray = array_slice( $textArray, 0, $length, true);
			return implode( ' ', $textArray );
		}
	}
