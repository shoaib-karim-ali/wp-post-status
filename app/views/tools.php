<?php
/**
 * Render view page.
 *
 * @package WP_Post_Status
 */

// If not called from WordPress then abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>

<h1><?php esc_html_e( 'Add Status', 'wp-post-status' ); ?></h1>

<form id="wps-tools-form" method="post">
	<p class="wps-intro">This plugin enables website admins to add status on dashboard.</p>
	<label class="wps-ui-textarea">
		<span><?php esc_html_e( 'Your Status', 'wp-post-status' ); ?>:</span>
		<textarea name="status_text" rows="5"><?php echo esc_attr( wp_unslash( isset( $option_value['status_text'] ) ? $option_value['status_text'] : '' ) ); ?></textarea>
	</label>

	<?php if ( is_multisite() && is_super_admin() ) : ?>
		<label class="wps-ui-checkbox">
			<input type="checkbox"
				name="status_overwrite"
				value="overwrite">
			<span><?php esc_html_e( 'Overwrite subsite status', 'wp-post-status' ); ?></span>
			<span class="wps-short-note">Check if you want to overwrite and update all subsite status.</span>
		</label>
	<?php endif; ?>

	<?php wp_nonce_field( 'wp_post_status_tools_field', 'tools_field' ); ?>
	<input type="submit" value="Save" class="wps-button button button-primary">
</form>
