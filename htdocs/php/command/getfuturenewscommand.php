<?php
	class GetFutureNewsCommand extends Command {
		function execute( CommandContext $context ) {
			$news = RequestRegistry::getNewsEventMapper()->findAllFutureNews();
			$context->addParam('news', $news);
		}
	}
