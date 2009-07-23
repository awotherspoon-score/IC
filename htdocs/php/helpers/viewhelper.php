<?php
	/**
	 * Helps the template pages display content
	 *
	 * Displays bits of content like sidebars, breadcrumbs and urls based on input content
	 */
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
		 * PCS Stylesheet
		 *
		 * We keep this in a property so that we can get it and start the session on
		 * instatntiation
		 */
		protected $pcs_stylesheet;
		 

		/**
		 * Constructor
		 *
		 * @param $object mixed sets helpers content object to passed in content object
		 */
		public function __construct( $object ) {
			$this->content = $object;
			$this->urlHelper = RequestRegistry::getUrlHelper();
			$this->init_pcs_stylesheet();
		}

		public function search_box() {
			return "
			<div id='search-box'>
				<form action='/search/' method='post'>
					<input type='text' name='query' id='search-key' value='Search' />
					<input type='submit' name='search' value='' id='search-button' />
				</form>
			</div>";
		}

		public function quick_links() {
			return "
			<div id='quick-links'>
				<select name='quick-links'>
					<option>Quick Links</option>
				</select>
			</div>";
		}

		/**
		 * content getter/setter method
		 *
		 * @param $content Content (optional) if passed, sets the helpers content object to parameter
		 * @return $this->content Content this classes content object
		 */
		public function content( $content = null ) {
			if ($content instanceof Content && $content != null) {
				$this->content = $content;
			}
			return $this->content;
		}

		/**
		 * Convenience method for using a urlhelper object
		 *
		 * Allows view helpers to pass themselves and other content objects/arrays
		 * into a url helper to get the generated url
		 *
		 * @param $content mixed the content/array object we're using to generate a
		 * url
		 */
		public function url( $content = null ) {
			$content = ($content == null ) ? $this->content : $content;
			return $this->urlHelper->url($content);
		}

		/**
		 * Get a header image
		 *
		 * Gets a header image based on the current stylecode
		 * and/or whatever random image rules we might define later
		 * TODO: Finish this method based on multiple images
		 */
		public function header_image() {
			return "<img id='header-image' alt='We nourish our pupils with an
			engaging focus on Jewish Tradition' src='/img/header-prospective.jpg'
			/>";
		}

		/**
		 * Gets a testimonial image
		 *
		 * Gets a testimonial image based on current stylecode
		 * and/or whatever random image rules we might define later
		 * TODO: Finish this method based on multiple images
		 */
		public function testimonial_image() {
			return "<img alt='Testimonial' src='/img/testimonial-prospective.jpg'
			class='testimonial-image' id='prospective-testimonial-image' />";
		}

		public function pcs_select() {
			$code = $this->get_pcs_stylecode();
			$p_class = ($code == 'prospective') ? " class='selected'" : '';
			$c_class = ($code == 'current') ? " class='selected'" : '';
			$s_class = ($code == 'staff') ? " class='selected'" : '';
			return "
			<div id='section-select'>
				<ul>
					<li id='prospective-link'{$p_class}>
						<a href='/prospective/'>
							<img title='Prospective Students' src='/img/buttons/prospective-button.gif' />
						</a>
					</li>
					<li id='current-link'{$c_class}>
						<a href='/current/'>
							<img title='Current Students' src='/img/buttons/current-button.gif' />
						</a>
					</li>
					<li id='staff-link'{$s_class}>
						<a href='/staff/'>
							 <img title='Staff' src='/img/buttons/staff-button.gif' />
						</a>
					</li>
				</ul>
			</div>
			";
		}



		/**
		 * Sets which stylesheet we use to decide colour scheme
		 *
		 * accepts 'prospective' | 'current' | 'staff' | 'default'
		 *
		 * @param $type string the section we're setting the stylesheet to
		 */
		public function set_pcs_stylecode( $code ) {
		  if ( ! in_array( $code, array( 'prospective', 'current', 'staff', 'default' ) ) ) {
				$this->set_pcs_stylecode( 'default' );
				return;
			} 
		
			SessionRegistry::instance()->setStyleCode( $code );
			$this->init_pcs_stylesheet();
		}

		public function get_pcs_stylecode() {
			return SessionRegistry::instance()->getStyleCode();
		}


		public function pcs_stylesheet() {
			return $this->pcs_stylesheet;
		}

		public function init_pcs_stylesheet() {
			$code = SessionRegistry::instance()->getStyleCode();
			if ( in_array( $code, array( 'prospective', 'current', 'staff') ) ) {
				$this->pcs_stylesheet =  "<link rel='stylesheet' type='text/css'
				href='/css/{$code}.css' />\n";
			} else {
				$this->pcs_stylesheet = '';
			}

		}
	
		/**
	 	 * Delegate breadcrumb generation for our content object
	   	 */	 
		abstract function breadcrumbs();
		/**
	 	 * Delegate sidebar generation for our content object
		 */
		abstract function sidebar();
	}
