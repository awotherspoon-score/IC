<?php
    class CreateSuggestedLink extends Command {
        function execute( CommandContext $context ) {
            RequestRegistry::getPageMapper()->insertSuggestedLink(
                $context->get( 'page-id' ),
                $context->get( 'href' ),
                $context->get( 'anchor-text' )
            );
        }
    }
