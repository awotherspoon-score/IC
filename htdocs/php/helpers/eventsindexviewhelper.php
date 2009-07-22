<?php
	class EventsIndexViewHelper extends ViewHelper {
		function breadcrumbs() {
			return '';
		}
		function sidebar() {
			$helper = new EventViewHelper( $this->content );
			return $helper->sidebar();
		}
	}
