<?php
	class UpdateNewsEventCommand extends Command {
		function execute( CommandContext $context ) {
			RequestRegistry::getNewsEventMapper()->update($context->get('newsevent'));
		}
	}
