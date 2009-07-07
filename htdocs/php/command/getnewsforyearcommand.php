<?php
	class GetNewsForYearCommand extends Command {
		function execute( CommandContext $context ) {
			$year = ( $context->get('year') === null ) ? date('Y') : $context->get('year');
			$news = RequestRegistry::getNewsEventMapper()->findAllNewsForYear($year);
			$context->addParam('news', $news);
		}
	}
