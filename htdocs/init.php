<?php
$docroot = $_SERVER['DOCUMENT_ROOT'];
function __autoload($class) {
        if (strpos($class, 'Command') !== false) {
                  include $docroot . '/php/command/' . strtolower($class) . '.php';
                  return;
        }
	include $docroot . '/php/' . strtolower($class) . '.php';
}
