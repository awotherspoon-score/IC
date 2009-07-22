<?php
	/**
	 * An accesss point for AJAX Calls To The Backend
	 *
	 * This file acts as the bridge between ajax and our command classes
	 * Unfortunately this was my first time putting together an ajax heavy
	 * admin panel, so this interface isn't partcularly clean.
	 *
	 * The code here simply accepts AJAX calls via POST, translates the values
	 * into objects if required, runs a command based on whats specified in $_POST['action']
	 * and then sends an object back in JSON if it's relevant to the command (rare).
	 */
        include '../../init.php';
	
	//convert json objects to php objects, currently only supports one object
	if (array_key_exists('obj', $_POST)) {

		$class = $_POST['type'];
		$_POST['type'] = ( isset($_POST['newseventtype']) ) ? $_POST['newseventtype'] : $_POST['type'];

                //to get around the javascript 'status' reserved word
                $_POST['status'] = isset($_POST['stat']) ? $_POST['stat'] : Content::STATUS_PENDING;

                if (isset($_POST['id'])) {
                  $mapper = RequestRegistry::getMapper($class);
                  $object = $mapper->find($_POST['id']);
                } else {
                  $object = new $class();
                }

                $object->loadFromArray($_POST);
		$_POST[$class] = $object; 
	}
	
	$context = CommandRunner::run($_POST['action'], $_POST);
        $return = $context->getParamArray();

        foreach ($return as $key => $value) {
                if ($value instanceof Content) {
                        $return[$key] = $value->toArray();
                }
        }

        echo json_encode($return);
