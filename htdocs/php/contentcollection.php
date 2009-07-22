<?php
        /**
         * An iteratable, countable collection superclass
         *
         * Subclasses will be used to group and iterate over domain objects
	 *
	 * By implementing the Standard PHP Library (SPL) interfaces Iterator and Countable
	 * We can do things like foreach($content_collection as $content) and count( $content_collection )
         */
	abstract class ContentCollection implements Iterator, Countable {
		protected $mapper;
		protected $total = 0;
		protected $raw = array();
		
		private $result;
		private $pointer;
		private $objects = array();

                public function toArray() {
                        return $this->raw;
                }
		
		function __construct(array $raw = null, ContentMapper $mapper = null) {
			if ( ! is_null( $raw ) && ! is_null( $mapper ) ) {
				$this->raw = $raw;
				$this->total = count($raw);		
			}
			$this->mapper = $mapper;
		}
		
		function add(Content $object) {
			$class = $this->targetClass();
			if (! ($object instanceof $class)) {
				throw new Exception("This is a {$class} collection");
			}
			$this->notifyAccess();
			$this->objects[$this->total] = $object;
			$this->total++;
		}
		
		abstract function targetClass();
		
		protected function notifyAccess() {
			//left blank for now
		}
		
		private function getRow($num) {
			$this->notifyAccess();
			if ($num >= $this->total || $num < 0) {
				return null;
			}
			if (isset($this->objects[$num])) {
				return $this->objects[$num];
			}
			
			if ( isset($this->raw[$num])) {
				$this->objects[$num] = $this->mapper->createObject($this->raw[$num]);
				return $this->objects[$num];
			}
		}
		
		public function rewind() {
			$this->pointer = 0;
		}
		
		public function current() {
			return $this->getRow($this->pointer);
		}
		
		public function key() {
			return $this->pointer;
		}
		
		public function next() {
			$row = $this->getRow( $this->pointer );
			if ($row) { $this->pointer++; }
			return $row;
		}
		
		public function valid() {
			return ( ! is_null($this->current()) );
		}

                public function count() {
                        return count($this->raw);
                }
	}
