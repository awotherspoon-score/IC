<?php
	$pageMapper = RequestRegistry::getPageMapper();
	$urlHelper = RequestRegistry::getUrlHelper();
	$theSchool = $pageMapper->find(1);
	$joiningUs = $pageMapper->find(2);
	$wayOfLife = $pageMapper->find(3);
	$theSchoolChildren = $theSchool->getLiveChildren();
	$joiningUsChildren = $joiningUs->getLiveChildren();
	$wayOfLifeChildren = $wayOfLife->getLiveChildren();
	
?>
	<div id='footer'>
		<div id='footer-col-123'>
		
			<div id='footer-col-12'>
			
				<div class='footer-column' id='footer-col-1'>
                                        <h4><?= $theSchool->getTitle() ?></h4>
                                        <ul>
						<?php foreach( $theSchoolChildren as $child ): ?>
							<li>
							<a href='<?= $urlHelper->url($child) ?>'><?= $child->getTitle() ?></a>
							</li>
						<?php endforeach ?>
                                        </ul>
				</div><!-- /footer-col-1 -->
				
				<div class='footer-column' id='footer-col-2'>
                                        <h4><?= $joiningUs->getTitle() ?></h4>
                                        <ul>
						<?php foreach( $joiningUsChildren as $child ): ?>
							<li>
							<a href='<?= $urlHelper->url($child) ?>'><?= $child->getTitle() ?></a>
							</li>
						<?php endforeach ?>
                                        </ul>
				</div><!-- /footer-col2 -->
				
			</div><!-- /footer-col-12 -->
			
			<div class='footer-column' id='footer-col-3'>
                                <h4><?= $wayOfLife->getTitle() ?></h4>
                                <ul>
					<?php foreach( $wayOfLifeChildren as $child ): ?>
						<li>
						<a href='<?= $urlHelper->url($child) ?>'><?= $child->getTitle() ?></a>
						</li>
					<?php endforeach ?>
                                </ul>

			</div><!-- /footer-col-3 -->
			
		</div><!-- /footer-col-123 -->
		
		<div class='footer-column' id='footer-col-4'>
                        <ul>
                                <li><a href='#'>News</a></li>
                                <li><a href='#'>Events</a></li>
                                <li><a href='#'>Gallery</a></li>
                                <li><a href='#'>Contact Us</a></li>
                        </ul>
		</div><!-- /footer-col-4 -->
	</div><!-- /footer -->
