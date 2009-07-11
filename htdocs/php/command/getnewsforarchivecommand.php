<?php
	class GetNewsForArchiveCommand extends Command {
		function execute( CommandContext $context ) {
			$news = RequestRegistry::getNewsEventMapper()->findAllNewsForArchive( $context->get('period') );
			$context->addParam( 'news', $news );
		}
	}
