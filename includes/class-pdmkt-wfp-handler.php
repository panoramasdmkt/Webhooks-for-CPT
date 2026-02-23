<?php
/**
 * Webhook Handler Class for Webhooks for CPT
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PDMKT_WFP_Handler {

	private $option_name = 'wf_cpt_webhooks';

	public function __construct() {
		add_action( 'save_post', array( $this, 'trigger_webhook' ), 10, 3 );
		add_action( 'before_delete_post', array( $this, 'trigger_webhook_on_delete' ) );
	}

	public function trigger_webhook( $post_id, $post, $update ) {
		if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
			return;
		}

		$settings  = get_option( $this->option_name, array() );
		$post_type = $post->post_type;

		if ( isset( $settings[ $post_type ] ) && ! empty( $settings[ $post_type ]['enabled'] ) && ! empty( $settings[ $post_type ]['url'] ) ) {
			$webhook_url = $settings[ $post_type ]['url'];

			$payload = array(
				'post_id'     => $post_id,
				'post_title'  => get_the_title( $post_id ),
				'post_type'   => $post_type,
				'post_status' => $post->post_status,
				'post_url'    => get_permalink( $post_id ),
				'is_update'   => $update,
				'timestamp'   => current_time( 'mysql' ),
				'author_id'   => $post->post_author,
			);

			wp_remote_post( $webhook_url, array(
				'method'      => 'POST',
				'timeout'     => 15,
				'headers'     => array(
					'Content-Type' => 'application/json',
				),
				'body'        => wp_json_encode( $payload ),
			) );
		}
	}

	public function trigger_webhook_on_delete( $post_id ) {
		$post = get_post( $post_id );
		if ( ! $post ) {
			return;
		}

		$settings  = get_option( $this->option_name, array() );
		$post_type = $post->post_type;

		if ( isset( $settings[ $post_type ] ) && ! empty( $settings[ $post_type ]['enabled'] ) && ! empty( $settings[ $post_type ]['url'] ) ) {
			$webhook_url = $settings[ $post_type ]['url'];

			$payload = array(
				'post_id'     => $post_id,
				'post_title'  => $post->post_title,
				'post_type'   => $post_type,
				'post_status' => 'deleted',
				'timestamp'   => current_time( 'mysql' ),
			);

			wp_remote_post( $webhook_url, array(
				'method'      => 'POST',
				'timeout'     => 15,
				'headers'     => array(
					'Content-Type' => 'application/json',
				),
				'body'        => wp_json_encode( $payload ),
			) );
		}
	}
}
