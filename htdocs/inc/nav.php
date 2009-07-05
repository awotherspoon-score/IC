<?php
	$page_mapper = RequestRegistry::getPageMapper();

	$the_school = $page_mapper->find(1);
	$the_school_children = $the_school->getLiveChildren();

	$joining_us = $page_mapper->find(2);
	$joining_us_children = $joining_us->getLiveChildren();

	$way_of_life = $page_mapper->find(3);
	$way_of_life_children = $way_of_life->getLiveChildren();
	$urlHelper = RequestRegistry::getUrlHelper();
?>

              <div id='top-nav'>
                        <ul id='top-nav-list'>
                                <li id='the-school-link' class='page-nav-link'><a href='<?= $urlHelper->url($the_school) ?>'>The School</a>
                                        <ul>
						<?php foreach ( $the_school_children as $child): ?>
                                                <li><a href='<?= $urlHelper->url($child); ?>'><?= $child->getTitle() ?></a></li>
						<?php endforeach ?>
                                        </ul>
                                </li>
                                <li id='joining-us-link' class='page-nav-link'><a href='<?= $urlHelper->url($joining_us) ?>'>Joining Us</a>
                                        <ul>
						<?php foreach ( $joining_us_children as $child): ?>
                                                <li><a href='<?= $urlHelper->url($child) ?>'><?= $child->getTitle() ?></a></li>
						<?php endforeach ?>
                                        </ul>
                                </li>
                                <li id='way-of-life-link' class='page-nav-link'><a href='<?= $urlHelper->url($way_of_life) ?>'>Way of Life</a>
                                        <ul>
						<?php foreach ( $way_of_life_children as $child): ?>
                                                <li><a href='<?= $urlHelper->url($child) ?>'><?= $child->getTitle() ?></a></li>
						<?php endforeach ?>
                                        </ul>
                                </li>
                                <li id='news-link' class='nav-link'><a href='#'>News</a>
                                        <ul></ul> <!-- force hover state -->
                                </li>
                                <li id='events-link' class='nav-link'><a href='#'>Events</a>
                                        <ul></ul>
                                </li>
                                <li id='gallery-link' class='nav-link'><a href='#'>Gallery</a>
                                        <ul></ul>
                                </li>
                                <li id='contact-us-link' class='nav-link'><a href='#'>Contact Us</a>
                                        <ul></ul>
                                </li>
                        </ul>
                </div><!-- /top-nav -->
