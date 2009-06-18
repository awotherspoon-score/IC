<?php
        /**
         * Generate A Command Class Based On An Action
         *
         * Automatically returns the correct class as long as it's
         * in the commands folder and the input action corresponds
         */
        class CommandFactory {
                
                /**
                 * Initializes a new command and returns it
                 *
                 * @param $action - string, the action used to determine the command to return
                 */
                static function getCommand($action = 'default') {
                       if ( preg_match( '/\ /', $action) ) {
                                throw new Exception('illegal characters in action');
                       }


                       //generate the class name based on the action
                       //'get-page' evaluates to GetPageCommand class
                       $classArray = explode('-', $action);
                       $class = '';

                       foreach ($classArray as $string) {
                                $class .= ucfirst($string);
                       }

                       $class .= 'Command';

                       $cmd = new $class();
                       return $cmd;
                }
        }
