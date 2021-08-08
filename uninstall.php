<?php
/**
 * Remove plugin settings and data.
 *
 * @package WP_Post_Status
 */

// If uninstall not called from WordPress then abort.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

// Load uninsallation class.
if ( ! class_exists( '\\WP_Post_Status\\Core\\Installer' ) ) {
	include_once plugin_dir_path( __FILE__ ) . '/core/class-installer.php';
}
WP_Post_Status\Core\Installer::get_instance()->uninstall();

