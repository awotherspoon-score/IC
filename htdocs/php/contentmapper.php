<?php 
	abstract class ContentMapper {
		protected static $mysqli;
		
		function __construct() {
			if (! isset(self::$mysqli)) {
				self::$mysqli = RequestRegistry::getMySQLi();
			}
		}
		
		function find( $id ) {
			$old = $this->getFromMap($id);
			if ($old != null) {return $old;}
			return $this->createObject( $this->queryToArray($this->selectQuery($id)) );
		}

                function findBySlug( $slug ) {
			$old = $this->getFromMap($slug);
			if ($old != null) {return $old;}
                        return $this->createObject( $this->queryToArray($this->selectBySlugQuery($slug)));
                }
		
		function findAll() {
			return $this->createCollection( $this->queryToArray($this->selectAllQuery()));
		}
		
		function createObject( $array ) {
			if ($array === null) { return null; }
			$old = $this->getFromMap($array['id']);
			if ($old != null) { return $old; }
			$object = $this->doCreateObject( $array );
			return $object;
		}
		
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
		
		private function getFromMap($id) {
			return RequestRegistry::getContentWatcher()->exists($this->targetClass(), $id);
		}
		
		private function addToMap(Content $content) {
			RequestRegistry::getContentWatcher()->add($content);
		}
		
		function insert(Content $insert) {
			$this->doInsert($insert);
			$this->addToMap($insert);
		}

                /**
                 * Double checks a pages slug after a potential title change
                 *
                 * If the title hasn't changed then return. Else generate a new slug
                 * This requires requires n runs to the database, where n is the number of duplicate slugs
                 * TODO: Optimize this so we need at most one trip to the database
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
		
		abstract function update( Content $object );
		protected abstract function doCreateObject( array $array );
		protected abstract function doInsert( Content $object );
		protected abstract function selectQuery( $id );
                protected abstract function selectBySlugQuery($slug);
		protected abstract function selectAllQuery();
		protected abstract function targetClass();
	}
