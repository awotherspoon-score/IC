<?php
  /**
   * Creates, Retrieves, UPdates and Deletes from/to the newsevents table
   *
   * Converts table rows to NewsEvent objects and NewsEvent objects to table rows
   */
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
					."(status, slug, title, datecreated, datemodified, text, description, keywords, datedisplayed, type) "
					."VALUES "
					."('{$object->getStatus()}', '{$object->getSlug()}','{$object->getTitle()}', '$now','$now','{$object->getText()}','{$object->getDescription()}','{$object->getKeywords()}','{$object->getDateDisplayed()}','{$object->getContentType()}')";
			//echo $query;
			self::$mysqli->query($query);
			$object->setId(self::$mysqli->insert_id);
		}
		
		public function update( Content $object ) {
			$now = time();
			$this->updateSlug( $object );
			$query = "UPDATE newsevents SET "
					."slug='{$object->getSlug()}', "
					."title='{$object->getTitle()}', "
					."datecreated='{$object->getDateCreated()}', "
					."datemodified='$now', "
					."text='{$object->getText()}', "
					."description='{$object->getDescription()}', "
					."keywords='{$object->getKeywords()}', "
					."datedisplayed='{$object->getDateDisplayed()}', "
					."status='{$object->getStatus()}' "
					."WHERE id={$object->getId()} LIMIT 1";
			//echo $query;
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

		protected function findUpcomingNews() {
		}

		public function findAllNewsForMonth( $month, $year = null ) {
			return $this->createCollection( $this->queryToArray( $this->selectAllNewsForMonthQuery( $month, $year), true ) );
		}

		public function findAllEventsForMonth( $month, $year = null ) {
			return $this->createCollection( $this->queryToArray( $this->selectAllEventsForMonthQuery( $month, $year), true ) );
		}

		public function selectAllNewsForMonthQuery( $month, $year = null ) {
			$year = ($year === null ) ? date('Y') : $year;
			$start = mktime( 0,0,0, $month, 1, $year );
			$end = mktime( 0,0,0, $month + 1, 0, $year );

			return "SELECT * FROM newsevents WHERE type=" . NewsEvent::TYPE_NEWS ." AND datedisplayed BETWEEN $start AND $end ORDER BY datedisplayed DESC";
		}

		public function selectAllEventsForMonthQuery( $month, $year = null ) {
			$year = ($year === null ) ? date('Y') : $year;
			$start = mktime( 0,0,0, $month, 1, $year );
			$end = mktime( 0,0,0, $month + 1, 0, $year );
			return "SELECT * FROM newsevents WHERE type=" . NewsEvent::TYPE_EVENT ." AND datedisplayed BETWEEN $start AND $end ORDER BY datedisplayed DESC";
		}

		public function findRecentlyModifiedNews( $count = 5 ) {
			return $this->createCollection( $this->queryToArray( $this->selectRecentlyModifiedNewsQuery( $count ), true ) );
		}

		public function findRecentlyModifiedEvents( $count = 5 ) {
			return $this->createCollection( $this->queryToArray( $this->selectRecentlyModifiedEventsQuery( $count ), true ) );
		}

		protected function selectRecentlyModifiedNewsQuery( $count ) {
			return "SELECT * FROM newsevents WHERE type=" . NewsEvent::TYPE_NEWS . " ORDER BY datemodified DESC LIMIT {$count}";
		}

		protected function selectRecentlyModifiedEventsQuery( $count ) {
			return "SELECT * FROM newsevents WHERE type=" . NewsEvent::TYPE_EVENT . " ORDER BY datemodified DESC LIMIT {$count}";
		}

		//TODO Delete this method or do something with it
		public function selectAllUpcomingEventsQuery() {
			$start = time();
			$end = mktime( 0, 0, 0, date('n') + 3, 0, date('Y') );
			return "SELECT * FROM newsevents WHERE type=";
		}

		public function findAllRecentNews() {
			//echo $this->selectAllRecentNewsQuery();
			return $this->createCollection($this->queryToArray($this->selectAllRecentNewsQuery(), true));
		}

		public function findAllFutureNews() {
			return $this->createCollection($this->queryToArray($this->selectAllFutureNewsQuery(), true));
		}

		public function findAllFutureEvents() {
			return $this->createCollection($this->queryToArray($this->selectAllFutureEventsQuery(), true));
		}

		public function findAllNewsForYear($year) {
			//echo $this->selectAllNewsForYearQuery($year) . "&nbsp; $year<br />";
			return $this->createCollection($this->queryToArray($this->selectAllNewsForYearQuery($year), true));
		}

		public function findMostRecentNews() {
			return $this->createObject( $this->queryToArray( $this->selectMostRecentNewsQuery() ) );
		}
		public function findMostRecentEvent() {
			return $this->createObject( $this->queryToArray( $this->selectMostRecentEventQuery() ) );
		}

		public function findSoonestEvent() {
			return $this->createObject( $this->queryToArray( $this->selectSoonestEventQuery() ) );
		}

		public function selectSoonestEventQuery() {
			$now = time();
			return "SELECT * FROM newsevents WHERE type=" . NewsEvent::TYPE_EVENT . " AND datedisplayed > $now ORDER BY datedisplayed ASC LIMIT 1";
		}

		public function findEventsForYear( $year ) {
			return $this->createCollection( $this->queryToArray( $this->selectEventsForYearQuery( $year ), true ) );
		}
		public function selectEventsForYearQuery( $year ) {
			$start = mktime( 0, 0, 0, 1, 1, $year );
			$end = mktime( 0, 0, 0, 1, 0, $year + 1);
			return "SELECT * FROM newsevents WHERE type=" . NewsEvent::TYPE_EVENT . " AND datedisplayed BETWEEN $start AND $end ORDER BY datedisplayed DESC";
		}

		public function findAllLiveNewsForMonth($month, $year = null) {
			return $this->createCollection($this->queryToArray($this->selectAllLiveNewsForMonthQuery($month, $year), true));
		}

		/**
		 * Find All news for an archive pages, specified by $period
		 *
		 * Period can be a four digit year or a month name in lower case
		 * The archive for a month returns those for that month from the past 12
		 * e.g. In January 2009, sending this method 'december' in $period would get
		 * the archive for December 2008
		 *
		 * @param $period mixed the time period, 4-digit year or lower case month
		 * @return $news NewsEventCollection the news for the archive over period $period
		 */
		public function findAllNewsForArchive( $period ) {
			return $this->createCollection($this->queryToArray($this->selectAllNewsForArchiveQuery( $period ), 'true'));
		}

		public function selectAllNewsForArchiveQuery( $period ) {

			$boundary = $this->periodToStartEndValues( $period );

			return "SELECT * FROM newsevents "
				."WHERE type=" . NewsEvent::TYPE_NEWS 
				." AND status=" . Content::STATUS_LIVE 
				." AND datedisplayed BETWEEN {$boundary['start']} AND {$boundary['end']} "
				."ORDER BY datedisplayed DESC";
		}

		public function findAllEventsForArchive( $period ) {
			return $this->createCollection($this->queryToArray($this->selectAllEventsForArchiveQuery( $period ), 'true'));
		}

		public function selectAllEventsForArchiveQuery( $period ) {

			$boundary = $this->periodToStartEndValues( $period, 'events' );

			$query =  "SELECT * FROM newsevents "
				."WHERE type=" . NewsEvent::TYPE_EVENT 
				." AND status=" . Content::STATUS_LIVE 
				." AND datedisplayed BETWEEN {$boundary['start']} AND {$boundary['end']} "
				."ORDER BY datedisplayed ASC";
			return $query;
		}

		

		private function periodToStartEndValues( $period, $mode = 'news' ) {
			$boundary['start'] = 0;
			$boundary['end'] = 0;

			$period = strtolower( $period ); //in case some genius sends us a capitalized month

			$date_helper = new DateHelper();
			$month_array = $date_helper->month_array();

			if ( array_key_exists( $period, $month_array ) ) {
				//$period contains a month
				$month = $month_array[$period];
				switch ( $mode ) {
					case 'news':
						$year  = ( $month > date( 'n' ) ) ? date( 'Y' ) - 1 : date( 'Y' );
						break;
					case 'events':
						$year = ( $month < date( 'n' ) ) ? date( 'Y' ) + 1 : date( 'Y' );
						break;
				}
				$start = mktime( 0, 0, 0, $month, 0, $year );
				$end   = mktime( 0, 0, 0, $month + 1, 0, $year );

			} elseif ( preg_match( '/[0-9]{4}/', $period ) !== 0 ) {
				//$period contains a 4-digit year
				$year = $period;
				$start = mktime( 0, 0, 0, 1, 1, $year );
				$end   = mktime( 0, 0, 0, 0, 0, $year + 1 );
			} else {
				//bad $period value
				throw new Exception('Bad $period Value passed: ' . $period);
			}

			$boundary['start'] = $start;
			$boundary['end'] = $end;
			return $boundary;
		}

		public function newsExistsForPeriod( $period ) {
			$news = $this->findAllNewsForArchive( $period );
			return ( count( $news ) > 0 );
		}

		public function eventsExistForPeriod( $period ) {
			$events = $this->findAllEventsForArchive( $period );
			return ( count( $events ) > 0 );
		}

		/**
		 * News Stories For News Index Page
		 *
		 * Returns NewsEventCollection containing news for news index page
		 *
		 * @return $news NewsEventCollection the collection of stories for the index
		 */
		public function findNewsForIndex() {
			return $this->createCollection( $this->queryToArray( $this->selectNewsForIndexQuery(), true ) );
		}

		/**
		 * Returns SQL for News Index Main Content
		 *
		 * Query returns most recent three live news stories, not including future stories
		 *
		 * @return $query string the SQL query returning the news index news pages
		 */
		public function selectNewsForIndexQuery() {
			$now = time();
			return 'SELECT * FROM newsevents WHERE type=' . NewsEvent::TYPE_NEWS . ' AND status=' . Content::STATUS_LIVE . " AND datedisplayed < {$now} ORDER BY datedisplayed DESC LIMIT 3";
		}
		

		public function findEventsForIndex() {
			return $this->createCollection( $this->queryToArray( $this->selectEventsForIndexQuery(), true ) );
		}

		public function selectEventsForIndexQuery() {
			$now = time();
			return 'SELECT * FROM newsevents WHERE type=' . NewsEvent::TYPE_EVENT . ' AND status=' . Content::STATUS_LIVE . " AND datedisplayed > {$now} ORDER BY datedisplayed ASC LIMIT 3";
		}
		
		protected function selectAllLiveNewsForMonthQuery($month, $year = null) {
			//expects 1-12 in $month
			$year = ( $year === null ) ? date('Y') : $year;
			$start = mktime(0,0,0,$month,1,$year);
			$end = mktime(0,0,0,$month + 1, 0, $year); //may need to check this for an off by on error
			return "SELECT * FROM newsevents WHERE type=" . NewsEvent::TYPE_NEWS . " AND status=" . Content::STATUS_LIVE . " AND datedisplayed BETWEEN $start AND $end ORDER BY datedisplayed DESC";
		}

		protected function selectMostRecentNewsQuery() {
			$now = time();
			return "SELECT * FROM newsevents WHERE type=" . NewsEvent::TYPE_NEWS . " AND datedisplayed < $now ORDER BY datedisplayed DESC LIMIT 1";
		}

		protected function selectMostRecentEventQuery() {
			$now = time();
			return "SELECT * FROM newsevents WHERE type=" . NewsEvent::TYPE_EVENT . " AND datedisplayed < $now ORDER BY datedisplayed DESC LIMIT 1";
		}


		protected function selectAllRecentNewsQuery() {
			$type = NewsEvent::TYPE_NEWS;
			$order = $this->getOrderForType($type); 
			$start = mktime(0,0,0,date('n') - 3, 1, date('Y'));
			$end = time();
			return $this->selectAllOfTypeBetweenQuery( $type, $start, $end, $order );
		}

		protected function selectAllFutureEventsQuery() {
			$now = time();
			return "SELECT * FROM newsevents WHERE type=". NewsEvent::TYPE_EVENT ." AND datedisplayed > $now ORDER BY datedisplayed DESC";
		}

		protected function selectAllFutureNewsQuery() {
			$now = time();
			return "SELECT * FROM newsevents WHERE type=". NewsEvent::TYPE_NEWS ." AND datedisplayed > $now ORDER BY datedisplayed DESC";
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
			$end = mktime( 0, 0, 0, 1, 0, $year + 1);
			return $this->selectAllOfTypeBetweenQuery( $type, $start, $end, $order);
		}

		public function findAllEventsByModifyDate() {
			return $this->createCollection( $this->queryToArray( $this->selectAllEventsByModifyDate(), true ) );
		}

		protected function selectAllEventsByModifyDate() {
			return "SELECT * FROM newsevents WHERE type=" . NewsEvent::TYPE_EVENT . " ORDER BY datemodified DESC";
		}

		public function findAllNewsByModifyDate() {
			return $this->createCollection( $this->queryToArray( $this->selectAllNewsByModifyDateQuery(), true ) );
		}

		protected function selectAllNewsByModifyDateQuery() {
			return "SELECT * FROM newsevents WHERE type=" . NewsEvent::TYPE_NEWS . " ORDER BY datemodified DESC";
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
