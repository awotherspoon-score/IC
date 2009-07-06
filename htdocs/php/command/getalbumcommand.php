<?php
	class GetAlbumCommand extends Command {
		function execute( CommandContext $context ) {
			$albumMapper = RequestRegistry::getPageMapper();
			$album = null;
			$album->getImages(); //pull in the associated images
			if ( $context->get('album-id') != null ) {
				$album = $albumMapper->find($context->get('album-id'));
			}
			if ( $context->get('album-slug') != null ) {
				$album = $albumMapper->findBySlug($context->get('album-slug'));
			}
			if ( $album === null ) {
                                die("GetAlbumCommand: need either 'album-slug' or 'album-id' in the command context please!");
			}
			$contect->addParam('album', $album);
			return;
		}
	}
