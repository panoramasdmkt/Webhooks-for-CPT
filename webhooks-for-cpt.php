<?php
/**
 * Plugin Name: Webhooks for CPT
 * Plugin URI: https://panoramasdmkt.com
 * Description: Allows adding multiple webhooks for each created CPT (JetEngine or others). Sends notifications to specific URLs when a post from a selected CPT is created or updated.
 * Version: 1.2
 * Author: Panoramas Digital Marketing
 * Author URI: https://panoramasdmkt.com
 * License: GPL2
 * Text Domain: webhooks-for-cpt
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define Constants
define( 'PDMKT_WFP_PATH', plugin_dir_path( __FILE__ ) );
define( 'PDMKT_WFP_URL', plugin_dir_url( __FILE__ ) );

/**
 * Global helper function to get available CPTs
 */
function pdmkt_wfp_get_available_cpts() {
	$args = array(
		'public'   => true,
		'_builtin' => false,
	);
	return get_post_types( $args, 'objects' );
}

/**
 * Load Textdomain
 */
function pdmkt_wfp_load_textdomain() {
	load_plugin_textdomain( 'webhooks-for-cpt', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'pdmkt_wfp_load_textdomain' );

// Include Classes
require_once PDMKT_WFP_PATH . 'includes/class-pdmkt-wfp-settings.php';
require_once PDMKT_WFP_PATH . 'includes/class-pdmkt-wfp-handler.php';

/**
 * Initialize Plugin
 */
function pdmkt_wfp_init() {
	new PDMKT_WFP_Settings();
	new PDMKT_WFP_Handler();
}
add_action( 'init', 'pdmkt_wfp_init' );
