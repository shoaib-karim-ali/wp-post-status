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
	define( 'WP_POST_STATUS_PREFIX', 'wp_post_status_' );
}

// Initialize the plugin and load the plugin instance.
add_action( 'plugins_loaded', array( 'WP_Post_Status', 'get_instance' ) );

// Handle when plugin is activated/ deactivated.
require_once WP_POST_STATUS_DIR . 'core/class-installer.php';
register_activation_hook( __FILE__, array( 'WP_Post_Status\\Core\\Installer', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'WP_Post_Status\\Core\\Installer', 'deactivate' ) );

if ( ! class_exists( 'WP_Post_Status' ) ) {
	/**
	 * Class WP_Post_Status
	 */
	class WP_Post_Status {

		/**
		 * Plugin instance.
		 *
		 * @var null|WP_Post_Status
		 */
		private static $instance = null;

		/**
		 * WP_Post_Status constructor.
		 */
		private function __construct() {
			spl_autoload_register( array( $this, 'autoload' ) );

			$this->init();
		}

		/**
		 * Return the plugin instance.
		 *
		 * @return WP_Post_Status
		 */
		public static function get_instance() {
			if ( ! self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Autoload method.
		 *
		 * @param string $class  Class name for autoloading.
		 */
		public function autoload( $class ) {
			// Namespace prefix.
			$prefix = 'WP_Post_Status\\';

			// Skip if class doesn't use the namespace prefix.
			$str_len = strlen( $prefix );
			if ( 0 !== strncmp( $prefix, $class, $str_len ) ) {
				// Skip.
				return;
			}

			// Get the relative class name.
			$class_name = substr( $class, $str_len );

			$path      = explode( '\\', strtolower( str_replace( '_', '-', $class_name ) ) );
			$file_name = 'class-' . array_pop( $path ) . '.php';
			$file_path = WP_POST_STATUS_DIR . implode( '/', $path ) . '/' . $file_name;

			// Require file if it exists.
			if ( file_exists( $file_path ) ) {
				require_once $file_path;
			}
		}

		/**
		 * Init the core.
		 */
		private function init() {
			// Initialize all the core classes of the plugin.
			if ( class_exists( 'WP_Post_Status\\Core\\Init' ) ) {
				WP_Post_Status\Core\Init::boot();
			}
		}
	}
}
