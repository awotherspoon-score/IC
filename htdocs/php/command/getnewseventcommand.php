<?php
	class GetNewsEventCommand extends Command 
	{
		function execute( CommandContext $context ) {
			$newsevent = RequestRegistry::getNewsEventMapper()->find($context->get('newsevent-id'));
			$context->addParam( 'newsevent', $newsevent );
		}
	}

