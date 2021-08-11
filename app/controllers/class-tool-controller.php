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
	 * Message after form is processed.
	 *
	 * @var string $notice_message
	 */
	private $notice_message = null;

	/**
	 * Register hooks.
	 */
	public function register() {
		// Get user.
		$user = wp_get_current_user();

		// Show settings page to only site admin or network admin.
		if ( ! ( is_super_admin() || in_array( 'administrator', $user->roles, true ) ) ) {
			return;
		}

		add_action( 'admin_menu', array( $this, 'register_page' ) );
	}

	/**
	 * Register page.
	 */
	public function register_page() {

		// Handle form submission.
		$this->handle_submit();

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
		// Get option value.
		$option_value = Tool_Model::get_option();

		include WP_POST_STATUS_DIR . 'app/views/tools.php';
	}

	/**
	 * Handle form submission.
	 */
	public function handle_submit() {
		if ( ! empty( $_POST['wps_tools_field'] ) && wp_verify_nonce( $_POST['wps_tools_field'], 'wp_post_status_tools_nonce' ) ) {
			// Get user.
			$user = wp_get_current_user();

			// Check if user is not an administrator.
			if ( ! ( is_super_admin() || in_array( 'administrator', $user->roles, true ) ) ) {
				wp_die( 'You are not allowed!' );
			}

			// Verify nonce.
			check_admin_referer( 'wp_post_status_tools_nonce', 'wps_tools_field' );

			// Prepare status option.
			$status_option = array(
				'status_text'             => ! empty( $_POST['status_text'] ) ? sanitize_textarea_field( wp_unslash( $_POST['status_text'] ) ) : '',
				'display_name_visibility' => ! empty( $_POST['display_name_visibility'] ) && 'show' === $_POST['display_name_visibility'] ? 'show' : 'hide',
				'status_visibility'       => ! empty( $_POST['status_visibility'] ) && 'show' === $_POST['status_visibility'] ? 'show' : 'hide',
				'status_display_name'     => ucwords( $user->display_name ),
			);

			// Validate 'overwrite' data.
			if (
				is_multisite()
				&& is_super_admin()
				&& ! empty( $_POST['status_overwrite'] )
				&& 'overwrite' === $_POST['status_overwrite']
			) {
				$status_option['status_overwrite'] = 'overwrite';
			} else {
				$status_option['status_overwrite'] = 'no';
			}

			// Update status option.
			Tool_Model::set_option( $status_option );

			// Show notice.
			if ( 'overwrite' === $status_option['status_overwrite'] ) {
				add_action( 'admin_notices', array( $this, 'add_update_status_overwrite_notice' ) );
			} else {
				add_action( 'admin_notices', array( $this, 'add_update_status_notice' ) );
			}
		}
	}

	/**
	 * Singlesite notice, when status is add/updated successfully.
	 */
	public function add_update_status_notice() {
		?>
		<div class="updated notice is-dismissible">
			<p><?php esc_html_e( 'Your status is updated and it is shown on admin dashboard.', 'wp-post-status' ); ?></p>
		</div>
		<?php
	}

	/**
	 * Multisite notice, when status is add/updated successfully.
	 */
	public function add_update_status_overwrite_notice() {
		?>
		<div class="updated notice is-dismissible">
			<p><?php esc_html_e( 'Your status is updated and it is shown on admin dashboard. All the subsite status are overwrote.', 'wp-post-status' ); ?></p>
		</div>
		<?php
	}
}
