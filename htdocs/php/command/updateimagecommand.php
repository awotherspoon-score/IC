<?php
        /**
         * Updates a image in the database
         *
         * Requires a image object in $context->get('image')
         */
        class UpdateImageCommand extends Command {
                public function execute(CommandContext $context) {
                        $imageMapper = RequestRegistry::getImageMapper();
                        $imageMapper->update($context->get('image'));
                        return;
                }
        }
