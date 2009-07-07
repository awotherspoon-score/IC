<?php
function __autoload($class) {
        $docroot = $_SERVER['DOCUMENT_ROOT'] . '/';
        if (strpos($class, 'Command') !== false) {
                  include $docroot . 'php/command/' . strtolower($class) . '.php';
                  return;
        }
	include $docroot . 'php/' . strtolower($class) . '.php';
}

function vh($var) {
	$string = var_export($var, true);
	$string = str_replace("\n", "<br />", $string);
	echo $string;
}

define('CONFIG_FILENAME', $_SERVER['DOCUMENT_ROOT'] . '/../config.ini');


