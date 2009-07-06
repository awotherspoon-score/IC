<?php
	class DeleteAlbumCommand extends Command {
		function execute(CommandContext $context) {
			$albumMapper = RequestRegistry::getAlbumMapper();
			$imageMapper = RequestRegistry::getImageMapper();

			$album = $context->get('album');
			$images = $album->getImages();

			foreach ($images as $image ) {
				$imageMapper->delete($image);
			}

			$albumMapper->delete($album);
			return;
		}
	}
