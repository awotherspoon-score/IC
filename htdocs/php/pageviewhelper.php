<?php
	class PageViewHelper extends ViewHelper {
		public function breadcrumb() {
			$page = $this->content;
			$ancestry = page->getAncestry();

			$breadcrumb =  "<div id='breadcrumb'>\n";
			$breadcrumb .= "<a href='/'>Home</a> |";

			foreach ($ancestry as $ancestor) {
				$breadcrumb .= "<a href='/pages/{$ancestor->getSlug()}/'>{$ancestor->getTitle()}</a> |";
			}

			$breadcrumb .="</div>\n";

			return $breadcrumb;
		}
	}
