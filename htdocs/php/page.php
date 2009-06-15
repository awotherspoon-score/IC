<?php
	class Page extends TextContent {
		private $parentId;
                private $children;
		
		
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

                public function getChildren() {
                        if (!isset($this->children)) {
                                $this->children = RequestRegistry::getPageMapper()->findByParentId($this->parentId);
                        }
                }
	}
