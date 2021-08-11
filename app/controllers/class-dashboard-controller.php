<?php
/**
 * Manage admin dashboard page.
 *
 * @package WP_Post_Status\App\Controllers
 */

namespace WP_Post_Status\App\Controllers;

use WP_Post_Status\App\Models\Tool_Model;

// If not called from WordPress then abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Manage admin dashboard page.
 */
class Dashboard_Controller {

	/**
	 * Register hooks.
	 */
	public function register() {
		add_action( 'wp_dashboard_setup', array( $this, 'add_widget' ) );
	}

	/**
	 * Register page.
	 */
	public function add_widget() {
		wp_add_dashboard_widget( 'wp_post_status_dashboard_widget', 'Admin Status', array( $this, 'render' ) );
	}

	/**
	 * Rnder the page.
	 */
	public function render() {
		// Get option value.
		$option_value = Tool_Model::get_option();

		include WP_POST_STATUS_DIR . 'app/views/dashboard-widget.php';
	}
}
