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
			$this->setId($array['id']);
			$this->setSlug($array['slug']);
			$this->setTitle($array['title']);
			$this->setDateCreated($array['datecreated']);
			$this->setDateModified($array['datemodified']);
			$this->setStatus($array['status']);
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
