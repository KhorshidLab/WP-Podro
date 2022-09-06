<?php
namespace WP_PODRO\Engine;

use WP_PODRO\Engine\API\V1\Orders;
use WP_PODRO\Engine\API\V1\Providers;
use WP_Encryption\Encryption;

class MetaBox {
	public function add_meta_boxes () {

		if ( get_post_type() == 'shop_order' && isset( $_GET[ 'post' ] ) ) {
			$order_id = $_GET[ 'post' ];
			$order = \wc_get_order($order_id);

			if ( !$order->has_shipping_method('podro_method') ) {
				return;
			}
			if ( $this->has_podro_order( $order_id ) ) {
				add_meta_box(
					'woocommerce-order-podro',
					__( 'جزئیات سفارش پادرو', POD_TEXTDOMAIN ),
					array($this, 'pod_order_details'),
					'shop_order',
					'side',
					'default'
				);
			} else {
				add_meta_box(
					'woocommerce-order-podro',
					__( 'پادرو', POD_TEXTDOMAIN ),
					array($this, 'order_my_custom'),
					'shop_order',
					'side',
					'default'
				);
			}
		}
	}

	public function has_podro_order( $order_id ) {
		return !empty( get_post_meta( $order_id, 'pod_order_id', true ) );
	}

	public function pod_order_details () {
		$pod_order_id = get_post_meta( get_the_ID(), 'pod_order_id', true );
		$order_id = $_GET[ 'post' ];

		$response = (new Orders)->get_order( $pod_order_id );

		if ( !$response ) {
			echo '<p>' . __( 'هیچ سفارش پادرویی یافت نشد!', POD_TEXTDOMAIN ) . '</p>';
			return;
		}

		$pickup_time = new \DateTime( $response['pickup_time'] );
		$pickup_time_S = (new SDate)->toShaDate( $pickup_time->format('Y-m-d') );

		?>

		<table class="pod_order_details">
			<tr>
				<th><?php _e( 'شناسه سفارش', POD_TEXTDOMAIN ); ?></th>
				<td><?php echo $pod_order_id; ?></td>
			</tr>
			<tr>
				<th><?php _e( 'کد پیگیری سفارش', POD_TEXTDOMAIN ); ?></th>
				<td><?php echo $response['order_detail']['tracking_id']; ?></td>
			</tr>
			<tr>
				<th><?php _e( 'پروایدر', POD_TEXTDOMAIN ); ?></th>
				<td><?php echo $response['provider_code']; ?></td>
			</tr>
			<tr>
				<th><?php _e( 'وضعیت سفارش', POD_TEXTDOMAIN ); ?></th>
				<td><?php echo $response['status']; ?></td>
			</tr>
			<tr>
				<th><?php _e( 'پیکاپ از', POD_TEXTDOMAIN ); ?></th>
				<td><?php echo $pickup_time_S . ' ' . $pickup_time->format('H:i') ?></td>
			</tr>
			<tr>
				<th><?php _e( 'پیکاپ تا', POD_TEXTDOMAIN ); ?></th>
				<td><?php echo $response['pickup_to_time']; ?></td>
			</tr>
			<tr>
				<th><?php _e( 'هزینه ارسال', POD_TEXTDOMAIN ); ?></th>
				<td><?php echo $response['sale_price']; ?></td>
			</tr>
			<tr>
				<th><?php _e( 'تخفیف', POD_TEXTDOMAIN ); ?></th>
				<td><?php echo $response['discount']; ?></td>
			</tr>
			<tr>
				<th><?php _e( 'وزن', POD_TEXTDOMAIN ); ?></th>
				<td><?php echo $response['order_detail']['parcel_total']['total_weight']; ?></td>
			</tr>
			<tr>
				<th><?php _e( 'ارزش مرسوله', POD_TEXTDOMAIN ); ?></th>
				<td><?php echo $response['order_detail']['parcel_total']['total_value']; ?></td>
			</tr>
			<tr>
				<th><?php _e( 'فایل بارنامه', POD_TEXTDOMAIN ); ?></th>
				<td><a id="get_order_pdf" data-order_id="<?php echo $response['id'] ?>"><?php _e( 'دانلود بارنامه', POD_TEXTDOMAIN ); ?></a></td>
			</tr>
		</table>
		<div id="lock-modal"></div>
		<div id="loading-circle"></div>

		<?php


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
		$destination_address = $destination_city['name'] . ' ' . $order->get_billing_address_1() . ' ' . $order->get_billing_address_2();
		$store_address =  get_option( 'woocommerce_store_address' ) . get_option( 'woocommerce_store_address_2' );

		$total_weight = 0;
		$weight_unit = 1;

		if ( get_option('woocommerce_weight_unit') == 'kg' ) {
			$weight_unit = 1000;
		}

		foreach( $order->get_items() as $item_id => $product_item ){
			$quantity = $product_item->get_quantity(); // get quantity
			$product = $product_item->get_product(); // get the WC_Product object
			$product_weight = $product->get_weight(); // get the product weight
			if ( $product_weight > 0 ) {
				$total_weight += floatval( $product_weight * $weight_unit * $quantity );
			}
		}

		$display_dimensions = get_option( 'woocommerce_dimension_unit' ) == 'cm';
		$width  = 0;
		$height = 0;
		$length = 0;
		// For non variable products (separated dimensions)
		if ( $display_dimensions && $product->has_dimensions() && ! $product->is_type('variable') ) {
			$width = !empty($product->get_width()) ? $product->get_width() : 0;
			$height = !empty($product->get_height()) ? $product->get_height() : 0;
			$length = !empty($product->get_length()) ? $product->get_length() : 0;

		// For variable products (we keep the default formatted dimensions)
		} else if ( $display_dimensions && $product->has_dimensions() && $product->is_type('variable') ) {
			$dimensions = $product->get_dimensions( false );
			$width = $dimensions['width'];
			$height = $dimensions['height'];
			$length = $dimensions['length'];
		}
			?>
		<ul class="pod-delivery-step">
			<li>
				<label for="pod_source_city">مبدا</label>
				<input type="text" name="pod_source_city" id="pod_source_city" value="<?php echo $store_address; ?>" disabled />
				<?php if (empty($store_address)) echo '<p style="color:red">لطفا آدرس فروشگاه را از تنظیمات ووکامرس وارد کنید.</p>'; ?>
				<input type="hidden" name="pod_source_city_code" value="<?php echo $source_city['code']; ?>">
			</li>
			<li>
				<label for="pod_destination_city">مقصد</label>
				<input type="text" name="pod_destination_city" id="pod_destination_city" value="<?php echo $destination_address; ?>" disabled />
				<input type="hidden" name="pod_destination_city_code" value="<?php echo $destination_city['code']; ?>">
			</li>
			<li>
				<label for="pod_weight">وزن مرسوله به گرم</label>
				<input type="number" name="pod_weight" id="pod_weight" value="<?php echo $total_weight; ?>" />
			</li>
			<li>
				<label for="pod_totalprice">ارزش مرسوله</label>
				<input type="number" name="pod_totalprice" id="pod_totalprice" value="<?php echo $order->get_subtotal(); ?>" />
			</li>
			<li class="pod-dimension">
				<p>ابعاد به سانتی‌متر</p>
				<div>
					<label for="pod_width">طول</label>
					<input type="number" name="pod_width" id="pod_width" value="<?php echo $length; ?>" />
				</div>
				<div>
					<label for="pod_depth">عرض</label>
					<input type="number" name="pod_depth" id="pod_depth" value="<?php echo $width; ?>" />
				</div>
				<div>
					<label for="pod_height">ارتفاع</label>
					<input type="number" name="pod_height" id="pod_height" value="<?php echo $height; ?>" />
				</div>
			</li>

		</ul>

		<input type="hidden" name="pod_order_id" value="<?php echo $order_id; ?>">
		<button class="pod-delivery-step-button pod-delivery-step-1">مرحله بعد</button>
		<div id="lock-modal"></div>
		<div id="loading-circle"></div>
		<?php
	}

	public function ajax_saving_options_step_1() {

		// checking for nonce
		$this->validate_nonce( 'pod-options-nonce' );

		if (! isset($_POST['weight']) && ! isset($_POST['totalprice']) && ! isset($_POST['width']) && ! isset($_POST['height']) && ! isset($_POST['depth'])) {

			wp_send_json_error( __('آیتم اشتباه شده است.', POD_TEXTDOMAIN), 400 );
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

			wp_send_json_error( __('آیتم اشتباه شده است.', POD_TEXTDOMAIN), 400 );
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
		$data['provider_name'] = sanitize_text_field( $_POST['provider_name'] );
		$data['provider_delivery_time'] = sanitize_text_field( $_POST['provider_delivery_time'] );

		wp_send_json_success( $data );
		wp_die();

	}

	public function ajax_saving_options_step_3() {

		// checking for nonce
		$this->validate_nonce( 'pod-options-nonce' );

		// checking for required fields
		if ( !isset($_POST['delivery_order_id']) ) {
			wp_send_json_error( __('آیتم اشتباه شده است.', POD_TEXTDOMAIN), 400 );
			wp_die();
		}

		$order_id = sanitize_text_field( $_POST['delivery_order_id'] );

		$response = (new Orders)->get_finalize_order($order_id);

		if ( !$response || is_wp_error($response) ) {
			wp_send_json_error( $response->get_error_message(), 403 );
			wp_die();
		}

		$response['order_id'] = $order_id;

		wp_send_json_success( $response );
		wp_die();
	}

	public function ajax_saving_options_step_4() {
		// checking for nonce
		$this->validate_nonce( 'pod-options-nonce' );

		// checking for required fields
		if ( !isset($_POST['delivery_order_id']) ) {
			wp_send_json_error( __('آیتم اشتباه شده است.', POD_TEXTDOMAIN), 400 );
			wp_die();
		}

		$order_id = sanitize_text_field( $_POST['delivery_order_id'] );
		$post_id = sanitize_text_field( $_POST['pod_order_id'] );

		$params = array(
			'option_id' => sanitize_text_field( $_POST['option_id'] ),
			'pickup_date' => sanitize_text_field( $_POST['pickup_date'] ),
			'payment_approach' => sanitize_text_field( $_POST['payment_approach'] ),
			'comment' => 'data',
		);

		if ( isset($_POST['delivery_date']) ) {
			$params['delivery_date'] = sanitize_text_field( $_POST['delivery_date'] );
			$params['delivery_option_id'] = sanitize_text_field( $_POST['delivery_option_id'] );
		}

		$response = (new Orders)->post_finalize_order( $order_id, $params );

		if ( !$response || is_wp_error($response) ) {
			wp_send_json_error( $response['message'], 403 );
			wp_die();
		}


		update_post_meta( $post_id, 'pod_order_id', $order_id );
		wp_send_json_success( $response );
		wp_die();
	}

	public function ajax_get_token() {
		// checking for nonce
		$this->validate_nonce( 'pod-options-nonce' );

		$api_key = (new Encryption)->decrypt(get_option('podro_api_key'));

		$data = array(
			'token' => $api_key,
			'order_id' => sanitize_text_field( $_POST['order_id'] ),
		);

		wp_send_json_success( $data );
		wp_die();
	}

	public function validate_nonce( $nonce_key ) {
		if ( ! check_ajax_referer( $nonce_key, 'security', false ) ) {

			wp_send_json_error( __('توکن امنیتی اشتباه است.', POD_TEXTDOMAIN ), 403 );
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

	public function ajax_cancel_order() {
		// checking for nonce
		$this->validate_nonce( 'pod-options-nonce' );
		// checking for required fields
		if ( !isset($_POST['order_id']) ) {
			wp_send_json_error( __('آیتم اشتباه شده است.', POD_TEXTDOMAIN), 400 );
			wp_die();
		}

		$order_id = sanitize_text_field( $_POST['order_id'] );

		$response = (new Orders)->delete_order( $order_id);

		if ( !$response || is_wp_error($response) ) {
			wp_send_json_error( $response['message'], 403 );
			wp_die();
		}


		wp_send_json_success( $response );
		wp_die();
}
}
