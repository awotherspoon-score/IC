<?php
        /**
         * Updates a page in the database
         *
         * Requires a page object in $context->get('page')
         */
        class UpdatePageCommand extends Command {
                public function execute(CommandContext $context) {
                        $pageMapper = RequestRegistry::getPageMapper();
                        $pageMapper->update($context->get('page'));
                        return;
                }
        }
