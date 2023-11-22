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

<h1><?php _e( 'Post Status', 'wp-post-status' ); ?></h1>

<form id="wps-tools-form" method="post">
	<p class="wps-intro"><?php _e('This plugin enables website administrators to post status on dashboard.', 'wp-post-status'); ?></p>
	<label class="wps-ui-textarea">
		<span><?php _e( 'Your Status', 'wp-post-status' ); ?>:</span>
		<textarea name="status_text" rows="5"><?php echo esc_attr( wp_unslash( isset( $option_value['status_text'] ) ? $option_value['status_text'] : '' ) ); ?></textarea>
	</label>

	<div class="wps-ui-radio">
		<span><?php _e( 'Show/hide status on dashboard', 'wp-post-status' ); ?>:</span>
		<label for="status-visibility-show" class="wps-font-weight-normal wps-inline-block">
			<input type="radio"
				name="status_visibility"
				id="status-visibility-show"
				value="show"
				<?php echo empty( $option_value['status_visibility'] ) || 'show' === $option_value['status_visibility'] ? 'checked' : ''; ?>>
			<span><?php _e( 'show', 'wp-post-status' ); ?></span>
		</label>
		<label for="status-visibility-hide" class="wps-font-weight-normal wps-inline-block">
			<input type="radio"
				name="status_visibility"
				id="status-visibility-hide"
				value="hide"
				<?php echo ! empty( $option_value['status_visibility'] ) && 'hide' === $option_value['status_visibility'] ? 'checked' : ''; ?>>
			<span><?php _e( 'hide', 'wp-post-status' ); ?></span>
		</label>
	</div>

	<div class="wps-ui-radio">
		<span><?php _e( 'Show/hide user\'s name', 'wp-post-status' ); ?>:</span>
		<label for="display-name-visibility-show" class="wps-font-weight-normal wps-inline-block">
			<input type="radio"
				name="display_name_visibility"
				id="display-name-visibility-show"
				value="show"
				<?php echo empty( $option_value['display_name_visibility'] ) || 'show' === $option_value['display_name_visibility'] ? 'checked' : ''; ?>>
			<span><?php _e( 'show', 'wp-post-status' ); ?></span>
		</label>
		<label for="display-name-visibility-hide" class="wps-font-weight-normal wps-inline-block">
			<input type="radio"
				name="display_name_visibility"
				id="display-name-visibility-hide"
				value="hide"
				<?php echo ! empty( $option_value['display_name_visibility'] ) && 'hide' === $option_value['display_name_visibility'] ? 'checked' : ''; ?>>
			<span><?php _e( 'hide', 'wp-post-status' ); ?></span>
		</label>
	</div>

	<?php if ( is_multisite() && is_super_admin() ) : ?>
		<label class="wps-ui-checkbox">
			<input type="checkbox"
				name="status_overwrite"
				value="overwrite">
			<span><?php _e( 'Overwrite subsite status', 'wp-post-status' ); ?></span>
			<span class="wps-short-note"><?php _e('Check if you want to overwrite and update all subsite status.', 'wp-post-status'); ?></span>
		</label>
	<?php endif; ?>

	<?php wp_nonce_field( 'wp_post_status_tools_nonce', 'wps_tools_field' ); ?>
	<input type="submit" value="Save" class="wps-button button button-primary">
</form>
