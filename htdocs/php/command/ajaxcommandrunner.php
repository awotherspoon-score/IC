<?php
        include '../../init.php';
	
	//convert json objects to php objects, currently only supports one object
	if (array_key_exists('object', $_POST)) {

		$class = $_POST['class'];
		$mapper = RequestRegistry::getMapper($class);
		$object = $mapper->find($_POST['id']);
		$object->loadFromArray($_POST);
		$_POST[$class] = $object; 
		print_r($_POST);
	}
	
	$context = CommandRunner::run($_POST['action'], $_POST);
        $return = $context->getParamArray();

        foreach ($return as $key => $value) {
                if ($value instanceof Content) {
                        $return[$key] = $value->toArray();
                }
        }

        echo json_encode($return);
