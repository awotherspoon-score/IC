<?php
	class ContentWatcher {
		private $all = array();
		
		function globalKey(Content $object) {
			$key = get_class($object) . "." . $object->getId();
			return $key;
		}
		
		function add( Content $object ) {
			$this->all[$this->globalKey($object)] = $object;
		}
		
		function exists($classname, $id) {
			$key = "$classname.$id";
			if (isset($this->all[$key])) {
				return $this->all[$key];
			}
			return null;
		}
		
	}