<?php
        /**
         * Deletes a page from the database
         * 
         * Requires a page object in $context->get('page')
         */
        class DeletePageCommand extends Command {
                function execute(CommandContext $context) {
                        $pageMapper = RequestRegisty::getPageMapper();
                        $pageMapper->delete($context->get('page');
                        return;
                }
        }
