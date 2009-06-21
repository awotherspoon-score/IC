<?php
        include '../../init.php';
	
	//convert json objects to php objects, currently only supports one object
	if (array_key_exists('object', $_POST)) {
		$array = $_POST['object']; 	
		$class = $array['class'];
		$mapper = RequestRegistry::getMapper($class);
		$object = $mapper->find($array['id']);
		$object->loadFromArray($array);
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
