<?php
	class PageViewHelper extends ViewHelper {

		public function breadcrumbs() {
			$page = $this->content;
			$ancestry = $page->getAncestry();

			$breadcrumb =  "<div id='breadcrumb'>\n";
			$breadcrumb .= "<a href='/'>Home</a> | ";

			foreach ($ancestry as $ancestor) {
				if ( $ancestor === $this->content ) {
					$breadcrumb .= "<a class='thispage' href='{$this->url($ancestor)}'>"
					              ."{$ancestor->getTitle()}"
						      ."</a>\n";
				} else {
					$breadcrumb .= "<a href='{$this->url()}'>{$ancestor->getTitle()}</a> | ";
				}
			}

			$breadcrumb .="</div>\n";

			return $breadcrumb;
		}

		public function sidebar() {
			$children = $this->content->getLiveChildren();
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
			$sidebar 	.="<img src='/img/post-image.jpg' id='post-image' />\n"
				  	."</div>\n";
			return $sidebar;
		}
	}
