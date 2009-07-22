<?php
        /**
         * Page Data Mapper Object
         *
         * Responsible for creation, retrieval, update and destruction
         * of rows in page table
         */
	class PageMapper extends ContentMapper {
                
		function __construct() {
			parent::__construct();
		}

                /**
                 * Template method implementation
                 *
                 * Creates a Page object using values in parameter $array
                 * Called by parent::createObject()
                 *
                 * @param $array assoc contains page values in format 'column' => 'value'
                 * @return $object Page the created instance of Page
                 */
		protected function doCreateObject(array $array) {
			$object = new Page();
			$object->loadFromArray($array);
			return $object;
		}
	
                /**
                 * Template Method Implementation
                 *
                 * Inserts a new row into table 'pages'
                 * Called by parent::insert()
                 *
                 * @param $object Content the page object to insert
                 */
		protected function doInsert(Content $object) {
			$now = time();
                        $this->updateSlug($object); 
			$query = "INSERT INTO pages "
					."(slug, title, introduction, datecreated, datemodified, status, text, description, keywords, parentid, imageid) "
					."VALUES "
					."('{$object->getSlug()}', '{$object->getTitle()}', '{$object->getIntroduction()}', '$now', '$now', '{$object->getStatus()}', '{$object->getText()}', '{$object->getDescription()}', '{$object->getKeywords()}', '{$object->getParentId()}', '{$object->getImageId()}')";
			self::$mysqli->query($query);
			$object->setId(self::$mysqli->insert_id);	 
		}
		
                /**
                 * Updates a row in the 'pages' table
                 *
                 * @param $object Content the page object to update
                 */
		function update(Content $object) {
			$now = time();
			$object->setDateModified($now);
			$this->updateSlug($object);
			$query = "UPDATE pages SET "
					."slug='{$object->getSlug()}', "
					."title='{$object->getTitle()}', "
					."introduction='{$object->getIntroduction()}', "
					."datecreated='{$object->getDateCreated()}', "
					."datemodified='$now', "
					."status='{$object->getStatus()}', "
					."text='{$object->getText()}', "
					."description='{$object->getDescription()}', "
					."keywords='{$object->getKeywords()}', "
					."parentid='{$object->getParentId()}', "
					."imageid='{$object->getImageId()}' "
					."WHERE id={$object->getId()} LIMIT 1";
			self::$mysqli->query($query);
		}

        function insertSuggestedLink( $page_id, $href, $anchor_text ) {
            $query = "insert into suggested_links (page_id, href, anchor_text) "
                    ."values ( {$page_id}, '{$href}', '{$anchor_text}' )";
	    //echo $query;
            self::$mysqli->query( $query );
        }

        function deleteSuggestedLink( $id ) {
            $query = "delete from suggested_links where id={$id} limit 1";
            self::$mysqli->query( $query );
        }
	
                /**
                 * Deletes a row in the 'pages' table
                 *
                 * @param $object the page object to delete
                 */
		function delete(Content $object) {
			$query = "DELETE FROM pages WHERE id={$object->getId()} LIMIT 1";
			self::$mysqli->query($query);
		}

                

		/**
		 * Find 3 Top Level Pages
		 * 
		 * The School, Joining Us and Way Of Life
		 *
		 * @return PageCollection collection containing top level pages
		 */
		function findTopPages() {
			return $this->createCollection($this->queryToArray($this->selectTopPagesQuery()));
		}

		/**
		 * SQL For finding top 3 level pages
		 *
		 * @return string the sql query that will find 3 top level pages
		 */
		function selectTopPagesQuery() {
			return "SELECT * FROM pages WHERE id='1' OR id='2' OR id='3' LIMIT 3";
		}

		function findLiveByParentId($parentid) {
                        return $this->createCollection($this->queryToArray($this->selectLiveByParentIdQuery($parentid), true)); 
		}

		/**
		 * SQL For Finding Live By ParentId
		 *
		 * @return string the sql query that will return all live pages with a given parent id
		 */
		function selectLiveByParentIdQuery($parentid) {
			$live = Content::STATUS_LIVE;
			return "SELECT * FROM pages WHERE status='{$live}' AND parentid={$parentid}";
		}

                function findByParentId($parentid) {
                        return $this->createCollection($this->queryToArray($this->selectByParentIdQuery($parentid), true));                        
                }

                public function selectByParentIdQuery($parentid) {
                       return "SELECT * FROM pages WHERE parentid=$parentid"; 
                }
		
		public function selectQuery( $id ) {
			return "SELECT * FROM pages WHERE id=$id LIMIT 1";
		}

                public function selectBySlugQuery( $slug ) {
                        return "SELECT * FROM pages WHERE slug='$slug' LIMIT 1";
                }
		
		public function selectAllQuery() {
			return "SELECT * FROM pages";
		}
		
		public function targetClass() {
			return 'Page';
		}

		//Convenience Methods For Getting Prospective, Current, Staff Pages
		public function findProspectivePage() {
			return $this->find( 27 );
		}

		public function findCurrentPage() {
			return $this->find( 28 );
		}

		public function findStaffPage() {
			return $this->find( 29 );
		}

		public function findSuggestedLinksForPage( $id ) {
			if ( array_key_exists( $id, $this->id_pcs_lookup() ) ) {
				$array =  $this->queryToArray( $this->selectSuggestedLinkQueryByPageIdQuery( $id ), true );
        return ( $array == null ) ? array() : $array; //if no matches found, return an empty array rather than null
			} else {
				throw new Exception("Page:#$id is not Prospective/Current/Staff");
			}
		}

		public function selectSuggestedLinkQueryByPageIdQuery( $id ) {
			return "SELECT * FROM suggested_links WHERE page_id=$id ORDER BY id ASC";
		}

		public function findPcsPage( $code ) {
			switch ( $code ) {
				case 'prospective' :
					return $this->findProspectivePage();
					break;
				case 'current':
					return $this->findCurrentPage();
					break;
				case 'staff':
					return $this->findStaffPage();
					break;
				default:
					throw new Exception("Bad Pcs Code: $code");
					break;
			}
		}

		private function pcs_id_lookup() {
			return array(
				'prospective' 	=> 27,
				'current' 	=> 28,
				'staff'  	=> 29
			);
		}

		private function id_pcs_lookup() {
			return array_flip( $this->pcs_id_lookup() );
		}
		
	}
	
	
