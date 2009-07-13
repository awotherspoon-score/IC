<?php
	/**
	 * Content Superclass
	 *
	 * Superclass for all content classes
	 */
	abstract class Content {
                
		/**
		 * Status Constants, change these if you want to completely break the site
		 */
                const STATUS_PENDING = 0;
                const STATUS_LIVE = 1;


		/**
		 * Fields
		 *
		 * These fields are common accross all type of content on the site
		 */

		
		private $id; 			//id in the database
		private $slug; 			//A url friendly slug, based on the title
		private $title; 		//content title (or caption for images)
		private $dateCreated; 		//unix timestamp of date the content item was created
		private $dateModified; 		//unix timestamp of when the content item was last edited
		private $status; 		//Either STATUS_PENDING or STATUS_LIVE
		
		/**
		 * Loads member fields in an array
		 *
		 * Useful when being created from a database array. This method is usually called
		 * in subclass loadFromArray() calls
		 *
		 * @param $array assoc the array to load values from
		 */
		public function loadFromArray(array $array) {
			if (array_key_exists('id', $array)) { $this->setId($array['id']); }
			if (array_key_exists('slug', $array)) { $this->setSlug($array['slug']); }
			if (array_key_exists('title', $array)) { $this->setTitle($array['title']); }
			if (array_key_exists('datecreated', $array)) { $this->setDateCreated($array['datecreated']); }
			if (array_key_exists('datemodified', $array)) { $this->setDateModified($array['datemodified']); }
			if (array_key_exists('status', $array)) { $this->setStatus($array['status']); }
		}

		/**
		 * Returns an array from the objects field values
		 *
		 * Useful when we neeed to send objects as json as a response to an ajax request
		 * Again, child classes will define this method too, and call it from their implementations
		 */
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
                        if ( $this->status == "" ) {
				//to avoid putting empty strings in the database
                                $this->status = "0";
                        }
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
