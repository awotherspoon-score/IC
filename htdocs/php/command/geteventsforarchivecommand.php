<?php
	class GetEventsForArchiveCommand extends Command {
		function execute( CommandContext $context ) {
			$news = RequestRegistry::getNewsEventMapper()->findAllEventsForArchive( $context->get('period') );
			$context->addParam( 'news', $news );
		}
	}
