<?php
	class ContentWatcher {
		private $all = array();
		
		function globalKey(Content $object) {
			$key = get_class($object) . "." . $object->getId();
			return $key;
		}

		function slugKey(Content $object) {
			$slug_key = get_class($object) . "." . $object->getSlug();
			return $slug_key;
		}
		
		function add( Content $object ) {
			$this->all[$this->globalKey($object)] = $object;
			$this->all[$this->slugKey($object)] = $object;
		}
		
		/**
		 * Returns object based on an id or slug, null if we don't have the object
		 *
		 * @param $classname string name of the class the required object is an instance of
		 * @param $id string id or slug of the object we're looking for
		 */
		function exists($classname, $id) {
			$key = $classname.$id;
			if (isset($this->all[$key])) {
				return $this->all[$key];
			}
			return null;
		}
		
	}
