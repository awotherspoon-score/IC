<?php
	class GetFutureEventsCommand extends Command {
		function execute( CommandContext $context ) {
			$news = RequestRegistry::getNewsEventMapper()->findAllFutureEvents();
			$context->addParam('events', $news);
		}
	}
