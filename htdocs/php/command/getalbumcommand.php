<?php
	class GetAlbumCommand extends Command {
		function execute( CommandContext $context ) {
			$albumMapper = RequestRegistry::getAlbumMapper();
			$album = null;
			if ( $context->get('album-id') != null ) {
				$album = $albumMapper->find($context->get('album-id'));
			}
			if ( $context->get('album-slug') != null ) {
				$album = $albumMapper->findBySlug($context->get('album-slug'));
			}
			if ( $album === null ) {
				$error = "Album Not Found, Check that you've sent 'album-id' or 'album-slug' in the command context, and that it's a valid slug/id";
				throw new Exception( $error );
			}
			$context->addParam('album', $album);
			return;
		}
	}
