<?php
    class CreateSuggestedLinkCommand extends Command {
        function execute( CommandContext $context ) {
            RequestRegistry::getPageMapper()->insertSuggestedLink(
                $context->get( 'pageid' ),
                $context->get( 'href' ),
                $context->get( 'anchortext' )
            );
        }
    }
