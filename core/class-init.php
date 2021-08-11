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
	 * Filters and Actions.
	 */
	public static function boot() {
		// Register services.
		self::register_services();

		// Actions and filters.
		add_action( 'admin_init', array( __CLASS__, 'plugin_i18n' ) );
		add_filter( 'plugin_action_links_' . WP_POST_STATUS_BASENAME, array( __CLASS__, 'add_plugin_page_links' ) );
	}

	/**
	 * Load the translation files.
	 */
	public static function plugin_i18n() {
		load_plugin_textdomain(
			'wp-post-status',
			false,
			dirname( WP_POST_STATUS_BASENAME ) . '/languages'
		);
	}

	/**
	 * Add custom links to plugin page.
	 *
	 * @param array $links An array of plugin links.
	 */
	public static function add_plugin_page_links( $links ) {
		$links[] = '<a href="' . menu_page_url( 'post-status', false ) . '">' . esc_html__( 'Post status', 'wp-post-status' ) . '</a>';
		return $links;
	}

	/**
	 * Set of classes
	 *
	 * @return array Full list of classes
	 */
	public static function get_services() {
		return array(
			\WP_Post_Status\App\Controllers\Tool_Controller::class,
			\WP_Post_Status\App\Controllers\Dashboard_Controller::class,
			\WP_Post_Status\Core\Enqueue::class,
		);
	}

	/**
	 * Initialize classes.
	 */
	private static function register_services() {
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
