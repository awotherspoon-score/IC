<?php
	class AlbumMapper extends ContentMapper {
		function __construct() {
			parent::__construct();
		}
		
		protected function doCreateObject(array $array) {
			$object = new Album();
			$object->loadFromArray($array);
			return $object;
		}
		
		
		
		protected function doInsert(Content $content) {
			$now = time();
			$query = "INSERT INTO albums "
					."(slug, title, datecreated, datemodified, status, datedisplayed, newsid, eventid, featuredimageid) "
					."VALUES "
					."('{$content->getSlug()}','{$content->getTitle()}','$now','$now','{$content->getStatus()}','{$content->getDateDisplayed()}','{$content->getNewsId()}','{$content->getEventId()}','{$content->getFeaturedImageId()}')";
			self::$mysqli->query($query);
			$content->setId(self::$mysqli->insert_id);		
		}
		
		public function update(Content $content) {
			$now = time();
			$query = "UPDATE albums SET "
					."slug='{$content->getSlug()}', "
					."title='{$content->getTitle()}', "
					."datecreated='{$content->getDateCreated()}', "
					."datemodified='$now', "
					."status='{$content->getStatus()}', "
					."datedisplayed='{$content->getDateDisplayed()}', "
					."newsid='{$content->getNewsId()}', "
					."eventid='{$content->getEventId()}', "
					."featuredimageid='{$content->getFeaturedImageId()}' "
					."WHERE id={$content->getId()}";
			self::$mysqli->query($query);
		}
		
		public function delete(Content $content) {
			$query = "DELETE FROM albums WHERE id={$content->getId()} LIMIT 1";
			self::$mysqli->query($query);
		}

		public function selectBySlugQuery($slug) {
			return "SELECT * FROM albums WHERE slug='{$slug}' LIMIT 1";
		}
		
		public function selectQuery( $id ) {
			return "SELECT * FROM albums WHERE id=$id LIMIT 1";
		}
		
		public function selectAllQuery() {
			return "SELECT * FROM albums";
		}
		
		public function targetClass() {
			return 'Album';
		}
		
	}
