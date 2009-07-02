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
		
		abstract function update( Content $object );
		protected abstract function doCreateObject( array $array );
		protected abstract function doInsert( Content $object );
		protected abstract function selectQuery( $id );
                protected abstract function selectBySlugQuery($slug);
		protected abstract function selectAllQuery();
		protected abstract function targetClass();
	}
