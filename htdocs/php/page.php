<?php
	class Page extends TextContent {
		private $parentId;
		
		
		public function loadFromArray($array) {
			parent::loadFromArray($array);
			$this->setParentId($array['parentid']);
		}
		//GETTERS + SETTERS
		public function getParentId() {
			return $this->parentId;
		}
		public function setParentId($parentId) {
			$this->parentId = $parentid;
		}
	}
