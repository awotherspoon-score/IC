<?php
function __autoload($class) {
        $docroot = $_SERVER['DOCUMENT_ROOT'] . '/ic/htdocs/';
        if (strpos($class, 'Command') !== false) {
                  include $docroot . 'php/command/' . strtolower($class) . '.php';
                  return;
        }
	include $docroot . 'php/' . strtolower($class) . '.php';
}

define('CONFIG_FILENAME', $_SERVER['DOCUMENT_ROOT'] . '/ic/config.ini');


