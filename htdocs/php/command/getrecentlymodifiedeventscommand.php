<?php
	class GetRecentlyModifiedEventsCommand extends Command {
		function execute( CommandContext $context ) {
			$count = ( $context->get( 'count' ) === null ) ? 5 : $context->get( 'count' );
			$context->addParam( 'events', RequestRegistry::getNewsEventMapper()->findRecentlyModifiedEvents( $count ) );
		}
	}
