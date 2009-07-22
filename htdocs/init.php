<?php
/**
 * Main Autoload Function
 */
function __autoload($class) {
        $docroot = $_SERVER['DOCUMENT_ROOT'] . '/';
	$filename = $docroot . 'php/';

        if (strpos($class, 'Command') !== false) {
		  //get commands from the 'commands/' directory
		  $filename .= 'command/' . strtolower($class) . '.php';
        } elseif (strpos($class, 'Helper') !== false) {
		  //get helpers from the 'helpers/' directory
		  $filename .= 'helpers/' . strtolower($class) . '.php';
	} elseif (strpos($class, 'Collection') !== false) {
		  //get collections from the 'collections/' directory
		  $filename .= 'collections/' . strtolower($class) . '.php';
	} elseif (strpos($class, 'Mapper') !== false){
		  //get mappers from the 'mappers/' direcotry
		  $filename .= 'mappers/' . strtolower($class) . '.php';
	}else {
		  $filename .= strtolower($class) . '.php';
	}


	//try to load the file
	if ( file_exists( $filename ) ) {
		include $filename;
	} else {
		throw new Exception( "<h2>Class File For $class Not Found, Tried to Find it at $filename</h2>" );
	}
	return;
}
/**
 * Tells RequestRegistry where to look for the websites config file
 */
define('CONFIG_FILENAME', $_SERVER['DOCUMENT_ROOT'] . '/../config.ini');


