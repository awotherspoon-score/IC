<?php
	class GetAlbumsForIndexCommand extends Command  {
		function execute( CommandContext $context ) {
			$context->addParam( 'albums', RequestRegistry::getAlbumMapper()->findAllAlbumsForIndex() );
		}
	}
