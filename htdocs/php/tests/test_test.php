<?php
        require_once('simpletest/autorun.php');
        require_once('../../init.php');

        class TestOfTest extends UnitTestCase {
                function test_that_a_passed_test_passes() {
                        $this->assertTrue(true);
                }

                function test_that_a_failed_test_fails() {
                        $this->assertTrue(true);
                }
        }

