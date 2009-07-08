<?php
	class GetMostRecentNewsCommand extends Command {
		function execute( CommandContext $context ) {
			$context->addParam('newsevent', RequestRegistry::getNewsEventMapper()->findMostRecentNews());	
		}
	}
