<?php
	class NewsEventMapper extends ContentMapper {
		function __construct() {
			parent::__construct();
		}
		
		protected function doCreateObject(array $array) {
			$object = new NewsEvent();
			$object->loadFromArray($array);
			return $object;
		}
		
		
		
		protected function doInsert(Content $object) {
			$now = time();
			$query = "INSERT INTO newsevents "
					."(slug, title, introduction, datecreated, datemodified, text, description, keywords, datedisplayed, type) "
					."VALUES "
					."('{$object->getSlug()}','{$object->getTitle()}', '{$object->getIntroduction()}', '$now','$now','{$object->getText()}','{$object->getDescription()}','{$object->getKeywords()}','{$object->getDateDisplayed()}','{$object->getType()}')";
			self::$mysqli->query($query);
			$object->setId(self::$mysqli->insert_id);
		}
		
		public function update(Content $object) {
			$now = time();
			$query = "UPDATE newsevents SET "
					."slug='{$object->getSlug()}', "
					."title='{$object->getTitle()}', "
					."datecreated='{$object->getDateCreated()}', "
					."introduction='{$object->getIntroduction()}, "
					."datemodified='$now', "
					."text='{$object->getText()}', "
					."description='{$object->getDescription()}', "
					."keywords='{$object->getKeywords()}', "
					."datedisplayed='{$object->getDateDisplayed()}', "
					."type='{$object->getType()}' "
					."WHERE id={$object->getId()} LIMIT 1";
			self::$mysqli->query($query);
		}
		
		public function delete(Content $object) {
			$query = "DELETE FROM newsevents WHERE id={$object->getId()} LIMIT 1";
			self::$mysqli->query($query);
		}
		
		protected function selectQuery( $id ) {
			return "SELECT * FROM newsevents WHERE id=$id";
		}
		
		protected function selectAllQuery() {
			return "SELECT * FROM newsevents";
		}
		
		protected function targetClass() {
			return 'NewsEvent';
		}
		
		
	}
