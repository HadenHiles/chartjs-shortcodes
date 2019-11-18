<?php
/**
 * Plugin Name:       Chart.js Shortcodes Plugin
 * Plugin URI:        https://github.com/HadenHiles/chartjs-shortcodes
 * Description:       Chart.js shortcodes in a plugin for WordPress
 * Version:           1.0.0
 * Author:            Haden Hiles
 * Author URI:        https://github.com/HadenHiles
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Define global constants.
 *
 * @since 1.0.0
 */
// Plugin version.
if ( ! defined( 'ABS_VERSION' ) ) {
	define( 'ABS_VERSION', '2.0.0' );
}

if ( ! defined( 'ABS_NAME' ) ) {
	define( 'ABS_NAME', trim( dirname( plugin_basename( __FILE__ ) ), '/' ) );
}

if ( ! defined( 'ABS_DIR' ) ) {
	define( 'ABS_DIR', WP_PLUGIN_DIR . '/' . ABS_NAME );
}

if ( ! defined( 'ABS_URL' ) ) {
	define( 'ABS_URL', WP_PLUGIN_URL . '/' . ABS_NAME );
}

/**
 * Link.
 *
 * @since 1.0.0
 */
if ( file_exists( ABS_DIR . '/shortcode/chart.php' ) ) {
	require_once( ABS_DIR . '/shortcode/chart.php' );
}

function chartjs_enqueue_script() {
    wp_enqueue_script( 'chartjs_script', plugin_dir_url( __FILE__ ) . 'node_modules/chart.js/dist/Chart.min.js' );
}
add_action('wp_enqueue_scripts', 'chartjs_enqueue_script');
