<?php
	class GetRecentlyModifiedNewsCommand extends Command {
		function execute( CommandContext $context ) {
			$count = ( $context->get( 'count' ) === null ) ? 5 : $context->get( 'count' );
			$context->addParam( 'news', RequestRegistry::getNewsEventMapper()->findRecentlyModifiedNews( $count ) );
		}
	}
