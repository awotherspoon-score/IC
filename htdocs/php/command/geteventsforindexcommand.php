<?php
	class GetEventsForIndexCommand extends Command {
		function execute( CommandContext $context ) {
			return RequestRegistry::getNewsEventMapper()->findEventsForIndex();
		}
	}
