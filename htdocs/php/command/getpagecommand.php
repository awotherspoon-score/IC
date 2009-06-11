<?php
        /**
         * Retrieves a page object from the database
         *
         * Requires a page slug in $contect->get('page-slug')
         *      OR
         * Requires a page id in $context->get('page-id')
         */
        class GetPageCommand extends Command {
                function execute(CommandContext $context) {
                        $pageMapper = RequestRegistry::getPageMapper();

                        if ($context->get('page-id') != null) {
                                $page = $pageMapper->find($context->get('page-id');        
                                $context->set('page', $page);
                                return;
                        }

                        if ($context->get('page-slug') != null) {
                                $page = $pageMapper->findBySlug($context->get('page-slug'));
                                $context->set('page', $page);
                                return;
                        }
                        
                }
        }
