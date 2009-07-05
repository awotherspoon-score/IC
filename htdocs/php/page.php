<?php
	class Page extends TextContent {
		private $parentId;

		/**
		 * $chilren PageCollection Collection of Child Pages
		 */
                private $children;

		/**
		 * $parent Page Object Representing Parent of this Page
		 */
		 private $parent;
		
		
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
		public function setParentId( $parentId ) {
			$this->parentId = $parentId;
		}
		//END GETTERS + SETTERS

                public function getChildren() {
                        if ( ! isset ( $this->children ) ) {
                                $this->children = RequestRegistry::getPageMapper()->findByParentId($this->getId());
                        }
                        return $this->children;
                }
		
		/**
		 * Returns parent page object
		 *
		 * @return $parent Page parent page object or null if top level
		 */
		public function getParent() {

			if ( $this->isTopLevelPage() ) {
				return null;
			}

			if ( ! isset( $this->parent ) ) {
				$this-> parent = RequestRegistry::getPageMapper()->find( $this->parentId );
			}

			return $this->parent;
		}

		/**
		 * Returns true if this is a top level page, false otherwise
		 */
		public function isTopLevelPage() {
			if ( $this->parentId == 0 ) {
				return true;
			}
			return false;
		}

		/**
		 *  Returns an array with the first element as top level ancestor, parent and then self
		 */
		public function getAncestry() {
			$ancestry = array();
			$ancestry[] = $this;
			$parent = $this->getParent();

			while ( $parent !== null ) {
				$ancestry[] = $parent;
				$parent = $parent->getParent();
			}
			return array_reverse($ancestry);
		}
	}
