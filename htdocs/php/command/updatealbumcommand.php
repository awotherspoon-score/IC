<?php
        /**
         * Updates a album in the database
         *
         * Requires a album object in $context->get('album')
         */
        class UpdateAlbumCommand extends Command {
                public function execute(CommandContext $context) {
                        $albumMapper = RequestRegistry::getAlbumMapper();
                        $albumMapper->update($context->get('album'));
                        return;
                }
        }
