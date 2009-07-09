<?php
	class GetLiveNewsForMonthCommand extends Command {
		function execute(CommandContext $context) {
			$month = $context->get('month');
			$year = $context->get('year');
			$context->addParam('news', RequestRegistry::getNewsEventMapper()->findAllLiveNewsForMonth($month, $year));
		}
	}
