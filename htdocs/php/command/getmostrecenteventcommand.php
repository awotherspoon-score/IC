<?php
	class GetMostRecentEventCommand extends Command {
		function execute( CommandContext $context ) {
			$context->addParam('newsevent', RequestRegistry::getNewsEventMapper()->findMostRecentEvent());	
		}
	}
