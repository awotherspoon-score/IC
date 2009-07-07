<?php
	class GetAllNewsCommand extends Command {
		function execute( CommandContext $context ) {
			$context->addParam('news', RequestRegistry::getNewsEventMapper()->findAllNews());
			return;
		}
	}
