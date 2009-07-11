<?php
	class DateHelper {
		private $month_array;

		private function init_month_array() {
                          $array = array(); 
                          $array[1] = 'january';
                          $array[2] = 'february';
                          $array[3] = 'march';
                          $array[4] = 'april';
                          $array[5] = 'may';
                          $array[6] = 'june';
                          $array[7] = 'july';
                          $array[8] = 'august';
                          $array[9] = 'september';
                          $array[10] = 'ocobter';
                          $array[11] = 'november';
                          $array[12] = 'december';

			  //WATCH OUT!!! We flip this array!!!
			  $this->month_array = array_flip( $array );
		}

		public function month_array() {
			if ( ! isset( $this->month_array ) {
				$this->init_month_array();
			}
			return $this->month_array;
		}
	}
