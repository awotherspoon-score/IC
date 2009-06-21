<?php
	class Page extends TextContent {
		private $parentId;
                private $children;
		
		
		public function loadFromArray($array) {
			parent::loadFromArray($array);
			if (array_key_exists('parentid', $array)) { $this->setParentId($array['parentid']); }
		}

                public function toArray() {
                        return array_merge(parent::toArray(), array(
                                'parentId' => $this->parentId,
                                'children' => $this->getChildren()->toArray()
                        ));
                }

		//GETTERS + SETTERS
		public function getParentId() {
			return $this->parentId;
		}
		public function setParentId($parentId) {
			$this->parentId = $parentId;
		}

                public function getChildren() {
                        if (!isset($this->children)) {
                                $this->children = RequestRegistry::getPageMapper()->findByParentId($this->getId());
                        }
                        return $this->children;
                }
	}
