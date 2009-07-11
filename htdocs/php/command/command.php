<?php
        /**
         * Command Superclass
         *
         * Defines one basic execute function common to all command classes
	 * Commands act as an interface between the website and the database
	 * All access (create, retrieve, update, delete) should, in theory, go via these commands
	 * 
	 * This gives the backend system a single point of access, so we don't necessarily have to
	 * be coming from a php website. 
	 * You could for example hit these commands from ajax (and we do that using 'ajaxcommandrunner.php') or
	 * an iphone app or anything that can do HTTP
	 *
         */
        abstract class Command {
                /**
                 * Executes the command
                 *
                 * @param $context, CommandContext
                 *      contains info pertinent to the command, used for executing it
                 */
                abstract function execute(CommandContext $context);
        }

