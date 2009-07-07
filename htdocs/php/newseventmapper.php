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
			return 'SELECT * FROM newsevents WHERE type=' . NewsEvent::TYPE_NEWS . ' ORDER BY datedisplayed DESC';
		}

		protected function selectAllEventsQuery() {
			return 'SELECT * FROM newsevents WHERE type=' . NewsEvent::TYPE_EVENT . ' ORDER BY datedisplayed ASC';
		}

		findAllRecentNews() {
			return $this->createCollection($this->queryToArray($this->selectAllRecentNewsQuery(), true));
		}

		findAllFutureNews() {
			return $this->createCollection($this->queryToArray($this->selectAllFutureNewsQuery(), true));
		}

		findAllNewsForYear($year) {
			return $this->createCollection($this->queryToArray($this->selectAllNewsForYearQuery($year), true));
		}

		protected function selectAllRecentNewsQuery() {
			$type = NewsEvent::TYPE_NEWS;
			$order = $this->getOrderForType($type); 
			$start = mktime(0,0,0,date('n') - 3, 1, date('Y'));
			$end = time();
			return selectAllOfTypeBetweenQuery( $type, $start, $end, $order );
		}

		protected function selectAllFutureNewsQuery() {
			$now = time();
			return "SELECT * FROM newsevents WHERE datedisplayed > $now ORDER BY datedisplayed DESC";
		}

		protected function selectDisplayEventsQuery() {
			$now = time();
			return 'SELECT * FROM newsevents'
			      .' WHERE type=' . NewsEvent::TYPE_EVENT . ' AND datedisplayed > ' . $now
		       	      .' ORDER BY datedisplayed ASC LIMIT 3';
		}

		protected function selectDisplayNewsQuery() {
			$now = time();
			return 	"SELECT * FROM newsevents ".
			       	"WHERE type=" . NewsEvent::TYPE_NEWS . " AND datedisplayed < $now ".
				"ORDER BY datedisplayed DESC LIMIT 3";
		}

		protected function selectAllOfTypeForMonthQuery( $type, $month, $order, $year = null ) {
			if ($year === null) {
				$year = date('Y');
			}

			$start = mktime( 0, 0, 0, $month, 1, $year);
			$end = mktime( 0, 0, 0, $month + 1, 0, $year);

			return selectAllOfTypeBetweenQuery( $type, $start, $end, $order );
		}

		protected function selectAllNewsForYearQuery($year = null) {
			$year = ($year === null) ? date('Y') : $year;	
			$type = NewsEvent::TYPE_NEWS;
			$order = $this->getOrderForType($type);	
			return $this->selectAllOfTypeForYearQuery( $type, $year, $order );
		}

		protected function selectAllOfTypeForYearQuery( $type, $year, $order ) {
			$start = mktime( 0, 0, 0, 1, 1, $year );	
			$end = mktime( 0, 0, 0, 12, 31, $year);
			return selectAllOfTypeBetweenQuery( $type, $start, $end, $order);
		}

		protected function selectAllOfTypeBetweenQuery( $type, $start, $end, $order) {
			return "SELECT * FROM newsevents WHERE type=$type AND datedisplayed BETWEEN $start AND $end ORDER BY datedisplayed $order";	
		}
		
		protected function selectAllQuery() {
			return "SELECT * FROM newsevents";
		}

		public function selectBySlugQuery( $slug ) {
			return "SELECT * FROM newsevents WHERE slug='$slug'";
		}
		
		protected function targetClass() {
			return 'NewsEvent';
		}
	}
