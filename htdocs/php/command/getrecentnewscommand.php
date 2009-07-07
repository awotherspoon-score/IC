<?php
	class GetRecentNewsCommand extends Command {
		function execute( CommandContext $context ) {
			$news = RequestRegistry::getNewsEventMapper()->findAllRecentNews();
			$context->addParam('news', $news);
		}
	}
