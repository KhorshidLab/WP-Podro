<?php
namespace WP_PODRO\Engine\API\V1;

use WP_Encryption\Encryption;
use WP_PODRO\Engine\API\V1\Request_Podro;
use WP_PODRO\Engine\API\V1\Routes;

class Auth {
	public function Login(string $email, string $password) {

		$data = array(
			'email' => $email,
			'password' => (new Encryption)->decrypt( $password ),
		);
		$response = Request_Podro::post( Routes::LOGIN, json_encode( $data ) );

		if (is_wp_error($response) || !isset($response->body) ) {
			return false;
        }

		$res = json_decode($response->body, true);
		if ( ( isset($response->body) && isset($res['title']) && $res['title'] == 'UnauthorizedException' ) ) {
			return false;
		}

		$res['status_code'] = $response->status_code;
		return $res;
	}
}
