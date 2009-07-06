<?php
	class DeleteImageCommand extends Command {
		function execute(CommandContext $context) {
			$imageMapper = RequestRegistry::getImageMapper();
			$imageMapper->delete($context->get('image');
		}
	}
