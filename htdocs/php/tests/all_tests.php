<?php
        require_once('simpletest/autorun.php');

        class AllTests extends TestSuite {
                function __construct() {
                        parent::__construct('All Tests');
                        $this->addfile('test_test.php');
                }
        }
        
