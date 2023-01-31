<?php
namespace WP_PODRO\Engine;

use WP_PODRO\Engine\API\V1\Orders;
use WP_PODRO\Engine\API\V1\Payments;
use WP_PODRO\Engine\API\V1\Providers;
use WP_Encryption\Encryption;

class MetaBox {
	private $address_length = 185;
	private $name_length = 17;
	private $family_length = 27;
	private $store_name_length = 60;
	private $comment_length = 60;
	private $origin = 'WORDPRESS_PLUGIN';
	public function add_meta_boxes () {

		if ( get_post_type() == 'shop_order' && isset( $_GET[ 'post' ] ) ) {
			$order_id = intval( $_GET[ 'post' ] );
			$order = \wc_get_order($order_id);

			if ( !$order->has_shipping_method('podro_method') ) {
				return;
			}
			if ( $this->has_podro_order( $order_id ) ) {
				add_meta_box(
					'woocommerce-order-podro',
					__( 'جزئیات سفارش پادرو', 'podro-wp' ),
					array($this, 'pod_order_details'),
					'shop_order',
					'side',
					'default'
				);
			} else {
				add_meta_box(
					'woocommerce-order-podro',
					__( 'پادرو', 'podro-wp' ),
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
		$order_id = intval($_GET[ 'post' ]);

		$response = (new Orders)->get_order( $pod_order_id );

		if ( !$response ) {
			echo '<p>' . esc_html__( 'هیچ سفارش پادرویی یافت نشد!', 'podro-wp' ) . '</p>';
			return;
		}

		$pickup_time = new \DateTime( $response['pickup_time'], new \DateTimeZone( wp_timezone_string() ) );
		$pickup_time_S = (new SDate)->gregorian_to_jalali( $pickup_time->format('Y-m-d') );

		?>

		<table class="pod_order_details">
			<tr>
				<th><?php esc_html_e( 'شناسه سفارش', 'podro-wp' ); ?></th>
				<td><?php echo esc_html($pod_order_id); ?></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'کد پیگیری سفارش', 'podro-wp' ); ?></th>
				<td><?php echo esc_html($response['order_detail']['tracking_id']); ?></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'پروایدر', 'podro-wp' ); ?></th>
				<td><?php echo esc_html($response['provider_code']); ?></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'وضعیت سفارش', 'podro-wp' ); ?></th>
				<td><?php echo esc_html($response['status']); ?></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'جمع‌آوری از', 'podro-wp' ); ?></th>
				<td><?php echo esc_html($pickup_time_S . ' ' . $pickup_time->format('H:i')); ?></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'جمع‌آوری تا', 'podro-wp' ); ?></th>
				<td><?php echo esc_html($response['pickup_to_time']); ?></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'هزینه ارسال', 'podro-wp' ); ?></th>
				<td><?php echo esc_html($response['sale_price']); ?></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'تخفیف', 'podro-wp' ); ?></th>
				<td><?php echo esc_html($response['discount']); ?></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'وزن', 'podro-wp' ); ?></th>
				<td><?php echo esc_html($response['order_detail']['parcel_total']['total_weight']); ?></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'ارزش مرسوله', 'podro-wp' ); ?></th>
				<td><?php echo esc_html($response['order_detail']['parcel_total']['total_value']); ?></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'فایل بارنامه', 'podro-wp' ); ?></th>
				<td><a id="get_order_pdf" data-order_id="<?php echo esc_attr($response['id']) ?>"><?php esc_html_e( 'دانلود بارنامه', 'podro-wp' ); ?></a></td>
			</tr>
		</table>
		<div id="lock-modal"></div>
		<div id="loading-circle"></div>

		<?php


	}

	public function order_my_custom() {
		$order_id = intval( $_GET[ 'post' ] );
		$order = \wc_get_order($order_id);

		$payment = Payments::get_instance();
		$status = $payment->check_payment_status();

		if(( true == $status ) && $status !== 'payment_failed'){
			$this->payment_success_form();
		}else {
			$this->delivery_step_1( $order );
		}
	}

	public function payment_success_form(){


		if( !isset($_GET['post']) )
			return;
		$post_id = absint($_GET['post']);

		if(!isset($_GET['orderId']))
			return;

		$order_id = sanitize_text_field($_GET['orderId']);

		echo '<h3 style="color: green">ثبت سفارش با موفقیت انجام شد</h3>';
		update_post_meta( $post_id, 'pod_order_id', $order_id );
	}

	public function get_store_state() {
		$state = get_option( 'woocommerce_default_country' );
		$state = explode( ':', $state );
		return $state[1];
	}

	public function delivery_step_1( $order ) {

		$woo_setting = WooSetting::get_instance();


		$order_id = $order->get_id();
		$destination_city_code = $order->get_shipping_city();

		$method = $order->get_items( 'shipping' );

		$destination_city_code = $woo_setting->get_city_by_name($destination_city_code);

		$destination_city_name = (WooSetting::get_instance())->get_cities()[$destination_city_code];
		$destination_address = $destination_city_name . ' ' . $order->get_billing_address_1() . ' ' . $order->get_billing_address_2();
		if( mb_strlen($destination_address) > $this->address_length )
			$destination_address = mb_substr($destination_address, 0, $this->address_length);


		$pod_source_city_code = $woo_setting->get_store_city_code_from_options();
		$pod_store_address =  mb_substr( $woo_setting->get_store_address() , 0 , $this->address_length) ;
		$pod_store_name =  mb_substr( $woo_setting->get_store_name(), 0, $this->store_name_length );

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
			$width = !empty($product->get_width()) ? $product->get_width() : 1;
			$height = !empty($product->get_height()) ? $product->get_height() : 1;
			$length = !empty($product->get_length()) ? $product->get_length() : 1;

		// For variable products (we keep the default formatted dimensions)
		} else if ( $display_dimensions && $product->has_dimensions() && $product->is_type('variable') ) {
			$dimensions = $product->get_dimensions( false );
			$width = $dimensions['width']??1;
			$height = $dimensions['height']??1;
			$length = $dimensions['length']??1;
		}

		$user_billing_name = $order->get_billing_first_name();
		$user_billing_family = $order->get_billing_last_name();

		$customer_note = $order->get_customer_note();
		?>
		<ul class="pod-delivery-step">
			<li>
				<?php
				$payment = Payments::get_instance();
				$status = $payment->check_payment_status();

				if( 'payment_failed' == $status )
					echo "<p style='color: red;'>پرداخت ناموفق بود</p>";
				?>
				<label for="pod_store_name">نام فروشگاه</label>
				<input type="text" name="pod_store_name" id="pod_store_name" maxlength="60" value="<?php echo esc_attr($pod_store_name); ?>"  />
			</li>
			<li>
				<label for="podro_store_city">شهر مبدا</label>
				<?php
				$provinces = \WP_PODRO\Engine\WooSetting::get_provinces();
				echo "<select  id='podro_store_city' name='podro_store_city'  required>";
				echo "<option value='' selected disabled hidden>لطفا شهر فروشگاه را انتخاب کنید.</option>";
				foreach ($provinces as $province) {
					echo "<optgroup label='" . esc_attr($province['name']) . "'>";
					foreach ($province['cities'] as $key => $city)
						if ($pod_source_city_code == $key)
							echo "<option selected value='" . esc_attr($key) . "'>" . esc_attr($city) . "</option>";
						else
							echo "<option value='" . esc_attr($key) . "'>" . esc_attr($city) . "</option>";
					echo "</optgroup>";
				}
				echo "</select>"
				?>
			</li>
			<script>
				jQuery(document).ready(function(){
					jQuery('#podro_store_city').select2();
				});
			</script>
			<li>
				<label for="pod_source_city">آدرس مبدا</label>
				<textarea name="pod_source_city" id="pod_source_city" rows="6"><?php echo esc_attr($pod_store_address); ?></textarea>
				<?php if (empty($pod_store_address)) echo '<p style="color:red">'. esc_html__('لطفا آدرس فروشگاه را از تنظیمات ووکامرس وارد کنید.', 'podro-wp') .'</p>' ; ?>
				<input type="hidden" id="pod_source_city_code" name="pod_source_city_code" value="<?php echo esc_attr($pod_source_city_code); ?>">
			</li>
			<li>
				<label for="pod_destination_city">مقصد</label>
				<?php if( !WooSetting::is_podro_city($destination_city_code) ){ ?>
				<span style="color:red">این شهر پادرویی نیست</span>
				<?php } ?>
				<textarea name="pod_destination_city" id="pod_destination_city" rows="6" maxlength="186"><?php echo esc_attr($destination_address); ?></textarea>
				<input type="hidden" id="pod_destination_city_code" name="pod_destination_city_code" value="<?php echo esc_attr($destination_city_code); ?>">
			</li>
			<li>
				<label for="pod_user_billing_name">نام </label>
				<input type="text" name="pod_user_billing_name" id="pod_user_billing_name" maxlength="17" value="<?php echo esc_attr($user_billing_name); ?>"  />
			</li>
			<li>
				<label for="pod_user_billing_family"> نام خانوادگی</label>
				<input type="text" name="pod_user_billing_family" id="pod_user_billing_family" maxlength="27" value="<?php echo esc_attr($user_billing_family); ?>"  />
			</li>
			<li>
				<label for="pod_comment">توضیحات<span id="pod-description-hint" class="dashicons dashicons-editor-help" style="width:50px"></span></label>
				<textarea name="pod_customer_note" id="pod_customer_note" rows="6" maxlength="60"><?php echo esc_attr($customer_note); ?></textarea>
			</li>
			<li>
				<label for="pod_weight">وزن مرسوله به گرم</label>
				<input type="number" name="pod_weight" id="pod_weight" min="1" value="<?php echo esc_attr($total_weight); ?>" />
			</li>
			<li>
				<label for="pod_totalprice">ارزش مرسوله</label>
				<input type="number" name="pod_totalprice" id="pod_totalprice" value="<?php echo esc_attr($order->get_subtotal()); ?>" />
			</li>
			<li class="pod-dimension">
				<p>ابعاد به سانتی‌متر</p>
				<div>
					<label for="pod_width">طول</label>
					<input type="number" name="pod_width" id="pod_width" min="1" value="<?php echo esc_attr($length); ?>" />
				</div>
				<div>
					<label for="pod_depth">عرض</label>
					<input type="number" name="pod_depth" id="pod_depth" min="1" value="<?php echo esc_attr($width); ?>" />
				</div>
				<div>
					<label for="pod_height">ارتفاع</label>
					<input type="number" name="pod_height" id="pod_height" min="1" value="<?php echo esc_attr($height); ?>" />
				</div>
			</li>

		</ul>

		<input type="hidden" name="pod_order_id" value="<?php echo esc_attr($order_id); ?>">

		<p style="color:red; text-align:center" id="none-podro-holder"><?php echo isset($_GET['unknownerror']) ? esc_html('خطایی رخ داد', 'podro-wp') : ''; ?></p>

		<button class="pod-delivery-step-button pod-delivery-step-1" ><?php esc_html_e('مرحله بعد', 'podro-wp') ?></button>

		<div id="lock-modal"></div>
		<div id="loading-circle"></div>
		<?php
	}

	public function ajax_saving_options_step_1() {

		// checking for nonce
		$this->validate_nonce( 'pod-options-nonce' );

		$pod_store_name = mb_substr(sanitize_text_field($_POST['pod_store_name']?? ''), 0, $this->store_name_length);
		$pod_store_city	= sanitize_text_field($_POST['podro_store_city']??'');
		$pod_source_city = mb_substr(sanitize_text_field($_POST['pod_source_city']?? ''), 0, $this->address_length);
		$pod_destination_city = mb_substr(sanitize_text_field($_POST['pod_destination_city']?? ''), 0, $this->address_length);
		$pod_user_billing_name = mb_substr(sanitize_text_field($_POST['pod_user_billing_name']?? ''), 0, $this->name_length);
		$pod_user_billing_family = mb_substr(sanitize_text_field($_POST['pod_user_billing_family']?? ''), 0, $this->family_length);
		$pod_customer_note = mb_substr(sanitize_text_field($_POST['pod_customer_note']), 0, $this->comment_length);
		$pod_source_city_code = sanitize_text_field($_POST['pod_source_city_code']?? '');
		$pod_destination_city_code = sanitize_text_field($_POST['pod_destination_city_code']?? '');
		update_option('pod_store_name', $pod_store_name);
		update_option('podro_store_city', $pod_store_city);
		update_option('pod_source_city', $pod_source_city);
		update_option('pod_destination_city',$pod_destination_city);
		update_option('pod_user_billing_name',$pod_user_billing_name);
		update_option('pod_user_billing_family',$pod_user_billing_family);
		update_option('pod_customer_note',$pod_customer_note);

		update_option('pod_source_city_code', $pod_source_city_code);
		update_option('pod_destination_city_code',$pod_destination_city_code);



		if (! isset($_POST['weight']) && ! isset($_POST['totalprice']) && ! isset($_POST['width']) && ! isset($_POST['height']) && ! isset($_POST['depth'])) {

			wp_send_json_error( __('آیتم اشتباه شده است.', 'podro-wp'), 400 );
			wp_die();

		}

		$weight = 	$_POST['weight'] ?? 0;
		$width =	$_POST['width'] ?? 0;
		$height =	$_POST['height'] ?? 0;
		$depth =	$_POST['depth'] ?? 0;


		if(empty($weight) || empty($width) || empty($height) || empty($depth) ||
				( $weight 	<=0 || $weight 	> (40 * 1000) ) ||
				( $width	<=0 || $width	> 55 ) ||
				( $height	<=0 || $height	> 35 ) ||
				( $depth	<=0 || $depth	> 45 )
		){

			wp_send_json_error( __('وزن یا ابعاد اشتباه است', 'podro-wp'), 200 );
			wp_die();

		}


		$order_id = sanitize_text_field($_POST['order_id']);
		$order = \wc_get_order($order_id);

		$store_state = $this->get_store_state();


		$data = [
			'source_city' => $pod_source_city_code,
			'destination_city' => $pod_destination_city_code,
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

			wp_send_json_error( __('آیتم اشتباه شده است.', 'podro-wp'), 400 );
			wp_die();

		}

		$order_id = sanitize_text_field($_POST['order_id']);
		$order = \wc_get_order($order_id);

		$source_city = (WooSetting::get_instance())->get_store_city_code_from_options();

		$destination_city_code = get_option('pod_destination_city_code');

		$pod_store_name = get_option('pod_store_name');
		$pod_user_billing_name = get_option('pod_user_billing_name') . ' ' . get_option('pod_user_billing_family');
		$pod_customer_note = get_option('pod_customer_note');
		$pod_source_city = get_option('pod_source_city');
		$pod_destination_city = get_option('pod_destination_city');
		$data = [
			'sender' => [
				'name' => $pod_store_name,
				'contact' => [
					'postal_code' => $this->get_store_postal_code(),
					'address' => $pod_source_city,
					'city' => $source_city,
					'phone_number' => $this->get_store_phone_number(),
				],
			],
			'receiver' => [
					'name' => $pod_user_billing_name,
				'contact' => [
					'postal_code' => $order->get_shipping_postcode(),
					'address' => $pod_destination_city,
					'city' => $destination_city_code,
					'phone_number' => $order->get_billing_phone(),
				],
			],
			'parcels' => [
				[
					'id' => $order_id,
					'weight' => sanitize_text_field( $_POST['weight'] ),
					'value' => sanitize_text_field( $_POST['totalprice'] ),
					'content' => mb_substr($this->get_products_name_by_order_id($order_id),0,50),
					'dimension' => [
						'width' => sanitize_text_field( $_POST['width'] ),
						'height' => sanitize_text_field( $_POST['height'] ),
						'depth' => sanitize_text_field( $_POST['depth'] )
					]
				]
			],
			'payment_type' => 1,
			'receiver_comment' => $pod_customer_note,
			'service_type' => 'regular',
			'provider_code' => sanitize_text_field( $_POST['provider_code'] ),
			'origin' => $this->origin,
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
			wp_send_json_error( __('آیتم اشتباه شده است.', 'podro-wp'), 400 );
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
			wp_send_json_error( __('آیتم اشتباه شده است.', 'podro-wp'), 400 );
			wp_die();
		}

		$order_id = sanitize_text_field( $_POST['delivery_order_id'] );
		$post_id = sanitize_text_field( $_POST['pod_order_id'] );
		$pod_customer_note = get_option('pod_customer_note');
		$params = array(
			'option_id' => sanitize_text_field( $_POST['option_id'] ),
			'pickup_date' => sanitize_text_field( $_POST['pickup_date'] ),
			'payment_approach' => sanitize_text_field( $_POST['payment_approach'] ),
			'comment' => $pod_customer_note,
		);


		if ( isset($_POST['delivery_date']) ) {
			$params['delivery_date'] = sanitize_text_field( $_POST['delivery_date'] );
			$params['delivery_option_id'] = sanitize_text_field( $_POST['delivery_option_id'] );
		}


		if( 'PASARGAD' == $_POST['payment_approach'] || 'POD' == $_POST['payment_approach']){

			$params['redirect_url'] = admin_url('/post.php?post='. $post_id . '&action=edit&paymentredirect=true');

			$response = (new Orders)->post_finalize_order( $order_id, $params );

			if ( !$response || is_wp_error($response) ) {
				wp_send_json_error( $response['message'], 403 );
				wp_die();
			}


			wp_send_json_success( $response );
			wp_die();

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

			wp_send_json_error( __('توکن امنیتی اشتباه است.', 'podro-wp' ), 403 );
			wp_die();

		}
	}

	private function get_store_name() {
		return get_bloginfo('name');
	}

	public function get_products_name_by_order_id( $order_id ) {
		$order = \wc_get_order($order_id);
		$items = $order->get_items();
		$item = reset($items);
		if(!$item)
			return '';
		$title = $item->get_name();
		return str_replace(array(',',':',';','\'','.','"'), '', $title);
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
			wp_send_json_error( __('آیتم اشتباه شده است.', 'podro-wp'), 400 );
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
