<?php
	abstract class ViewHelper {
		/**
		 * The content that this helper will help display
		 */
		protected $content;

		/**
		 * Constructor
		 *
		 * @param $object Content sets helpers content object to passed in content object
		 */
		public function __construct(Content $object) {
			$this->content = $object;
		}

		/**
		 * content getter/setter method
		 *
		 * @param $content Content (optional) if passed, sets the helpers content object to parameter
		 * @return $this->content Content this classes content object
		 */
		public function content($content = null) {
			if ($content instanceof Content && $content != null) {
				$this->content = $content;
			}
			return $this->content;
		}
	
		/**
	 	 * Generate breadcrumb for our content object
	   	 */	 
		abstract function breadcrumbs();
	}
