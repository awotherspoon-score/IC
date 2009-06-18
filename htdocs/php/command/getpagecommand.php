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

                        $page = null;

                        if ($context->get('page-id') != null) {
                                $page = $pageMapper->find($context->get('page-id'));        
                        }

                        if ($context->get('page-slug') != null) {
                                $page = $pageMapper->findBySlug($context->get('page-slug'));
                        }

                        if ($page === null) {
                                die("need either 'page-slug' or 'page-id' in the command context please!");
                        }

                        $context->addParam('page', $page);
                        return;
                }
        }
