<?php
	class Image extends Content {
		const BASE = '/img/photos/';
		private $albumId;
		private $fileName;
		private $prospective;
		private $current;
		private $staff;
		
		public function loadFromArray(array $array) {
			parent::loadFromArray($array);
			if (array_key_exists('albumid', $array)) { $this->setAlbumId($array['albumid']); }
			if (array_key_exists('filename', $array)) { $this->setFileName($array['filename']); }
			if (array_key_exists('prospective', $array)) { $this->setProspective($array['prospective']); }
			if (array_key_exists('current', $array)) { $this->setCurrent($array['current']); }
			if (array_key_exists('staff', $array)) { $this->setStaff($array['staff']); }
		}

                public function toArray() {
                        return array_merge(parent::toArray(), array(
                                'albumId' => $this->albumId,
                                'filename' => $this->filename,
                                'prospective' => $this->prospective,
                                'current' => $this->current,
                                'staff' => $this->staff 
                        ));
                }

		public function getSource() {
			return Image::BASE . $this->getFilename();
		}

		//GETTERS + SETTERS
		public function getAlbumId() {
			return $this->albumId;
		}
		public function getFileName() {
			return $this->fileName;
		}
		public function getProspective() {
                        if ($this->prospective == '') {
                                $this->prospective = "0";
                        }
			return $this->prospective;
		}
		public function getCurrent() {
                        if ($this->current == '') {
                                $this->current = "0";
                        }
			return $this->current;
		}
		public function getStaff() {
                        if ($this->staff == '') {
                                $this->staff = "0";
                        }
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
