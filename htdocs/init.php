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
        if (strpos($class, 'Command') !== false) {
		  $filename = $docroot . 'php/command/' . strtolower($class) . '.php';
        } else {
		  $filename = $docroot . 'php/' . strtolower($class) . '.php';
	}

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


