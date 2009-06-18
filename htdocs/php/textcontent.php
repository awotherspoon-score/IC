<?php
	abstract class TextContent extends Content {
		private $text;
		private $description;
		private $keywords;
		
		public function loadFromArray($array) {
			parent::loadFromArray($array);
			$this->setText($array['text']);
			$this->setDescription($array['description']);
			$this->setKeywords($array['keywords']);
		}

                public function toArray() {
                        return array_merge(parent::toArray(), array(
                                'text' => $this->text,
                                'description' => $this->description,
                                'keywords' => $this->keywords
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
		public function setText($text) {
			$this->text = $text;
		}
		public function setDescription($description) {
			$this->description = $description;
		}
		public function setKeywords($keywords) {
			$this->keywords = $keywords;
		}
	}
