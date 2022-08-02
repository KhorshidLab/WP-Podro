<?php
namespace WP_PODRO\Engine\API\V1;
use WP_PODRO\Engine\API\V1\Routes;

class Orders {
	public function submit_order( $params = null ) {

		$response = Request_Podro::post( Routes::ORDER_CREATE, json_encode( $params ) );
		if (is_wp_error($response) || !isset($response->body) ) {
			return false;
        }

		$res = json_decode($response->body, true);
		if ( ( isset($response->body) && isset($res['title']) && $res['title'] == 'UnauthorizedException' ) ) {
			return false;
		}
		return $res;
	}

	public function finalize_order( $order_id ) {
		$url = Routes::BuildRoute( Routes::ORDER_SUBMIT, array( 'order_id' => $order_id ) );

		$response = Request_Podro::get( $url );

		return $response;
	}
}
