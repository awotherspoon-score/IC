<?php
	/**
	 * Creates, Retrieves, Updates and Deletes from/to the album table
	 *
	 * Converts table rows to Album objects and Album objects to table rows
	 */
	class AlbumMapper extends ContentMapper {
		function __construct() {
			parent::__construct();
		}
		
		protected function doCreateObject(array $array) {
			$object = new Album();
			$object->loadFromArray($array);
			return $object;
		}
		
		
		
		protected function doInsert(Content $content) {
			$now = time();
			$query = "INSERT INTO albums "
					."(slug, title, datecreated, datemodified, status, datedisplayed, newsid, eventid, featuredimageid) "
					."VALUES "
					."('{$content->getSlug()}','{$content->getTitle()}','$now','$now','{$content->getStatus()}','{$content->getDateDisplayed()}','{$content->getNewsId()}','{$content->getEventId()}','{$content->getFeaturedImageId()}')";
			self::$mysqli->query($query);
			$content->setId(self::$mysqli->insert_id);		
		}
		
		public function update(Content $content) {
			$now = time();
			$this->updateSlug( $content );
			$query = "UPDATE albums SET "
					."slug='{$content->getSlug()}', "
					."title='{$content->getTitle()}', "
					."datecreated='{$content->getDateCreated()}', "
					."datemodified='$now', "
					."status='{$content->getStatus()}', "
					."datedisplayed='{$content->getDateDisplayed()}', "
					."newsid='{$content->getNewsId()}', "
					."eventid='{$content->getEventId()}', "
					."featuredimageid='{$content->getFeaturedImageId()}' "
					."WHERE id={$content->getId()}";
			self::$mysqli->query($query);
		}
		
		public function delete(Content $content) {
			$query = "DELETE FROM albums WHERE id={$content->getId()} LIMIT 1";
			self::$mysqli->query($query);
		}

		public function findAllAlbumsForIndex() {
			return $this->createCollection( $this->queryToArray( $this->selectAllAlbumsForIndexQuery(), true ) );
		}

    public function findAllLiveAlbumsForMonth( $month, $year = null ) {
      return $this->createCollection( $this->queryToArray( $this->selectAllLiveAlbumsForMonthQuery( $month, $year ), true ) );
    }



    public function findAllLiveAlbumsForYear( $year = null ) {
      return $this->createCollection( $this->queryToArray( $this->selectAllLiveAlbumsForYearQuery( $year ), true ) );
    }

    public function findFiveMostRecentLiveAlbums() {
      return $this->createCollection( $this->queryToArray( $this->selectFiveMostRecentLiveAlbumsQuery(), true ) );
    }

    public function selectFiveMostRecentLiveAlbumsQuery() {
      return "SELECT * FROM albums WHERE status=" . Content::STATUS_LIVE . " ORDER BY datedisplayed DESC LIMIT 5";
    }

    public function selectAllLiveAlbumsForYearQuery( $year = null ) {
      $year = ( $year === null ) ? date( 'Y' ) : $year;
      $start = mktime( 0, 0, 0, 1, 1, $year );
      $end = mktime( 0, 0, 0, 1, 0, $year + 1 );

      return "SELECT * FROM albums WHERE status=". Content::STATUS_LIVE
            ." AND datedisplayed BETWEEN $start AND $end"
            ." ORDER BY datedisplayed DESC";
    }

    public function selectAllLiveAlbumsForMonthQuery( $month, $year = null ) {
			$year = ($year === null ) ? date('Y') : $year;
			$start = mktime( 0,0,0, $month, 1, $year );
			$end = mktime( 0,0,0, $month + 1, 0, $year );

      return "SELECT * FROM albums WHERE status=". Content::STATUS_LIVE
            ." AND datedisplayed BETWEEN $start AND $end"
            ." ORDER BY datedisplayed DESC";
    }

    /**
     * Returns collection of all live albums for a given time period
     *
     * $period can be a 4-digit year or a lower case month name
     *
     * @param $period mixed the time period to return albums for
     */
    public function findAllLiveAlbumsForPeriod( $period ) {
      return $this->createCollection( $this->queryToArray( $this->selectLiveAlbumsForPeriodQuery( $period ), true ) );
    }

    public function albumsExistForPeriod( $period ) {
      $albums = $this->findAllLiveAlbumsForPeriod( $period );

      return ( count( $albums ) > 0 );
    }

    public function selectLiveAlbumsForPeriodQuery( $period ) {
      //echo $period;
      $dh = new DateHelper();
      $month_array = $dh->month_array();
      if ( array_key_exists( $period, $month_array ) ) {
        //period is a month e.g. 'january' | 'february' etc
        $month = $month_array[$period];
        $year = ( $month > date('n') ) ? date('Y') - 1 : date('Y');
        
        $start = mktime( 0, 0, 0, $month, 1, $year );
        $end = mktime( 0, 0, 0, $month + 1, 0, $year );
      } else {
        //period is a year e.g. '2009' | '1964'
        $start = mktime( 0, 0, 0, 1, 1, $period); 
        $end = mktime( 0,0,0, 1, 0, $period + 1);
      }


      return "SELECT * FROM albums WHERE status="  . Content::STATUS_LIVE
            ." AND datedisplayed BETWEEN {$start} AND {$end}"
            ." ORDER BY datedisplayed DESC";

    }


		public function selectAllAlbumsForIndexQuery() {
			return "SELECT * FROM albums WHERE status=" . Content::STATUS_LIVE . " ORDER BY datedisplayed DESC LIMIT 6";
		}

		public function selectBySlugQuery($slug) {
			return "SELECT * FROM albums WHERE slug='{$slug}' LIMIT 1";
		}
		
		public function selectQuery( $id ) {
			return "SELECT * FROM albums WHERE id=$id LIMIT 1";
		}
		
		public function selectAllQuery() {
			return "SELECT * FROM albums";
		}
		
		public function targetClass() {
			return 'Album';
		}
		
	}
