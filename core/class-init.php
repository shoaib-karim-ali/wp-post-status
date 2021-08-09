<?php
/**
 * Initialize all the core classes of the plugin.
 *
 * @package WP_Post_Status\Core
 */

namespace WP_Post_Status\Core;

// If not called from WordPress then abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class for Initializing core classes.
 */
class Init {

	/**
	 * Set of classes
	 *
	 * @return array Full list of classes
	 */
	public static function get_services() {
		return array(
			\WP_Post_Status\App\Controllers\Tool_Controller::class,
		);
	}

	/**
	 * Initialize classes.
	 */
	public static function register_services() {
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );

			if ( null !== $service ) {
				// Call register method if exists.
				if ( method_exists( $service, 'register' ) ) {
					$service->register();
				}
			}
		}
	}

	/**
	 * Initialize the class
	 *
	 * @param  class $class    Set of classes to be instanciated.
	 * @return class instance  New instance of the class.
	 */
	private static function instantiate( $class ) {
		$service = null;

		if ( class_exists( $class ) ) {
			$service = new $class();
		}

		return $service;
	}

}
