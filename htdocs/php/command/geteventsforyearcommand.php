<?php
	class GetEventsForYearCommand extends Command {
		function execute( CommandContext $context ) {
			$year = ( $context->get( 'year' ) === null ) ? time( 'Y' ) : $context->get( 'year' );
			$context->addParam( 'events',  RequestRegistry::getNewsEventMapper()->findEventsForYear( $year ) );
		}
	}
