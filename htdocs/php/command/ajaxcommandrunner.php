<?php
        include '../../init.php';


        $context = CommandRunner::run($_POST['action'], $_POST);
        $return = $context->getParamArray();

        foreach ($return as $key => $value) {
                if ($value instanceof Content) {
                        $return[$key] = $value->toArray();
                }
        }

        echo json_encode($return);
