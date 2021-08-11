<?php
/**
 * Render widget content.
 *
 * @package WP_Post_Status
 */

// If not called from WordPress then abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} ?>

<div class="wps-dashboard-widget">
	<?php if ( ! empty( $option_value['status_text'] ) ) : ?>
		<p><?php echo esc_html( $option_value['status_text'] ); ?></p>
	<?php else : ?>
		<p>
			<?php esc_html_e( 'No status is set yet.', 'wp-post-status' ); ?>
			<?php if ( is_admin() ) : ?>
				<?php esc_html_e( 'Follow the link to', 'wp-post-status' ); ?>
				<a href="<?php menu_page_url( 'post-status' ); ?>"><?php esc_html_e( 'add a status', 'wp-post-status' ); ?></a>
			<?php endif; ?>
		</p>
	<?php endif; ?>
</div>
