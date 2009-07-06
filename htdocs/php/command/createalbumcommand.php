<?php
        /**
         * Create a album in the database
         *
         * Requires a album object in $context->get('album')
         */
        class CreateAlbumCommand extends Command {
                function execute(CommandContext $context) {
                        $album = $context->get('album');
                        $albumMapper = RequestRegistry::getAlbumMapper();
                        $albumMapper->insert($album);
                }
        }
