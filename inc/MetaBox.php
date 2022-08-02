<?php
namespace WP_PODRO\Engine;

use WP_PODRO\Engine\API\V1\Orders;
use WP_PODRO\Engine\API\V1\Providers;

class MetaBox {
	public function add_meta_boxes () {

		if ( get_post_type() == 'shop_order' && isset( $_GET[ 'post' ] ) ) {
			$order_id = $_GET[ 'post' ];
			$order = \wc_get_order($order_id);

			if ( !$order->has_shipping_method('podro_method') ) {
				return;
			}

			add_meta_box(
				'woocommerce-order-podro',
				__( 'Podro', POD_TEXTDOMAIN ),
				array($this, 'order_my_custom'),
				'shop_order',
				'side',
				'default'
			);
			// var_dump($order);
		}
	}

	public function order_my_custom() {
		$order_id = $_GET[ 'post' ];
		$order = \wc_get_order($order_id);

		$this->delivery_step_1( $order );
	}


	public function get_store_state() {
		$state = get_option( 'woocommerce_default_country' );
		$state = explode( ':', $state );
		return $state[1];
	}

	public function delivery_step_1( $order ) {

		$store_state = $this->get_store_state();
		$source_city = Location::get_province_by_code($store_state);
		$source_city = Location::get_city_by_name($source_city['name']);

		$order_id = $order->get_id();
		$destination_city = $order->get_shipping_city();
		$destination_city = Location::get_city_by_name($destination_city);

		?>
		<ul class="pod-delivery-step">
			<li>
				<label for="pod_source_city">مبدا</label>
				<input type="text" name="pod_source_city" id="pod_source_city" value="<?php echo $source_city['label']; ?>" disabled />
				<input type="hidden" name="pod_source_city_code" value="<?php echo $source_city['code']; ?>">
			</li>
			<li>
				<label for="pod_destination_city">مقصد</label>
				<input type="text" name="pod_destination_city" id="pod_destination_city" value="<?php echo $destination_city['label']; ?>" disabled />
				<input type="hidden" name="pod_destination_city_code" value="<?php echo $destination_city['code']; ?>">
			</li>
			<li>
				<label for="pod_weight">وزن مرسوله به گرم</label>
				<input type="number" name="pod_weight" id="pod_weight" value="" />
			</li>
			<li>
				<label for="pod_totalprice">ارزش مرسوله</label>
				<input type="number" name="pod_totalprice" id="pod_totalprice" value="<?php echo $order->get_subtotal(); ?>" />
			</li>
			<li class="pod-dimension">
				<p>ابعاد به سانتی‌متر</p>
				<div>
					<label for="pod_width">طول</label>
					<input type="number" name="pod_width" id="pod_width" value="" />
				</div>
				<div>
					<label for="pod_height">ارتفاع</label>
					<input type="number" name="pod_height" id="pod_height" value="" />
				</div>
				<div>
					<label for="pod_depth">عرض</label>
					<input type="number" name="pod_depth" id="pod_depth" value="" />
				</div>
			</li>

		</ul>

		<input type="hidden" name="pod_order_id" value="<?php echo $order_id; ?>">
		<button class="pod-delivery-step-button pod-delivery-step-1">مرحله بعد</button>
		<?php
	}

	public function ajax_saving_options_step_1() {

		// checking for nonce
		$this->validate_nonce( 'pod-options-nonce' );

		if (! isset($_POST['weight']) && ! isset($_POST['totalprice']) && ! isset($_POST['width']) && ! isset($_POST['height']) && ! isset($_POST['depth'])) {

			wp_send_json_error( __('Invalid item sent.', POD_TEXTDOMAIN), 400 );
			wp_die();

		}

		$order_id = $_POST['order_id'];
		$order = \wc_get_order($order_id);

		$store_state = $this->get_store_state();
		$source_city = Location::get_province_by_code($store_state);
		$source_city = Location::get_city_by_name($source_city['name']);

		$destination_city = $order->get_shipping_city();
		$destination_city = Location::get_city_by_name($destination_city);

		$data = [
			'source_city' => sanitize_text_field( $source_city['code'] ),
			'destination_city' => sanitize_text_field( $destination_city['code'] ),
			'parcels' => [
				[
					'weight' => sanitize_text_field( $_POST['weight'] ),
					'value' => sanitize_text_field( $_POST['totalprice'] ),
					'dimension' => [
						'width' => sanitize_text_field( $_POST['width'] ),
						'height' => sanitize_text_field( $_POST['height'] ),
						'depth' => sanitize_text_field( $_POST['depth'] )
					]
				]
			]
		];

		$response = (new Providers)->get_providers($data);

		if (is_wp_error($response)) {
			wp_send_json_error( $response->get_error_message(), 403 );
			wp_die();
		}

		wp_send_json_success( $response );
		wp_die();

	}


	public function ajax_saving_options_step_2() {

		// checking for nonce
		$this->validate_nonce( 'pod-options-nonce' );

		// checking for required fields
		if (! isset($_POST['weight']) && ! isset($_POST['width']) && ! isset($_POST['height']) && ! isset($_POST['depth']) && ! isset($_POST['provider_code'])) {

			wp_send_json_error( __('Invalid item sent.', POD_TEXTDOMAIN), 400 );
			wp_die();

		}

		$order_id = $_POST['order_id'];
		$order = \wc_get_order($order_id);

		$store_state = $this->get_store_state();
		$source_city = Location::get_province_by_code($store_state);
		$source_city = Location::get_city_by_name($source_city['name']);

		$destination_city = $order->get_shipping_city();
		$destination_city = Location::get_city_by_name($destination_city);

		$data = [
			'sender' => [
				'name' => $this->get_store_name(),
				'contact' => [
					'postal_code' => $this->get_store_postal_code(),
					'address' => $this->get_store_address(),
					'city' => $source_city['code'],
					'phone_number' => $this->get_store_phone_number(),
				],
			],
			'receiver' => [
				'name' => $order->get_shipping_first_name() . ' ' . $order->get_shipping_last_name(),
				'contact' => [
					'postal_code' => $order->get_shipping_postcode(),
					'address' => $order->get_shipping_address_1(),
					'city' => $destination_city['code'],
					'phone_number' => $order->get_billing_phone(),
				],
			],
			'parcels' => [
				[
					'id' => $order_id,
					'weight' => sanitize_text_field( $_POST['weight'] ),
					'value' => sanitize_text_field( $_POST['totalprice'] ),
					'content' => $this->get_products_name_by_order_id($order_id),
					'dimension' => [
						'width' => sanitize_text_field( $_POST['width'] ),
						'height' => sanitize_text_field( $_POST['height'] ),
						'depth' => sanitize_text_field( $_POST['depth'] )
					]
				]
			],
			'payment_type' => 1,
			'receiver_comment' => $order->get_customer_note(),
			'service_type' => 'regular',
			'provider_code' => sanitize_text_field( $_POST['provider_code'] ),
		];

		$response = (new Orders)->submit_order($data);

		if (is_wp_error($response) || !isset($response['order_id'])) {
			wp_send_json_error( $response->get_error_message(), 403 );
			wp_die();
		}

		$data['podro_order_id'] = $response['order_id'];

		wp_send_json_success( $data );
		wp_die();

	}

	public function validate_nonce( $nonce_key ) {
		if ( ! check_ajax_referer( $nonce_key, 'security', false ) ) {

			wp_send_json_error( __('Invalid security token sent.', POD_TEXTDOMAIN ), 403 );
			wp_die();

		}
	}

	private function get_store_name() {
		return get_bloginfo('name');
	}

	public function get_products_name_by_order_id( $order_id ) {
		$order = \wc_get_order($order_id);
		$items = $order->get_items();
		$products_name = '';
		foreach ($items as $item) {
			$products_name .= $item['name'] . ' ';
		}
		return $products_name;
	}

	private function get_store_postal_code() {
		return get_option('woocommerce_store_postcode');
	}

	private function get_store_address() {
		return get_option('woocommerce_store_address');
	}

	private function get_store_phone_number() {
		return get_option('woocommerce_store_phone');
	}
}
