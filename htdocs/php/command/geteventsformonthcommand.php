<?php
	class GetEventsForMonthCommand extends Command {
		function execute( CommandContext $context ) {
			$month = ( $context->get( 'month' ) === null ) ? date('n') : $context->get( 'month' );
			$year = ( $context->get( 'year' ) === null ) ? date('Y') : $context->get( 'year' );

			$context->addParam('events', RequestRegistry::getNewsEventMapper()->findAllEventsForMonth( $month, $year ) );
		}
	}
