<?php
    class DeleteSuggestedLinkCommand extends Command {
        function execute( CommandContext $context ) {
            RequestRegistry::getPageMapper()->deleteSuggestedLink( $context->get( 'suggested-link-id' );
        }
    }
