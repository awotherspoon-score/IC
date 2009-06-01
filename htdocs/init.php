<?php

function __autoload($class) {
	include 'php/' . strtolower($class) . '.php';
}
