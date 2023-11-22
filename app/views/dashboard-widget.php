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
		<?php
		if (
			! empty( $option_value['status_display_name'] )
			&& (
				empty( $option_value['display_name_visibility'] )
				|| 'show' === $option_value['display_name_visibility']
			)
		) :
			?>
			<span class="wps-dashboard-widget-display-name">by <em><?php echo esc_html( $option_value['status_display_name'] ); ?></em></span>
		<?php endif; ?>
	<?php else : ?>
		<p>
			<?php _e( 'No status is set yet.', 'wp-post-status' ); ?>
			<?php if ( is_admin() ) : ?>
				<?php _e( 'Follow the link to', 'wp-post-status' ); ?>
				<a href="<?php menu_page_url( 'post-status' ); ?>"><?php _e( 'add a status', 'wp-post-status' ); ?></a>
			<?php endif; ?>
		</p>
	<?php endif; ?>
</div>
