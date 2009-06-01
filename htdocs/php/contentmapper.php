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
		
		function findAll() {
			return $this->createCollection( $this->queryToArray($this->selectAllQuery()));
		}
		
		function createObject( $array ) {
			$old = $this->getFromMap($array['id']);
			if ($old != null) { return $old; }
			$object = $this->doCreateObject( $array );
			return $object;
		}
		
		function createCollection( $array ) {
			return ContentHelperFactory::getCollection($this->targetClass(), $array, $this);
		}
		
		function queryToArray($query) {
			$result = self::$mysqli->query( $query );
			if ($result->num_rows == 1) {
				return $result->fetch_assoc();
			} elseif ($result->num_rows > 1) {
				$returnArray = array();
				while ($returnArray[] = $result->fetch_assoc()) {/*Load Up Array*/}
				return $returnArray();
			}
			return null;
		}
		
		private function getFromMap($id) {
			return RequestRegistry::getContentWatcher()->exists($this->targetClass(), $id);
		}
		
		private function addToMap(Content $content) {
			RequestRegistry::getContentWatcher()->add($content)
		}
		
		function insert(Content $insert) {
			$this->doInsert($insert);
			$this->addToMap($insert);
		}
		
		abstract function update( Content $object );
		protected abstract function doCreateObject( array $array );
		protected abstract function doInsert( Content $object );
		protected abstract function selectQuery( $id );
		protected abstract function selectAllQuery();
		protected abstract function targetClass();
	}