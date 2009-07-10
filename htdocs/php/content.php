<?php
	abstract class Content {
                
                const STATUS_PENDING = 0;
                const STATUS_LIVE = 1;
		private $id;
		private $slug;
		private $title;
		private $dateCreated;
		private $dateModified;
		private $status;
		
		public function loadFromArray(array $array) {
			if (array_key_exists('id', $array)) { $this->setId($array['id']); }
			if (array_key_exists('slug', $array)) { $this->setSlug($array['slug']); }
			if (array_key_exists('title', $array)) { $this->setTitle($array['title']); }
			if (array_key_exists('datecreated', $array)) { $this->setDateCreated($array['datecreated']); }
			if (array_key_exists('datemodified', $array)) { $this->setDateModified($array['datemodified']); }
			if (array_key_exists('status', $array)) { $this->setStatus($array['status']); }
		}

                public function toArray() {
                        return array(
                             'id' => $this->id,
                             'slug' => $this->slug,
                             'title' => stripslashes( $this->title ),
                             'dateCreated' => $this->dateCreated,
                             'dateModified' => $this->dateModified,
                             'status' => $this->status
                        );
                }
		
		//GETTERS + SETTERS
		public function getId() {
			return $this->id;
		}
		public function getSlug() {
			return $this->slug;
		}
		public function getTitle() {
			return $this->title;
		}
		public function getDateCreated() {
			return $this->dateCreated;
		}
		public function getDateModified() {
			return $this->dateModified;
		}
		public function getStatus() {
			return $this->status;
		}
		public function setId($id) {
			$this->id = $id;
		}
		public function setSlug($slug) {
			$this->slug = $slug;
		} 
		public function setTitle($title) {
			$this->title = $title;
		}
		public function setDateCreated($dateCreated) {
			$this->dateCreated = $dateCreated;
		}
		public function setDateModified($dateModified) {
			$this->dateModified = $dateModified;
		}
		public function setStatus($status) {
			$this->status = $status;
		}
	}
