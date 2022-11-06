<?php

namespace WP_PODRO\Engine\API\V1;

class Payments
{
	public static $instance;

	public function get_instance(){
		if(!self::$instance)
			self::$instance = new Payments();
		return self::$instance;
	}

	public function echo_payments(){

		$order_id = $_POST['delivery_order_id'] ?? 0;

		$payment_methods = $this->get_payments($order_id);
		if($payment_methods)
			wp_send_json($payment_methods);
		else
			wp_send_json_error( json_encode( array(
				'data'=>'Error'
			) ) );
		wp_die();
	}

	public function get_payments( $order_id = null ) {

		$url = Routes::BuildRoute( Routes::PAYMENT_OPTIONS, array( 'order_id' => $order_id ) );

		$response = Request_Podro::get( $url, false);

		if( is_wp_error($response) )
			return false;
		$body = $response['body'] ?? false;

		if (is_wp_error($response) || !is_array(json_decode($body)) ) {
			return false;
		}

		return $body;

	}

	public function request_register_payment_method(){

	}
}
