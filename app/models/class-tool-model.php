<?php
/**
 * Tool model.
 *
 * @package WP_Post_Status\App\Models
 */

namespace WP_Post_Status\App\Models;

// If not called from WordPress then abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Manage Tools sub page.
 */
class Tool_Model {

	/**
	 * Set the plugin option.
	 *
	 * @param array $params Accepts an array to set as option.
	 */
	public static function set_option( $params ) {
		// Replace all site's options.
		if ( is_multisite() && is_super_admin() && ! empty( $params['status_overwrite'] ) && 'overwrite' === $params['status_overwrite'] ) {
			global $wpdb;

			// Remove key.
			unset( $params['status_overwrite'] );

			// Get blogs.
			$blogs = $wpdb->get_results( "SELECT blog_id FROM {$wpdb->blogs}", ARRAY_A );

			if ( ! empty( $blogs ) ) {
				foreach ( $blogs as $blog ) {
					switch_to_blog( $blog['blog_id'] );

					// Overwrite option.
					update_option( WP_POST_STATUS_PREFIX . 'option', $params );

					// Revert back to the blog we were on.
					restore_current_blog();
				}
			}
		} else {
			update_option( WP_POST_STATUS_PREFIX . 'option', $params );
		}
	}

	/**
	 * Get the plugin option.
	 *
	 * @return array An array of option values.
	 */
	public static function get_option() {
		return get_option( WP_POST_STATUS_PREFIX . 'option' );
	}
}
