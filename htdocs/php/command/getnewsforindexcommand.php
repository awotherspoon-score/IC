<?php
	class GetNewsForIndexCommand extends Command {
		function execute( CommandContext $context ) {
			return RequestRegistry::getNewsEventMapper()->findNewsForIndex();
		}
	}
