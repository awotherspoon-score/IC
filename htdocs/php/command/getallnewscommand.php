<?php
	class GetAllNewsCommand extends Command {
		function execute( CommandContext $context ) {
			$context->set('news', RequestRegistry::getNewsEventMapper()->findAllNews());
			return;
		}
	}
