<?php
/**
 * Settings Class for Webhooks for CPT
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PDMKT_WFP_Settings {

	private $option_name = 'wf_cpt_webhooks';
	private $domain      = 'webhooks-for-cpt';

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
	}

	public function enqueue_admin_assets( $hook ) {
		if ( 'settings_page_webhooks-for-cpt' !== $hook ) {
			return;
		}
		wp_enqueue_style( 'pdmkt-wfp-admin-style', plugins_url( 'assets/css/admin-style.css', dirname( __FILE__ ) ), array(), '1.2.1' );
	}

	public function add_admin_menu() {
		add_options_page(
			esc_html__( 'Webhooks for CPT', 'webhooks-for-cpt' ),
			esc_html__( 'Webhooks for CPT', 'webhooks-for-cpt' ),
			'manage_options',
			'webhooks-for-cpt',
			array( $this, 'settings_page_content' )
		);
	}

	public function register_settings() {
		register_setting( 'wf_cpt_group', $this->option_name, array( 'sanitize_callback' => array( $this, 'sanitize_settings' ) ) );
	}

	/**
	 * Sanitize plugin settings
	 */
	public function sanitize_settings( $input ) {
		$new_input = array();
		if ( is_array( $input ) ) {
			foreach ( $input as $key => $values ) {
				$new_input[ sanitize_key( $key ) ] = array(
					'enabled' => isset( $values['enabled'] ) ? 1 : 0,
					'url'     => esc_url_raw( $values['url'] ),
				);
			}
		}
		return $new_input;
	}

	public function settings_page_content() {
		$cpts     = pdmkt_wfp_get_available_cpts();
		$settings = get_option( $this->option_name, array() );
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Webhooks for CPT', 'webhooks-for-cpt' ); ?></h1>
			<p><?php esc_html_e( 'Configure a webhook URL for each Custom Post Type. Notifications are only sent for selected CPTs.', 'webhooks-for-cpt' ); ?></p>
			
			<form method="post" action="options.php">
				<?php settings_fields( 'wf_cpt_group' ); ?>
				
				<table class="pdmkt-wfp-table">
					<thead>
						<tr>
							<th scope="col"><?php esc_html_e( 'Custom Post Type', 'webhooks-for-cpt' ); ?></th>
							<th scope="col"><?php esc_html_e( 'Enable', 'webhooks-for-cpt' ); ?></th>
							<th scope="col"><?php esc_html_e( 'Webhook URL', 'webhooks-for-cpt' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php if ( empty( $cpts ) ) : ?>
							<tr>
								<td colspan="3"><?php esc_html_e( 'No Custom Post Types detected (excluding standard ones).', 'webhooks-for-cpt' ); ?></td>
							</tr>
						<?php else : ?>
							<?php foreach ( $cpts as $slug => $cpt ) : 
								$enabled = isset( $settings[ $slug ]['enabled'] ) ? $settings[ $slug ]['enabled'] : false;
								$url     = isset( $settings[ $slug ]['url'] ) ? $settings[ $slug ]['url'] : '';
								?>
								<tr>
									<td><strong><?php echo esc_html( $cpt->label ); ?></strong> (<?php echo esc_html( $slug ); ?>)</td>
									<td>
										<input type="checkbox" name="<?php echo esc_attr( $this->option_name ); ?>[<?php echo esc_attr( $slug ); ?>][enabled]" value="1" <?php checked( $enabled, 1 ); ?> />
									</td>
									<td>
										<input type="url" name="<?php echo esc_attr( $this->option_name ); ?>[<?php echo esc_attr( $slug ); ?>][url]" value="<?php echo esc_url( $url ); ?>" class="large-text" placeholder="https://your-webhook.com/..." />
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
				
				<?php submit_button(); ?>
			</form>
			
			<div class="pdmkt-wfp-credits">
				<p>
					<?php 
					printf( 
						/* translators: %s: Author link */
						esc_html__( 'Created by %s.', 'webhooks-for-cpt' ), 
						'<a href="https://panoramasdmkt.com" target="_blank">Panoramas Digital Marketing</a>' 
					); 
					?>
				</p>
			</div>
		</div>
		<?php
	}
}
