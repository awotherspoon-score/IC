<?php
        /**
         * Page Data Mapper Object
         *
         * Responsible for creation, retrieval, update and destruction
         * of rows in page table
         *
         * @author Najaf Ali <nali@scorecomms.com>
         * @copyright (c) 2009, Score Communications
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
					."(slug, title, introduction, datecreated, datemodified, status, text, description, keywords, parentid) "
					."VALUES "
					."('{$object->getSlug()}', '{$object->getTitle()}', '{$object->getIntroduction()}', '$now', '$now', '{$object->getStatus()}', '{$object->getText()}', '{$object->getDescription()}', '{$object->getKeywords()}', '{$object->getParentId()}')";
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
					."parentid='{$object->getParentId()}' "
					."WHERE id={$object->getId()} LIMIT 1";
			self::$mysqli->query($query);
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
                 * Double checks a pages slug after a potential title change
                 *
                 * If the title hasn't changed then return. Else generate a new slug
                 * This requires requires n runs to the database, where n is the number of duplicate slugs
                 * TODO: Optimize this so we need at most one trip to the database
                 *
                 * @param $page Page the page object who's slug we need to update
                 */
		function updateSlug($page) {
			$oldSlug = $page->getSlug();
			$newSlug = $this->generateSlug($page->getTitle());
			if ($oldSlug == $newSlug) { return; }

			$suffix = '';
			while ($this->findBySlug($newSlug . $suffix) !== null) {
				if ($suffix == '') { $suffix = 1; }
				$suffix++;
			}
			$page->setSlug($newSlug . $suffix);
		}

                /**
                 * Generate a slug based on a given input string
                 *
                 * Generates a url friendly slug for a given string
                 *
                 * @param $string string the title string to convert into a slug
                 * @return $slug string a url friendly slug based on $string
                 */
		function generateSlug($string) {
			$slug = strtolower( $string ); // lower-case the string
			$slug = preg_replace( '/[^a-z0-9- ]/', '', $slug ); // remove all non-alphanumeric characters except for spaces and hyphens
			$slug = str_replace(' - ', ' ', $slug); //remove all 'real' hyphens with spaces
			$slug = str_replace( ' ', '-', $slug ); // substitute the spaces with hyphens
			return $slug;
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
		
	}
	
	
