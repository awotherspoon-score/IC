<?php
	class GetNewsForYearCommand extends Command {
		function execute( CommandContext $context ) {
			$year = ( $context->get('year') === null ) ? date('Y') : $year;
			$news = RequestRegistry::getNewsEventMapper()->findAllNewsForYear($year);
			$context->addParam('news', $news);
		}
	}
