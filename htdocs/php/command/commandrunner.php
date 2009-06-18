<?php
        /**
         * Conveniance class used to run commands
         */
         class CommandRunner {
                public static function run($action, $parameters) {
                        $command = CommandFactory::getCommand($action);
                        $context = new CommandContext();
                        
                        foreach ($parameters as $key => $value) {
                                $context->addParam($key, $value);
                        }

                        $command->execute($context);
                        return $context;
                }
         }
