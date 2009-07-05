<?php
	class PageViewHelper extends ViewHelper {

		public function url($slug = '') {
			$slug = ($slug == '') ? $this->content->getSlug() : $slug;
			return "/pages/{$slug}/";
		}

		public function breadcrumbs() {
			$page = $this->content;
			$ancestry = $page->getAncestry();

			$breadcrumb =  "<div id='breadcrumb'>\n";
			$breadcrumb .= "<a href='/'>Home</a> | ";

			foreach ($ancestry as $ancestor) {
				if ( $ancestor === $this->content ) {
					$breadcrumb .= "<a class='thispage' href='{$this->url($ancestor->getSlug())}'>"
					              ."{$ancestor->getTitle()}"
						      ."</a>\n";
				} else {
					$breadcrumb .= "<a href='{$this->url()}'>{$ancestor->getTitle()}</a> | ";
				}
			}

			$breadcrumb .="</div>\n";

			return $breadcrumb;
		}
	}
