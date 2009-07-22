<?php
	/**
	 * Registry Superclass
	 *
	 * The registy acts as a notice board for system objects
	 * When we want a global resource like a config file or content mapper
	 * accessing it via a registry ensures there's only ever one instance, saving on hefty instantiation overheads
	 *
	 */
	abstract class Registry {
		abstract protected function get( $key );
		abstract protected function set( $key, $value);
	}
