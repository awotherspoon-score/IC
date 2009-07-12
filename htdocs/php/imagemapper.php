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
			//echo $query;
			self::$mysqli->query($query);
			$image->setId(self::$mysqli->insert_id);		
		}
		
		public function update(Content $image) {
			$now = time();
			$query = "UPDATE images SET "
					."slug='{$image->getSlug()}', "
					."title='{$image->getTitle()}', "
					."datemodified='$now', "
					."albumid='{$image->getAlbumId()}', "
					."filename='{$image->getFileName()}', "
					."status='". Content::STATUS_LIVE ."', "
					."prospective='{$image->getProspective()}', "
					."current='{$image->getCurrent()}', "
					."staff='{$image->getStaff()}' "
					."WHERE id={$image->getId()}";
			self::$mysqli->query($query);
		}


		
		public function delete(Content $image) {
			$query = "DELETE FROM images WHERE id={$image->getId()} LIMIT 1";
			//echo $query;
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
			return "SELECT * FROM images WHERE albumid='$albumid' ORDER BY datecreated DESC";
		}
		
		public function selectQuery( $id ) {
			return "SELECT * FROM images WHERE id=$id";
		}
		
		public function selectAllQuery() {
			return "SELECT * FROM images";
		}

		public function findFeaturedImageForAlbum( Album $album ) {
			return $this->createObject( $this->queryToArray( $this->selectFeaturedImageForAlbumQuery( $album ) ) );
		}

		public function selectFeaturedImageForAlbumQuery( Album $album ) {
			return "select images.* from images join albums on images.id=albums.featuredimageid where albums.id={$album->getId()} limit 1";
		}
		
		protected function targetClass() {
			return 'Image';
		}
	}
