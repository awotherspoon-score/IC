<?php
	class ImageMapper extends ContentMapper {
		const PHOTOS_DIRECTORY = '/img/photos/';
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
			$filename = self::PHOTOS_DIRECTORY . $image->getFilename();
			if ( file_exists( $filename ) ) {
				unlink( $filename ); //delete the file
			}

			$query = "DELETE FROM images WHERE id={$image->getId()} LIMIT 1";
			self::$mysqli->query($query);
		}

		public function findImagesInAlbum(Album $album) {
			return $this->findByAlbumId($album->getId());
		}

		public function findByAlbumId($albumid) {
			return $this->createCollection($this->queryToArray($this->selectByAlbumIdQuery($albumid), true));
		}

		public function findImageForPage( Page $page ) {
			return $this->find( $page->getImageId() );
		}

		public function findRandomLiveImageForPcs( $pcs_code ) {
			return $this->createObject( $this->queryToArray( $this->selectRandomLiveImageForPcsQuery( $pcs_code ) ) );
		}

		public function selectRandomLiveImageForPcsQuery( $pcs_code ) {
			//we don't use images.status, so need to join on albums to tell if an image should be displayed or not via albums.status
			return "select images.* from albums join images on albums.id=images.albumid where albums.status=1 and {$pcs_code}=1 order by rand() limit 1";
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
