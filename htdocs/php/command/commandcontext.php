<?php

        class CommandContext {
                private $params = array();
                private $error = "";

                function __construct() {
                        $this->params = $_REQUEST;
                }

                function addParam($key, $val) {
                        $this->params[$key] = $val;
                }

                function get( $key ) {
                        return (isset($this->params[$key])) ? $this->params[$key] : null;
                }

                function setError( $error) {
                        $this->error = $error;
                }

                function getError() {
                        return $this->error;
                }
                
                //we're probably going to need this for ajax
                function getParamArray() {
                        return $this->params;
                }
        }
