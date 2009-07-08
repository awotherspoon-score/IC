<?php
	abstract class ViewHelper {
		/**
		 * The content that this helper will help display
		 */
		protected $content;

		/**
		 * Generates URLs
		 */
		protected $urlHelper;

		/**
		 * Constructor
		 *
		 * @param $object Content sets helpers content object to passed in content object
		 */
		public function __construct(Content $object) {
			$this->content = $object;
			$this->urlHelper = RequestRegistry::getUrlHelper();
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

		public function url($content = null) {
			$content = ($content == null ) ? $this->content : $content;
			return $this->urlHelper->url($content);
		}
	
		/**
	 	 * Generate breadcrumb for our content object
	   	 */	 
		abstract function breadcrumbs();
		abstract function sidebar();
	}
