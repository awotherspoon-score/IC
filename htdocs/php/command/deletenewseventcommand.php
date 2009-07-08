<?php
	class DeleteNewsEventCommand extends Command {
		function execute( CommandContext $context ) {
			RequestRegistry::getNewsEventMapper()->delete($context->get('newsevent'));	
		}
	}
