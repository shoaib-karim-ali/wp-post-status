<?php
/**
 * WP Post Status plugin
 *
 * This plugin allows posting a status message on the WordPress admin dashboard page.
 *
 * @package           WP_Post_Status
 * @author            Shoaib Ali
 * @copyright         2021 Shoaib Ali
 * @license           GPL-2.0
 *
 * @wordpress-plugin
 * Plugin Name:       WP Post Status
 * Plugin URI:        https://bitbucket.org/shoaib-karim-ali
 * Description:       This plugin allows posting a status message on the WordPress admin dashboard page.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Shoaib Ali
 * Author URI:        https://bitbucket.org/shoaib-karim-ali
 * Text Domain:       wp-post-status
 * Domain Path:       /languages/
 * License:           GPL v2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If not called from WordPress then abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'WP_POST_STATUS_VERSION' ) ) {
	define( 'WP_POST_STATUS_VERSION', '1.0.0' );
}
if ( ! defined( 'WP_POST_STATUS_BASENAME' ) ) {
	define( 'WP_POST_STATUS_BASENAME', plugin_basename( __FILE__ ) );
}
if ( ! defined( 'WP_POST_STATUS_DIR' ) ) {
	define( 'WP_POST_STATUS_DIR', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'WP_POST_STATUS_URL' ) ) {
	define( 'WP_POST_STATUS_URL', plugin_dir_url( __FILE__ ) );
}
if ( ! defined( 'WP_POST_STATUS_PREFIX' ) ) {
	define( 'WP_POST_STATUS_PREFIX', 'wp-post-status-' );
}
