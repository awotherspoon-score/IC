<?php
/**
 * Main Autoload Function
 *
 * Loads in all classes files as  php/classnameinlowercase.php
 * If the class has the word 'command' in the name, loads it from php/command/classnameinlower case.php
 * Using an autoload function ensures we only include exactly the files we need at runtime
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
	} else {
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


