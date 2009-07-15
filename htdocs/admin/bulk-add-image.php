<?php
        include('../init.php');
	include('pclzip.lib.php');

	$album = CommandRunner::run('get-album')->get('album');

	/**
	 * Uploade images from a zip file
	 *
	 * This happens in a few stages:
	 *
	 * 1. We create a temporary directory in which to work with out zip file/images
	 * 2. We move the .zip file into the temporary directory and extract it.
	 * 3. We insert a row into the image database and use the id of the row as a filename
	 * for the image
	 * 4. We move the image to the calculated filename {id}.jpg in the img/photos/
	 * directory
	 */
	if ( isset( $_POST['submit'] ) ) {
		$photos_dir = getcwd() . '/../img/photos/';
		echo $photos_dir;
		$file_helper = new FileHelper();
		$temp_image_dir_path = getcwd() . '/temp-image-directory';

		//create our temporary directory
		//we'll use this to extract our images before we move them to the photos
		//directory
		mkdir( $temp_image_dir_path );

		$temp_name = $_FILES['uploaded-file']['tmp_name'];	

		/*
		if ( ! $file_helper->is_zip( $temp_name ) ) {
			throw new Exception( 'Not A .zip file' );
		}
		*/

		$zip_file_name = $temp_image_dir_path . '/images.zip';
		$success = move_uploaded_file( $temp_name, $zip_file_name );

		if ( ! $success ) {
			throw new Exception( 'Upload Failed' );
			//die miserably
		}

		$zipper = new PclZip( $zip_file_name );
		$zipper->extract( $temp_image_dir_path);

		$temp_image_dir_resource = opendir( $temp_image_dir_path );
		while ( ( $image_file_name = readdir( $temp_image_dir_resource ) ) !== false ) {
			
			if ( ! $file_helper->is_jpg( $image_file_name ) ) {
				continue;
			}

			$source = $temp_image_dir_path . '/' . $image_file_name;

			$image_mapper = RequestRegistry::getImageMapper();
			$image = new Image();
			$image->setAlbumId($album->getId());
			$image_mapper->insert( $image );

			$target = $photos_dir . $image->getId() . '.jpg';
			$image->setFilename( $image->getId(). '.jpg' );
			$image_mapper->update($image);
			rename( $source, $target );
		}

		//delte our temporary directory
		unlink( $zip_file_name );
		rmdir( $temp_image_dir_path );
	}
	
	/*
	if ( isset( $_POST['submit'] ) ) {
		$image_mapper = RequestRegistry::getImageMapper();
		$image = new Image();
		$image->setAlbumId($_POST['album-id']);
		$image_mapper->insert( $image );

		$filename = $image->getId() . '.jpg';
		//$target_path = '../img/photos/' . $filename; //*nix Mode

		$target_path = "..\img\photos\\" . $filename;  //Windows Mode

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
	*/
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
			    <h2>Upload Image To Gallery '<?php //echo $album->getTitle() ?>'</h2>
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
