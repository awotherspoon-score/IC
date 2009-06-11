<?php
        /**
         * Create a page in the database
         *
         * Requires a page object in $context->get('page')
         */
        class CreatePageCommand extends Command {
                function execute(CommandContext $context) {
                        $page = $context->get('page');
                        $pageMapper = RequestRegistry::getPageMapper();
                        $pageMapper->insert($page);
                }
        }
