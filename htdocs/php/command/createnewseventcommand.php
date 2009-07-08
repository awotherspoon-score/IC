<?php
	class CreateNewsEventCommand extends Command {
		function execute( CommandContext $context ) {
			$newsevent = $context->get('newsevent');
			RequestRegistry::getNewsEventMapper()->insert($newsevent);
		}
	}	
