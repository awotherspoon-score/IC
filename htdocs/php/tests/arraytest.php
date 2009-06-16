<?php
        require_once 'PHPUnit/Framework.php';

        class ArrayTest extends PHPUnit_Framework_TestCase
        {
                public function testNewArrayIsEmpty() {
                        //Create the Array Fixture
                        $fixture = array();

                        //Assert that the size of the Array fixture is 0
                        $this->assertEquals(0, sizeof($fixture));
                }

                public function testArrayContainsElement() {
                        //Create array fixture
                        $fixture = array();
                        
                        //Add element to the array fixture
                        $fixture[] = 'Element';

                        //Assert the size of the fixture is 1
                        $this->assertEquals(1, sizeof($fixture));
                }
        }
