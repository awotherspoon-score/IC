<?php
	class ImageMapper extends ContentMapper {
	function __construct() {
			parent::__construct();
		}
		protected function doCreateObject(array $array) {
			$object = new Image();
			$object->loadFromArray($array);
			return $object;
		}
		
		
		
		protected function doInsert(Content $image) {
			$now = time();
			$query = "INSERT INTO images "
					."(slug, title, datecreated, datemodified, albumid, filename, status, prospective, current, staff) "
					."VALUES "
					."('{$image->getSlug()}','{$image->getTitle()}','$now','$now','{$image->getAlbumId()}','{$image->getFileName()}','{$image->getStatus()}','{$image->getProspective()}','{$image->getCurrent()}','{$image->getStaff()}')";
			self::$mysqli->query($query);
			$image->setId(self::$mysqli->insert_id);		
		}
		
		public function update(Content $image) {
			$now = time();
			$query = "UPDATE images SET "
					."slug='{$image->getSlug()}', "
					."title='{$image->getTitle()}', "
					."datecreated='{$image->getDateCreated()}', "
					."datemodified='$now', "
					."albumid='{$image->getAlbumId()}', "
					."filename='{$image->getFileName()}', "
					."status='{$image->getStatus()}', "
					."prospective='{$image->getProspective()}', "
					."current='{$image->getCurrent()}', "
					."staff='{$image->getStaff()}' "
					."WHERE id={$image->getId()}";
			self::$mysqli->query($query);
		}


		
		public function delete(Content $image) {
			$query = "DELECT FROM images WHERE id={$image->getId()} LIMIT 1";
			self::$mysqli->query($query);
		}

		public function findImagesInAlbum(Album $album) {
			return $this->findByAlbumId($album->getId());
		}

		public function findByAlbumId($albumid) {
			return $this->createCollection($this->queryToArray($this->selectByAlbumIdQuery($albumid), true));
		}

		public function selectBySlugQuery( $slug ) {
			return "SELECT * FROM images WHERE slug='{$slug}' LIMIT 1";
		}

		public function selectByAlbumIdQuery($albumid) {
			return "SELECT * FROM images WHERE albumid='$albumid'";
		}
		
		public function selectQuery( $id ) {
			return "SELECT * FROM images WHERE id=$id";
		}
		
		public function selectAllQuery() {
			return "SELECT * FROM images";
		}
		
		protected function targetClass() {
			return 'Image';
		}
	}
