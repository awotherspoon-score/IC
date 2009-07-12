<?php
        include('../init.php');
	$formHelper = RequestRegistry::getFormHelper();	
	$albums = RequestRegistry::getAlbumMapper()->findAll();

	$_REQUEST['album-id'] = ( isset( $_GET['album-id'] ) ) ? $_GET['album-id'] : 1;

        $context = CommandRunner::run('get-album' );
	$thisAlbum = $context->get('album');
	$editNewsHref = ( $thisAlbum->getNewsId() == 0 ) ? '#' : "/admin/list-news.php?newsevent-id={$thisAlbum->getNewsId()}";
	$editEventHref = ( $thisAlbum->getEventId() == 0 ) ? '#' : "/admin/list-events.php?newsevent-id={$thisAlbum->getEventId()}";
	$images = $thisAlbum->getImages();

?>
<?php include('../inc/doctype.php'); ?>
<html>
        <head>
                <title>Immanuel College Admin Panel</title>
                <link rel='stylesheet' type='text/css' href='css/style.css' />
                <script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
                <script type='text/javascript' src='js/generic-functions.js'></script>
                <script type='text/javascript' src='js/font/cufon-yui.js'></script>
                <script type='text/javascript' src='js/font/Sanuk-Black_500.font.js'></script>
                <script type='text/javascript' src='js/font/Sanuk-Regular_500.font.js'></script>
                <script type="text/javascript">
                        Cufon.replace('h1', { fontFamily: 'Sanuk-Black'});
                        Cufon.replace('li.page-nav-link>a', { fontFamily: 'Sanuk-Black'});
                        Cufon.replace('li.nav-link>a', { fontFamily: 'Sanuk-Black'});
                        Cufon.replace('div#home-show-links a', { fontFamily: 'Sanuk-Black'});
                      
			var album_id = <?= $thisAlbum->getId() ?>;
                </script>
                <script type='text/javascript' src='js/gallery-functions.js'></script>
        </head>
        <body>
                <div id='wrapper'>
			<?php include('inc/header.php'); ?>

                    <div id='main'>
                            <div id='col-1'>
			    	<ul>
					<?php foreach ( $albums as $album ): ?>
					<li><a href='/admin/gallery.php?album-id=<?= $album->getId()  ?>'><?= $album->getTitle() ?></a></li>
					<?php endforeach ?>
				</ul>
                            </div>
                            <div id='col-2'>
			    	<form id='gallery-form'>
					<fieldset>
					<legend>Gallery Info</legend>
					 <label for='title'>Title:</label>
					 <input value='<?= $thisAlbum->getTitle() ?>' name='title' id='title' type='text' class='text-input' />
					</fieldset>
					 <fieldset>

					 <legend>Associated News/Events</legend>
					 <div id='associated-news-inputs' class='associated-inputs'>
					
					 <span>Select Associated News (optional): </span><br />
					<?= $formHelper->getNewsSelect( $thisAlbum->getNewsId() ) ?>
					<a id='edit-associated-news' href='<?= $editNewsHref ?>'>Edit Selected News</a>
					<br /><span> Or:</span><br />
					 <input type='submit' name='new-news' id='new-news' value='Create New News Story' />
					 </div>

					 <span>Select Associated Event (optional): </span>
					 <div id='associated-event-inputs' class='associated-inputs'>
					 <?= $formHelper->getEventsSelect( $thisAlbum->getEventId() ) ?>
					 <a href='<?= $editEventHref ?>' id='edit-associated-event'>Edit Selected Event</a>
					<br /><span> Or:</span><br />
					 <input type='submit' name='new-event' id='new-event' value='Create New Event' />
					 </div>

					</fieldset>

					<fieldset>
						<legend>Images</legend>
						<table id='images-table'>
							<thead>
								<th></th>
								<th>Caption</th>
								<th>Thumbnail</th>
								<th>Prospective</th>
								<th>Current</th>
								<th>Staff</th>
								<th>FeatureImage</th>
							</thead>
							<tbody>
								<?php foreach ( $images as $image ) : ?>
								<?php 
									$prospective_checked = ($image->getProspective() == 1) ? ' checked' : '';
									$current_checked = ($image->getCurrent() == 1) ? ' checked' : '';
									$staff_checked = ($image->getStaff() == 1) ? ' checked' : '';
								?>
								<tr id='<?= $image->getId() ?>'>
								<td class='image-select-checkbox-cell'>
									<input type='checkbox'></input></td>
									<td class='image-caption-cell'>
									<span class='caption'><?= $image->getTitle() ?></span>
									<br /><br />

									<input type='submit' class='edit-caption-button' value='Edit' /> </td> 

								<td class='image-thumbnail-cell'>
								<img height='100' src='<?= $image->getSource() ?>' /></td>

								<td class='image-pcs-checkbox-cell prospective-cell'>
								<input class='prospective' type='checkbox'<?= $prospective_checked ?>></input></td>
								<td class='image-pcs-checkbox-cell current-cell'>
									<input class='current' type='checkbox'<?= $current_checked ?>></input></td>
								<td class='image-pcs-checkbox-cell staff-cell'>
									<input class='staff' type='checkbox'<?= $staff_checked ?>></input></td>

								<td class='image-featured-select-radio-cell'>
									<input type='radio'></input></td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>	
					</fieldset>
				</form>
                            </div>
                    </div><!-- /#main -->

                </div><!-- /#wrapper -->
                <script type='text/javascript'>
                        Cufon.now();
                </script> 
        </body>
</html>
