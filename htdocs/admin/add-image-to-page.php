<?php
        include('../init.php');
	$album = CommandRunner::run('get-album')->get('album');

	if ( isset( $_POST['submit'] ) ) {
		$image_mapper = RequestRegistry::getImageMapper();
		$image = new Image();
		$image->setAlbumId($_POST['album-id']);
		$image_mapper->insert( $image );

		$filename = $image->getId() . '.jpg';
		$target_path = '../img/photos/' . $filename; //*nix Mode

		//$target_path = "..\img\photos\\" . $filename;  //Windows Mode

                //var_dump($_FILES);
                //echo $target_path;
		$success = move_uploaded_file( $_FILES['uploaded-file']['tmp_name'], $target_path );
		if ( $success ) {
			$image->setFileName( $filename );
			$image_mapper->update( $image );
			header( 'Location: /admin/gallery.php?album-id=' . $_POST['album-id'] );
		} else {
			$error_message = "There was a problem with the upload, please try again.";
			$image_mapper->delete( $image );
		}
	}
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
                            </div>
                            <div id='col-2'>
			    <h2>Upload Image To Gallery '<?= $album->getTitle() ?>'</h2>
				<?= ( isset( $error_message ) ) ? '<p>' . $error_message . '</p>' : '' ?>
				<form enctype='multipart/form-data' action='<?= $_SERVER['PHP_SELF'] ?>' method='post'>
				<input type="hidden" name="album-id" value="<?= $_REQUEST['album-id']?>" />
				Choose an image to upload: <input type='file' name='uploaded-file' /><br />
				<input type='submit' name='submit' value='Upload Image' />
				</form>
                            </div>
                    </div><!-- /#main -->

                </div><!-- /#wrapper -->
                <script type='text/javascript'>
                        Cufon.now();
                </script> 
        </body>
</html>
