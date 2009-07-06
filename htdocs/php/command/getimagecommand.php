<?php
        /**
         * Retrieves a image object from the database
         *
         * Requires a image slug in $contect->get('image-slug')
         *      OR
         * Requires a image id in $context->get('image-id')
         */
        class GetImageCommand extends Command {
                function execute(CommandContext $context) {
                        $imageMapper = RequestRegistry::getImageMapper();

                        $image = null;

                        if ($context->get('image-id') != null) {
                                $image = $imageMapper->find($context->get('image-id'));        
                        }

                        if ($context->get('image-slug') != null) {
                                $image = $imageMapper->findBySlug($context->get('image-slug'));
                        }

                        if ($image === null) {
                                die("need either 'image-slug' or 'image-id' in the command context please!");
                        }

                        $context->addParam('image', $image);
                        return;
                }
        }
