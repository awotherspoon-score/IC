<?php
	class GetSoonestEventCommand extends Command {
		function execute( CommandContext $context ) {
			$context->addParam( 'newsevent', RequestRegistry::getNewsEventMapper()->findSoonestEvent() );
		}
	}
