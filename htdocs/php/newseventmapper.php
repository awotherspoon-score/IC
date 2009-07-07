<?php
	class NewsEventMapper extends ContentMapper {
		function __construct() {
			parent::__construct();
		}
		
		protected function doCreateObject(array $array) {
			$object = new NewsEvent();
			$object->loadFromArray($array);
			return $object;
		}
		
		
		
		protected function doInsert(Content $object) {
			$now = time();
			$query = "INSERT INTO newsevents "
					."(slug, title, introduction, datecreated, datemodified, text, description, keywords, datedisplayed, type) "
					."VALUES "
					."('{$object->getSlug()}','{$object->getTitle()}', '{$object->getIntroduction()}', '$now','$now','{$object->getText()}','{$object->getDescription()}','{$object->getKeywords()}','{$object->getDateDisplayed()}','{$object->getContentType()}')";
			self::$mysqli->query($query);
			$object->setId(self::$mysqli->insert_id);
		}
		
		public function update(Content $object) {
			$now = time();
			$query = "UPDATE newsevents SET "
					."slug='{$object->getSlug()}', "
					."title='{$object->getTitle()}', "
					."datecreated='{$object->getDateCreated()}', "
					."introduction='{$object->getIntroduction()}, "
					."datemodified='$now', "
					."text='{$object->getText()}', "
					."description='{$object->getDescription()}', "
					."keywords='{$object->getKeywords()}', "
					."datedisplayed='{$object->getDateDisplayed()}', "
					."type='{$object->getContentType()}' "
					."WHERE id={$object->getId()} LIMIT 1";
			self::$mysqli->query($query);
		}
		
		public function delete(Content $object) {
			$query = "DELETE FROM newsevents WHERE id={$object->getId()} LIMIT 1";
			self::$mysqli->query($query);
		}
		
		protected function selectQuery( $id ) {
			$id = mysql_escape_string($id);
			return "SELECT * FROM newsevents WHERE id=$id";
		}

		protected function selectAllOfTypeQuery( $type ) {
			$type = mysql_escape_string($type);
			return "SELECT * FROM newsevents WHERE type='$type'";
		}

		private function getOrderForType($type) {
			return ($type == NewsEvent::TYPE_NEWS) ? 'DESC' : 'ASC';
		}

		


		function findTypeForMonth($type, $month = null, $year = null) {
			$month = ($month === null) ? date('n') : $month;
			$year = ($year === null) ? date('Y') : $year;
			$query = $this->selectAllOfTypeForMonthQuery( NewseEvent::TYPE_NEWS, $month, 'DESC', $year);
			return $this->createCollection($this->queryToArray($query, true));
		}

		public function findAllNews() {
			return $this->createCollection($this->queryToArray($this->selectAllNewsQuery(), true));
		}

		protected function selectAllNewsQuery() {
			return 'SELECT * FROM newsevents WHERE type=' . NewsEvent::TYPE_NEWS . ' ORDER BY displaydate DESC';
		}

		protected function selectAllEventsQuery() {
			return 'SELECT * FROM newsevents WHERE type=' . NewsEvent::TYPE_EVENT . ' ORDER BY displaydate ASC';
		}

		protected function selectDisplayEventsQuery() {
			$now = time();
			return 'SELECT * FROM newsevents'
			      .' WHERE type=' . NewsEvent::TYPE_EVENT . ' AND displaydate > ' . $now
		       	      .' ORDER BY displaydate ASC LIMIT 3';
		}

		protected function selectDisplayNewsQuery() {
			$now = time();
			return 	"SELECT * FROM newsevents ".
			       	"WHERE type=" . NewsEvent::TYPE_NEWS . " AND displaydate < $now ".
				"ORDER BY displaydate DESC LIMIT 3";
		}

		protected function selectAllOfTypeForMonthQuery( $type, $month, $order, $year = null ) {
			if ($year === null) {
				$year = date('Y');
			}

			$start = mktime( 0, 0, 0, $month, 1, $year);
			$end = mktime( 0, 0, 0, $month + 1, 0, $year);

			return selectAllOfTypeBetweenQuery( $type, $start, $end, $order )
		}

		protected function selectAllOfTypeForYearQuery( $type, $year, $order ) {
			$start = mktime( 0, 0, 0, 1, 1, $year );	
			$end = mktime( 0, 0, 0, 12, 31, $year);
			return selectAllOfTypeBetweenQuery( $type, $start, $end, $order);
		}

		protected function selectAllOfTypeBetweenQuery( $type, $start, $end, $order) {
			return "SELECT * FROM newsevents WHERE type=$type AND displaydate BETWEEN $start AND $end ORDER BY displaydate $order";	
		}
		
		protected function selectAllQuery() {
			return "SELECT * FROM newsevents";
		}
		
		protected function targetClass() {
			return 'NewsEvent';
		}
		
		
	}
