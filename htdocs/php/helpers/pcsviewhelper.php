<?php
	class PcsViewHelper extends ViewHelper {
		function sidebar() {
			$sidebar = '';
			$page_mapper = RequestRegistry::getPageMapper();
			$suggested_links = $page_mapper->findSuggestedLinksForPage( $this->content->getId() );
			if ( count( $suggested_links ) == 0 ) { return ''; }

			$sidebar = "<div id='sidebar'>\n";
			$sidebar	.="<div class='sidebar-links-title'>\n"
					."<p>Suggested Links</p>\n"
					."</div>\n"	
					."<ul class='sidebar-links-list'>\n";
			foreach ( $suggested_links as $link ) {
				$sidebar .= "<li><a href='{$link['href']}'>{$link['anchor_text']}</a></li>";
			}
			$sidebar .= "</ul>\n</div>\n";

			return $sidebar;
		}
		
		function breadcrumbs() {
			return '';
		}
	}
