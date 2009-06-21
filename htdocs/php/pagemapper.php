<?php
	class PageMapper extends ContentMapper {
		function __construct() {
			parent::__construct();
		}
	
		protected function doCreateObject(array $array) {
			$object = new Page();
			$object->loadFromArray($array);
			return $object;
		}
		
		
		
		protected function doInsert(Content $object) {
			$now = time();
			$query = "INSERT INTO pages "
					."(slug, title, datecreated, datemodified, status, text, description, keywords, parentid) "
					."VALUES "
					."('{$object->getSlug()}', '{$object->getTitle()}', '$now', '$now', '{$object->getStatus()}', '{$object->getText()}', '{$object->getDescription()}', '{$object->getKeywords()}', '{$object->getParentId()}')";
			self::$mysqli->query($query);
			$object->setId(self::$mysqli->insert_id);	 
		}
		
		function update(Content $object) {
			$now = time();
			$object->setDateModified($now);
			$this->updateSlug($object);
			$query = "UPDATE pages SET "
					."slug='{$object->getSlug()}', "
					."title='{$object->getTitle()}', "
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
		
		function delete(Content $object) {
			$query = "DELETE FROM pages WHERE id={$object->getId()} LIMIT 1";
			self::$mysqli->query($query);
		}

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

		function generateSlug($string) {
			$slug = strtolower( $string ); // lower-case the string
			$slug = preg_replace( '/[^a-z0-9- ]/', '', $slug ); // remove all non-alphanumeric characters except for spaces and hyphens
			$slug = str_replace(' - ', ' ', $slug); //remove all 'real' hyphens with spaces
			$slug = str_replace( ' ', '-', $slug ); // substitute the spaces with hyphens
			return $slug;
		}

                function findByParentId($parentid) {
                        return $this->createCollection($this->queryToArray($this->selectByParentIdQuery($parentid)));                        
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
	
	
