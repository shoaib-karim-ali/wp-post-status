<?php
/**
 * Handle when plugin is activated/ deactivate or uninstalled
 *
 * @package WP_Post_Status\Core
 */

namespace WP_Post_Status\Core;

// If not called from WordPress then abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class for handling plugin installation.
 */
class Installer {

	/**
	 * Plugin instance.
	 *
	 * @var null|Installer
	 */
	private static $instance = null;

	/**
	 * Return the plugin instance.
	 *
	 * @return Installer
	 */
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Handle plugin activation.
	 */
	public static function activate() {

	}

	/**
	 * Handle plugin deactivation.
	 */
	public static function deactivate() {

	}

	/**
	 * Handle plugin uninstallation.
	 */
	public function uninstall() {

	}
}
