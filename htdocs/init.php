<?php

/**
 * Main Autoload Function
 *
 * Loads in all classes files as  php/{class name in lower case}.php
 * If the class has the word 'command' in the name, loads it from php/command/{class name in lower case}.php
 * Using an autoload function ensures we only include exactly the files we need at runtime
 */
function __autoload($class) {
        $docroot = $_SERVER['DOCUMENT_ROOT'] . '/';
        if (strpos($class, 'Command') !== false) {
                  include $docroot . 'php/command/' . strtolower($class) . '.php';
                  return;
        }
	include $docroot . 'php/' . strtolower($class) . '.php';
}

/**
 * Tells RequestRegistry where to look for the websites config file
 */
define('CONFIG_FILENAME', $_SERVER['DOCUMENT_ROOT'] . '/../config.ini');


