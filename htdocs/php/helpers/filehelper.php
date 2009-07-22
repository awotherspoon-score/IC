<?php
	
	class FileHelper {
		
		function is_jpg( $filename ) {
			return ( preg_match( '/\.jp[e]?g$/', $filename ) == 1 );
		}

		function is_zip( $filename ) {
			return ( preg_match( '/\.zip$/', $filename ) == 1 );
		}
	}

	//cheap and cheerful unit tests for this class, uncomment and run
	// $ php filehelper.php
	//from the command line to use them

	/*
	test_is_jpg();
	test_is_zip();

	function test_is_jpg() {
		$fh = new FileHelper();
		$test_is_jpg = true;
		if ( $fh->is_jpg( 'jpeg-schmeypeg' ) ) { $test_is_jpg = false; }
		if ( $fh->is_jpg( 'hello.zip' ) ) { $test_is_jpg = false; }
		if ( $fh->is_jpg( 'asdf.asd.jpeg.fie.alkje' ) ) { $test_is_jpg = false; }
		if ( $fh->is_jpg( 'bla.jpg.rgle.blip' ) ) { $test_is_jpg = false; }
		if ( ! $fh->is_jpg( 'a.jpg' ) ) { $test_is_jpg = false; }
		if ( ! $fh->is_jpg( 'a_long.dotted.jpeg.name.jpg' ) ) { $test_is_jpg = false;}
		if ( ! $fh->is_jpg( 'again_with_underscores_and_an_e.jpeg' ) ) { $test_is_jpg = false;}
		if ( ! $fh->is_jpg( '12.jpeg' ) ) { $test_is_jpg = false; }
		if ( ! $fh->is_jpg( '2.jpg' ) ) { $test_is_jpg = false; }
		if ( ! $test_is_jpg ) { echo "FileHelper::is_jpg test failed\n"; }
	}

	function test_is_zip() {
		$fh = new FileHelper();
		$test_is_zip = true;

		if ( $fh->is_zip( 'clearly not a zip file' ) ) { $test_is_zip = false; }
		if ( $fh->is_zip( 'onetwothree..zip.jpg' ) ) { $test_is_zip = false; }
		if ( $fh->is_zip( 'abcdefg.lkj.iio' ) ) { $test_is_zip = false; }
		if ( ! $fh->is_zip( 'hello.jpg.zip' ) ) { $test_is_zip = false; }
		if ( ! $fh->is_zip( 'images.zip' ) ) { $test_is_zip = false; }
		if ( ! $fh->is_zip( 'monkeys-reading-newspapers-on-a-bench.zip' ) ) {
			$test_is_zip = false; }
		if ( ! $fh->is_zip( 'alsdfojcfjlkas.zip' ) ) { $test_is_zip = false; }
		if ( ! $test_is_zip ) { echo "FileHelper::is_zip test failed\n"; }
	}
	*/
