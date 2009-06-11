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
			self::$dba->query($query);
		}
		
		function delete(Content $object) {
			$query = "DELETE FROM pages WHERE id={$object->getId()} LIMIT 1";
			self::$mysqli->query($query);
		}
		
		public function selectQuery( $id ) {
			return "SELECT * FROM pages WHERE id=$id LIMIT 1";
		}

                public function selectBySlugQuery( $slug ) {
                        return "SELECT * FROM pages WHERE slug=$slug LIMIT 1";
                }
		
		public function selectAllQuery() {
			return "SELECT * FROM pages";
		}
		
		public function targetClass() {
			return 'Page';
		}
		
	}
	
	
