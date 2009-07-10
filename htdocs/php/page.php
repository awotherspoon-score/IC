<?php
	class Page extends TextContent {
		private $parentId;

		/**
		 * $chilren PageCollection Collection of Child Pages
		 */
                private $children;

		/**
		 * $liveChildren PageCollection Collection of Live Child Pages
		 */
		 private $liveChildren;

		/**
		 * $parent Page Object Representing Parent of this Page
		 */
	 	private $parent;

		/**
		 * $ancestry Array contains ancestry of this page, e.g. element 0 is top level parent, 1 is parent, 0 is self
		 */
		private $ancestry;
		
		
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
                        if ( ! isset( $this->children ) ) {
                                $this->children = RequestRegistry::getPageMapper()->findByParentId( $this->getId() );
                        }
                        return $this->children;
                }

		public function getLiveChildren() {
			if ( ! isset( $this->liveChildren ) ) {
				$this->liveChildren = RequestRegistry::getPageMapper()->findLiveByParentId( $this->getId() );
			}
			return $this->liveChildren;
		
		}

		public function hasLiveChildren() {
			return ( $this->getLiveChildren() != null );
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

		public function level() {
			if ( $this->isTopLevelPage() ) {
				return 1;
			}
			return count( $this->getAncestry() );
		}

		/**
		 *  Returns an array with the first element as top level ancestor, parent and then self
		 */
		public function getAncestry() {
			if ( ! isset( $this->ancestry ) ) {
				$ancestry = array();
				$ancestry[] = $this;
				$parent = $this->getParent();

				while ( $parent !== null ) {
					$ancestry[] = $parent;
					$parent = $parent->getParent();
				}
				$this->ancestry = array_reverse($ancestry);
			}
			return $this->ancestry;
		}

	}
