<?php
/**
 * Enqueue the required stylesheets and scripts.
 *
 * @package  WP_Post_Status\Core
 */

namespace WP_Post_Status\Core;

/**
 * Handle enqueuing the stylesheets and scripts.
 */
class Enqueue {
	/**
	 * Register the stylesheets and scripts.
	 */
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	/**
	 * Enqueue stylesheets and scripts.
	 *
	 * @param string $hook Current screen basename.
	 */
	public function enqueue( $hook ) {
		// Load style & script for plugin's tools page.
		if ( 'tools_page_post-status' === $hook ) {
			wp_enqueue_style( 'wp-post-status-style', WP_POST_STATUS_URL . 'assets/css/tools-style.css', array(), WP_POST_STATUS_VERSION );
			wp_enqueue_script( 'wp-post-status-script', WP_POST_STATUS_URL . 'assets/js/tools-script.js', array( 'jquery' ), WP_POST_STATUS_VERSION, true );
		}
	}
}
