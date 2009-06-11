<?php
        /**
         * Command Superclass
         *
         * Defines one basic function common to all classes
         */
        abstract class Command() {
                /**
                 * Executes the command
                 *
                 * @param $context, CommandContext
                 *      contains info pertinent to the command, used for executing it
                 */
                abstract function execute(CommandContext $context);
        }

