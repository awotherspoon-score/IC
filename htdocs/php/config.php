<?php
	/* Provides Access To Site Config Data
	 * 
	 * Reads config file in .ini format and provides access to stored info.
	 * Uses __call to provide access to info with dynamically generated getter method
	 */
	class Config {
		private $values = array(); //holds our config data
		
		/**
		 * Config Constructor
		 * 
		 * Initializes data from an ini file
		 * 
		 * @param $filename - string, the .ini file to read from
		 * @return Config
		 */
		function __construct($filename) {
			$this->values = parse_ini_file($filename , true);
		}
		
		/**
		 * Handles get(Section)(Key) methods
		 * 
		 * On calls for 'get*' methods, looks for
		 *
		 */
		private function __call($method, $args) {
			//defines getSectionKeyforvalue() methods
			if (strpos($method, 'get') == 0) { //it's a get* method
				//parse the method name
				$keyString = substr($method, 3);
				$keyArray = $this->explodeCase($keyString);
				
				if (array_key_exists($keyArray[0], $this->values) && array_key_exists($keyArray[1], $this->values[$keyArray[0]])) {
					//we've got the value requested in our $values array, so return the value
					return $this->values[$keyArray[0]][$keyArray[1]];	
				} else {
					die("tried to get '{$keyArray[1]}' in section '{$keyArray[0]}' using Config. No such value I'm afraid!");   
				}
				
			}
				
		}
		
		/**
		 * Splits up a string into an array similar to the explode() function but according to CamelCase.
		 * Uppercase characters are treated as the separator but returned as part of the respective array elements.
		 * @author Charl van Niekerk <charlvn@charlvn.za.net>
		 * @param string $string The original string
		 * @param bool $lower Should the uppercase characters be converted to lowercase in the resulting array?
		 * @return array The given string split up into an array according to the case of the individual characters.
		 */
		private function explodeCase($string, $lower = true)
		{
		  // Split up the string into an array according to the uppercase characters
		  $array = preg_split('/([A-Z][^A-Z]*)/', $string, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
		  
		  // Convert all the array elements to lowercase if desired
		  if ($lower) {
		    $array = array_map('strtolower', $array);
		  }
		  
		  // Return the resulting array
		  return $array;
		}
	}
