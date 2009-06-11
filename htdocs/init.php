<?php
function __autoload($class) {
        if (strpos($class, 'Command') !== false) {
                  include 'php/command/' . strtolower($class) . '.php';
                  return;
        }
	include 'php/' . strtolower($class) . '.php';
}
