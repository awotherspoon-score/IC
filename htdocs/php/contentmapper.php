<?php 
	/**
	 * Content Mapper Superclass
	 *
	 * Mappers are use to manage the relationship between content objects and the datbase
	 * This class defines functionality common accross all content mapper classes
	 */
	abstract class ContentMapper {

		/**
		 * Instance of mysqli used for database manipulation
		 */
		protected static $mysqli;
		
		/**
		 * Constructor
		 *
		 * Gets an instance of mysqli from the request registry
		 */
		function __construct() {
			if (! isset(self::$mysqli)) {
				self::$mysqli = RequestRegistry::getMySQLi();
			}
		}
		
		/**
		 * Finds a content object based on its id
		 *
		 * Looks for it in the object watcher, if not found fetches it from the database
		 */
		function find( $id ) {
			$old = $this->getFromMap($id);
			if ($old != null) {return $old;}
			return $this->createObject( $this->queryToArray($this->selectQuery($id)) );
		}

		/**
		 * Finds a content object based on its slug
		 *
		 * Looks for it in the object watcher, if not found fetches it from the database
		 */
                function findBySlug( $slug ) {
			$old = $this->getFromMap($slug);
			if ($old != null) {return $old;}
                        return $this->createObject( $this->queryToArray($this->selectBySlugQuery($slug)));
                }
		
		/**
		 * Returns a collection of objects based on all rows of a table
		 */
		function findAll() {
			return $this->createCollection( $this->queryToArray($this->selectAllQuery()));
		}
		
		/**
		 * Creates a content object based on an array, usually from the database
		 *
		 * Looks for it in the object watcher before it tries to create it
		 * Delegates table-specific work to the mapper subclass via 'doCreateObject'
		 *
		 * @param $array assoc the array to get values from when creating the object
		 */
		function createObject( $array ) {
			if ($array === null) { return null; }
			$old = $this->getFromMap($array['id']);
			if ($old != null) { return $old; }
			$object = $this->doCreateObject( $array );
			return $object;
		}
		
		/**
		 * Creates a content collection based on a 2D array of table rows
		 *
		 * @param $array array the 2D array of table rows to build a collection from
		 */
		function createCollection( $array ) {
			return ContentHelperFactory::getCollection($this->targetClass(), $array, $this);
		}
	
                /**
                 * Runs a query and returns an array
                 *
                 * Returns an associative array when fetching single records
                 * Multidemensional array if fetching more than one record
                 *
                 * @param $query String The query to be executed
                 * @param $forceArray boolean (optional) if set to true, returns a 
                 * multi-dimensional array even if there's only one record to fetch, defaults to false
                 * @return mixed assoc
                 */
		function queryToArray($query, $forceArray = false) {
			$result = self::$mysqli->query( $query );

			if ($result->num_rows == 1) {
                                if ($forceArray) {
                                        $returnArray = array();
                                        $returnArray[] = $result->fetch_assoc();
                                        return $returnArray;
                                }
				return $result->fetch_assoc();

			} elseif ($result->num_rows > 1) {
				$returnArray = array();
				while ($item = $result->fetch_assoc()) {
                                      /*Load Up Array*/
                                      if ($item === null) continue;
                                      $returnArray[] = $item;     
                                }
				return $returnArray;
			}
			return null;
		}
		
		/**
		 * Gets an object from the object watcher
		 *
		 * The object watcher serves as a per-request 'object cache'
		 *
		 * @param $id in the id of the object we're looking for
		 */
		private function getFromMap($id) {
			return RequestRegistry::getContentWatcher()->exists($this->targetClass(), $id);
		}
		
		/**
		 * Adds an object to the object watcher
		 *
		 * @param $content Content the object to add to the cache
		 */
		private function addToMap(Content $content) {
			RequestRegistry::getContentWatcher()->add($content);
		}
		
		/**
		 * Inserts a record into the database
		 *
		 * Adds the content object to the database as a new row, and then adds it to the object cache
		 * Delegates actual work of inserting a row to the mapper subclasses via doInsert
		 *
		 * @param $insert Content the content object to insert
		 */
		function insert(Content $insert) {
			$this->doInsert($insert);
			$this->addToMap($insert);
		}

                /**
                 * Double checks a content slug after a potential title change
                 *
                 * If the title hasn't changed then return. Else generate a new slug
                 * This requires requires n runs to the database, where n is the number of duplicate slugs
                 * TODO: Optimize this so we need at most one trip to the database, hint: use LIKE '$newSlug%;
                 *
                 * @param $page Page the page object who's slug we need to update
                 */
		protected function updateSlug($page) {
			$oldSlug = $page->getSlug();
			$newSlug = $this->generateSlug($page->getTitle());
			if ($oldSlug == $newSlug) { return; }

			$suffix = '';
			while ($this->findBySlug($newSlug . $suffix) !== null) {
				if ($suffix == '') { $suffix = 1; }
				$suffix++;
			}
			$page->setSlug($newSlug . $suffix);
		}

                /**
                 * Generate a slug based on a given input string
                 *
                 * Generates a url friendly slug for a given string
                 *
                 * @param $string string the title string to convert into a slug
                 * @return $slug string a url friendly slug based on $string
                 */
		protected function generateSlug($string) {
			$slug = strtolower( $string ); // lower-case the string
			$slug = preg_replace( '/[^a-z0-9- ]/', '', $slug ); // remove all non-alphanumeric characters except for spaces and hyphens
			$slug = str_replace(' - ', ' ', $slug); //remove all 'real' hyphens with spaces
			$slug = str_replace( ' ', '-', $slug ); // substitute the spaces with hyphens
			return $slug;
		}
		
		/**
		 * Delegates updating to mapper subclasses
		 *
		 * @param $object Content the object representing the row to update in the database
		 */
		abstract function update( Content $object );

		/**
		 * Delegates Object Creation to mapper subclasses
		 *
		 * See ContentMapper::createObject()
		 *
		 * @param $array assoc the array containing data used to build the object
		 */
		protected abstract function doCreateObject( array $array );

		/**
		 * Delegates object insertion to mapper subclasses
		 *
		 * @param $object the object to insert
		 */
		protected abstract function doInsert( Content $object );

		/**
		 * Return SQL query for finding row with id=$id
		 *
		 * See ContentMapper::find()
		 *
		 * @param $id int the id of the row we're looking for
		 */
		protected abstract function selectQuery( $id );

		/**
		 * Return SQL query for finding a row with slug=$slug
		 *
		 * See ContentMapper::findBySlug()
		 *
		 * @param $slug string the slug of the row we're looking for
		 */
                protected abstract function selectBySlugQuery($slug);

		/**
		 * Return SQL query for returning all rows
		 */
		protected abstract function selectAllQuery();

		/**
		 * Returns name of content object class that this mapper works with
		 *
		 * e.g. PageMapper would return 'Page'
		 */
		protected abstract function targetClass();
	}
