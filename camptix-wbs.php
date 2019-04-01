<?php
/**
 * The plugin bootstrap file.
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @wordpress-plugin
 * Plugin Name: Camptix - Workshop Booking System
 * Plugin URI:  https://neliosoftware.com/
 * Description: This extension allows WordCamp attendees to book a seat in Workshops.
 * Version:     0.0.1
 * Author:      David Aguilera
 * Author URI:  https://neliosoftware.com
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: camptix-wbs
 * Domain Path: /languages
 *
 * @link    https://neliosoftware.com
 * @since   0.0.1
 * @package CAMPTIX_WBS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}//end if

/**
 * Camptix_WBS
 */
class Camptix_WBS {

	private static $instance = null;

	public $plugin_path;
	public $plugin_url;
	public $plugin_name;
	public $plugin_version;

	public static function instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->init_options();
			self::$instance->init_hooks();
		}//end if

		return self::$instance;

	}//end instance()

	public function init_options() {

		$this->plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
		$this->plugin_url  = untrailingslashit( plugin_dir_url( __FILE__ ) );

		// load textdomain.
		load_plugin_textdomain( 'camptix-wbs', false, basename( dirname( __FILE__ ) ) . '/languages' );

	}//end init_options()

	public function init_hooks() {

		add_action( 'init', [ $this, 'plugin_data_init' ] );

	}//end init_hooks()

	public function plugin_data_init() {

		$data = get_file_data( __FILE__, [ 'Plugin Name', 'Version' ], 'plugin' );

		$this->plugin_name           = $data[0];
		$this->plugin_version        = $data[1];
		$this->plugin_slug           = plugin_basename( __FILE__, '.php' );
		$this->plugin_name_sanitized = basename( __FILE__, '.php' );

	}//end plugin_data_init()

}//end class

function camptix_wbs() {
	return Camptix_WBS::instance();
}//end camptix_wbs()
add_action( 'plugins_loaded', 'camptix_wbs' );

