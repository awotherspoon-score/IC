<?php
        /**
         * Create a image in the database
         *
         * Requires a image object in $context->get('image')
         */
        class CreateImageCommand extends Command {
                function execute(CommandContext $context) {
                        $image = $context->get('image');
                        $imageMapper = RequestRegistry::getImageMapper();
                        $imageMapper->insert($image);
                }
        }
