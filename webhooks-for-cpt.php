<?php
/**
 * Plugin Name: Webhooks for CPT
 * Description: Allows adding multiple webhooks for each created CPT (JetEngine or others). Sends notifications to specific URLs when a post from a selected CPT is created or updated.
 * Version: 1.2.1
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
