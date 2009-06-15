<?php
        /**
         * Gets child page objects of a given page
         * 
         * Takes a slug, id or page object and returns a collection
         *
         **/
        class GetChildPagesCommand extends Command {
                public function execute(CommandContext $context) {
                       $object = $context->get('page-object');
                       $id = $context->get('page-id');
                       $slug = $$context->get('page-slug');
                       
                       
                        
                       
                }
        }
