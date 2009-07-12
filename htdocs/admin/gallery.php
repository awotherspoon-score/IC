<?php
        include('../init.php');
	$formHelper = RequestRegistry::getFormHelper();	
	$albums = RequestRegistry::getAlbumMapper()->findAll();

        $context = CommandRunner::run('get-album', array('album-id' => 1));
	$thisAlbum = $context->get('album');
	$images = $thisAlbum->getImages();

?>
<?php include('../inc/doctype.php'); ?>
<html>
        <head>
                <title>Immanuel College Admin Panel</title>
                <link rel='stylesheet' type='text/css' href='css/style.css' />
                <script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
                <script type='text/javascript' src='js/generic-functions.js'></script>
                <script type='text/javascript' src='js/gallery-functions.js'></script>
                <script type='text/javascript' src='js/font/cufon-yui.js'></script>
                <script type='text/javascript' src='js/font/Sanuk-Black_500.font.js'></script>
                <script type='text/javascript' src='js/font/Sanuk-Regular_500.font.js'></script>
                <script type="text/javascript">
                        Cufon.replace('h1', { fontFamily: 'Sanuk-Black'});
                        Cufon.replace('li.page-nav-link>a', { fontFamily: 'Sanuk-Black'});
                        Cufon.replace('li.nav-link>a', { fontFamily: 'Sanuk-Black'});
                        Cufon.replace('div#home-show-links a', { fontFamily: 'Sanuk-Black'});
                      
                        $(document).ready(function() {
                                init_header();
                        });
                </script>
        </head>
        <body>
                <div id='wrapper'>
			<?php include('inc/header.php'); ?>

                    <div id='main'>
                            <div id='col-1'>
			    	<ul>
					<?php foreach ( $albums as $album ): ?>
						<li><?= $album->getTitle() ?></li>
					<?php endforeach ?>
				</ul>
                            </div>
                            <div id='col-2'>
			    	<form id='gallery-form'>
					<fieldset>
					<legend>Gallery Info</legend>
						<label for='title'>Title:</label>
						<input name='title' id='title' type='text' class='text-input' />
						<label for='display-date'>Display Date:</label>
						<?= $formHelper->getGenericDateInput() ?>
					</fieldset>
					 <fieldset>

					 <legend>News/Event Associations</legend>
					 <div id='associated-news-inputs' class='associated-inputs'>
					 <select name='news'>
					 </select>
					 <input type='submit' name='new-news' id='new-news' value='Create New News Story' />
					 <a href='edit-associated-news' href='#'>Edit Associated News</a>
					 </div>

					 <div id='associated-event-inputs' class='associated-inputs'>
					 <select name='events'>
					 </select>
					 <input type='submit' name='new-event' id='new-event' value='Create New Event' />
					 <a href='#' id='edit-associated-event'>Edit Associated Event</a>
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
								<tr>
								<td class='image-select-checkbox-cell'>
									<input type='checkbox'></input></td>
								<td class='image-caption-cell'>Caption</td>

								<td class='image-thumbnail-cell'>
									<img height='100' src='<?= $image->getSource() ?>' /></td>
								<td class='image-pcs-checkbox-cell'>
									<input type='checkbox'></input></td>
								<td class='image-pcs-checkbox-cell'>
									<input type='checkbox'></input></td>
								<td class='image-pcs-checkbox-cell'>
									<input type='checkbox'></input></td>
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
