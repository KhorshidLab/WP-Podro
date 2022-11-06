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

	public function get_payments( $order_id = null ) {

		$url = Routes::BuildRoute( Routes::PAYMENT_OPTIONS, array( 'order_id' => $order_id ) );
		$response = Request_Podro::get( $url);
		if (is_wp_error($response) || !isset($response->body) ) {
			return false;
		}

		$res = json_decode($response->body, true);
		if ( ( isset($response->body) && isset($res['title']) && $res['title'] == 'UnauthorizedException' ) ) {
			return false;
		}
		return $res;
	}
}
