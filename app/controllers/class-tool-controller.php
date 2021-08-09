<?php
/**
 * Manage Tools sub page.
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
 * Manage Tools sub page.
 */
class Tool_Controller {

	/**
	 * Register hooks.
	 */
	public function register() {
		add_action( 'admin_menu', array( $this, 'register_page' ) );
	}

	/**
	 * Register page.
	 */
	public function register_page() {
		add_submenu_page(
			'tools.php',
			'Post Status',
			'Post Status',
			'manage_options',
			'post-status',
			array( $this, 'render' )
		);
	}

	/**
	 * Rnder the page.
	 */
	public function render() {
		if ( ! empty( $_POST ) ) {
			// Get user.
			$user = wp_get_current_user();

			// Check if user is not an administrator.
			if ( ! ( is_super_admin() || in_array( 'administrator', $user->roles ) ) ) {
				wp_die( 'You are not allowed!' );
			}

			// Verify nonce.
			check_admin_referer( 'wp_post_status_tools_field', 'tools_field' );

			if ( ! empty( $_POST['status_text'] ) ) {
				Tool_Model::set_option(
					array(
						'status_text'       => sanitize_textarea_field( $_POST['status_text'] ),
						'user_display_name' => ucwords( $user->display_name ),
						'overwrite'         => is_multisite() && is_super_admin() && ! empty( $_POST['overwrite'] ) ? true : false,
					)
				);
			}
		}

		// Get option value.
		$option_value = Tool_Model::get_option();
var_dump( get_current_blog_id(), $option_value );
		include WP_POST_STATUS_DIR . 'app/views/tools.php';
	}
}
