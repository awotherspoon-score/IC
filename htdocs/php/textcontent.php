<?php
	abstract class TextContent extends Content {
		private $text;
		private $description;
		private $keywords;
		private $introduction;
		
		public function loadFromArray($array) {
			parent::loadFromArray($array);
			if (array_key_exists('text', $array)) { $this->setText($array['text']); }
			if (array_key_exists('description', $array)) { $this->setDescription($array['description']); }
			if (array_key_exists('keywords', $array)) { $this->setKeywords($array['keywords']); }
			if (array_key_exists('introduction', $array)) { $this->setIntroduction($array['introduction']); }
		}

                public function toArray() {
                        return array_merge(parent::toArray(), array(
                                'text' => $this->text,
                                'description' => stripslashes( $this->description ),
                                'keywords' => stripslashes( $this->keywords ),
				'introduction' => stripslashes( $this->introduction )
                        ));
                }
		
		//GETTERS + SETTERS
		public function getText() {
			return $this->text;
		}
		public function getDescription() {
			return $this->description;
		}
		public function getKeywords() {
			return $this->keywords;
		}
		public function getIntroduction() {
			return $this->introduction;
		}
		public function setText($text) {
			$this->text = $text;
		}
		public function setDescription($description) {
			$this->description = $description;
		}
		public function setKeywords($keywords) {
			$this->keywords = $keywords;
		}
		public function setIntroduction($introduction) {
			$this->introduction = $introduction;
		}
	}
