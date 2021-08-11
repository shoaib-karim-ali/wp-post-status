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
		if ( is_multisite() ) {
			global $wpdb;

			$offset = 0;
			$limit  = 100;
			while ( $blogs = $wpdb->get_results( "SELECT blog_id FROM {$wpdb->blogs} LIMIT $offset, $limit", ARRAY_A ) ) {
				if ( $blogs ) {
					foreach ( $blogs as $blog ) {
						switch_to_blog( $blog['blog_id'] );

						delete_option( 'wp_post_status_option' );

						restore_current_blog();
					}
				}
				$offset += $limit;
			}
		} else {
			delete_option( 'wp_post_status_option' );
		}
	}
}
