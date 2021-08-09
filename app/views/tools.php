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

<form id="wp-post-status-tools-form" method="post">
    <label for="status-text"><?php esc_html_e( 'Your Status', 'wp-post-status' ); ?></label>
    <textarea name="status_text" id="status-text"><?php echo esc_attr( isset( $status_text ) ?? $status_text ); ?></textarea>

    <?php if ( is_super_admin() ) : ?>
		
    <?php endif; ?>

    <?php wp_nonce_field( 'wp_post_status_tools_field', 'tools_field' ); ?>
    <input type="submit" value="Save" class="button button-primary">
</form>
