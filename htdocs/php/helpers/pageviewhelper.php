<?php
	/**
	 * View Helper for Page Content
	 */
	class PageViewHelper extends ViewHelper {

		/**
		 * Generates breadcrumbs for a given page object
		 *
		 * Displays breadcrumbs as Home | Top Level Page Link | Second Level Page Link | Bottom Level Page Link
		 * At the appropriate depth with current page link having a 'thispage' class
		 */
		public function breadcrumbs() {
			$page = $this->content;
			$ancestry = $page->getAncestry();

			$breadcrumb =  "<div id='breadcrumb'>\n";
			$breadcrumb .= "<a href='#'>Home</a> | ";

			foreach ($ancestry as $ancestor) {
				if ( $ancestor === $this->content ) {
					$breadcrumb .= "<a class='thispage' href='{$this->url($ancestor)}'>"
					              ."{$ancestor->getTitle()}"
						      ."</a>\n";
				} else {
					$breadcrumb .= "<a href='{$this->url($ancestor)}'>{$ancestor->getTitle()}</a> | ";
				}
			}

			$breadcrumb .="</div>\n";

			return $breadcrumb;
		}

		/**
		 * Generates sidebar for a given page object
		 *
		 * Displays child level pages in a list, if there are any, else nothing
		 * TODO Add Approrpiate Image as per funcspec
		 * TODO Consider showing sibling pages instead of child
		 */
		public function sidebar() {
			$children = $this->content->getLiveChildren();

			if ( ($image = $this->content->getImage()) == null ) {
				$image_mapper = RequestRegistry::getImageMapper();
				$pcs_code = SessionRegistry::getStyleCode();
				$image = $image_mapper->findRandomLiveImageForPcs( $pcs_code );
			}


			$sidebar = 	"<div id='sidebar'>\n";
			if ( count( $children ) > 0 ) {
				$sidebar	.="<div class='sidebar-links-title'>\n"
						."<p>{$this->content->getTitle()}</p>\n"
						."</div>\n"	
						."<ul class='sidebar-links-list'>\n";

				foreach ($children as $child) {
					$sidebar .= "<li><a href='{$this->url($child)}'>{$child->getTitle()}</a></li>";
				}

				$sidebar	.="</ul>\n";
			}
			if ($image != null) {
				$sidebar 	.="<img src='{$image->getSource()}' id='post-image' />\n";
			}
			$sidebar 	.="</div>\n";
			return $sidebar;
		}
	}
