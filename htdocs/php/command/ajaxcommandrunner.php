<?php
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
