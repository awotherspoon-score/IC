<?php
        /**
         * Deletes a page from the database
         * 
         * Requires a page object in $context->get('page')
         * Also deletes any and all child pages
         */
        class DeletePageCommand extends Command {
                function execute(CommandContext $context) {
                        $pageMapper = RequestRegistry::getPageMapper();
                        $page = $context->get('page');
                        $children = $page->getChildren();
                        foreach($children as $child) {
                                $pageMapper->delete($child);
                        }
                        $pageMapper->delete($page);
                        return;
                }
        }
