<?php
	class Image extends Content {
		private $albumId;
		private $fileName;
		private $prospective;
		private $current;
		private $staff;
		
		public function loadFromArray(array $array) {
			parent::loadFromArray($array);
			$this->setAlbumId($array['albumid']);
			$this->setFileName($array['filename']);
			$this->setProspective($array['prospective']);
			$this->setCurrent($array['current']);
			$this->setStaff($array['staff']);
		}

                public function toArray() {
                        return array_merge(parent::toArray(), array(
                                'albumId' = $this->albumId;
                                'filename' => $this->filename,
                                'prospective' => $this->prospective,
                                'current' => $this->current,
                                'staff' => $this->staff 
                        ));
                }
		
		//GETTERS + SETTERS
		public function getAlbumId() {
			return $this->albumId;
		}
		public function getFileName() {
			return $this->fileName;
		}
		public function isProspective() {
			return $this->prospective;
		}
		public function isCurrent() {
			return $this->current;
		}
		public function isStaff() {
			return $this->staff;
		}
		public function setAlbumId($albumId) {
			$this->albumId = $albumId;
		} 
		public function setFileName($fileName) {
			$this->fileName = $fileName;
		}
		public function setProspective($prospective) {
			$this->prospective = $this->getBoolean($prospective);
		}
		
		public function setCurrent($current) {
			$this->current = $this->getBoolean($current);
		}
		
		public function setStaff($staff) {
			$this->staff = $this->getBoolean($staff);
		}
		
		private function getBoolean($arg) {
			if ($arg == 0) {
				return false;
			}
			return true;
		}
	}
