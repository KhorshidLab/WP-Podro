<?php
namespace WP_PODRO\Engine\API\V1;
use WP_PODRO\Engine\API\V1\Routes;
use WP_Encryption\Encryption;

class Providers {
	public function get_providers( $params = null ) {

		$response = Request_Podro::post( Routes::DELIVERY_OPTIONS, json_encode( $params ) );
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
