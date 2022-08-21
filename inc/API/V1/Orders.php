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

	public function get_finalize_order( $order_id ) {
		$url = Routes::BuildRoute( Routes::ORDER_SUBMIT, array( 'order_id' => $order_id ) );

		$response = Request_Podro::get( $url, false );

		if (is_wp_error($response) || !isset($response['body'])) {
            return false;
        }

        $res = json_decode($response['body'], true);
        $res['status_code'] = wp_remote_retrieve_response_code($response);

		return $res;
	}

	public function post_finalize_order( $order_id, $params = null ) {
		$url = Routes::BuildRoute( Routes::ORDER_SUBMIT, array( 'order_id' => $order_id ) );
		$url .= '/';
		$response = Request_Podro::post( $url, json_encode( $params ) );

		if (is_wp_error($response) || !isset($response->body)) {
			return false;
		}
		$res = json_decode($response->body, true);

		return $res;
	}

	public function get_order( $order_id ) {
		$url = Routes::BuildRoute( Routes::ORDER_DETAILS, array( 'order_id' => $order_id ) );
		$response = Request_Podro::get( $url, false );
		if (is_wp_error($response) || !isset($response['body'])) {
            return false;
        }

        $res = json_decode($response['body'], true);
        $res['status_code'] = wp_remote_retrieve_response_code($response);
		return $res;
	}

	public function get_order_pdf( $order_id ) {
		$url = Routes::BuildRoute( Routes::ORDER_PDF, array( 'order_id' => $order_id ) );
		$response = Request_Podro::get( $url, false );
		if (is_wp_error($response) || !isset($response['body'])) {
			return false;
		}
		return $response;
	}

	public function delete_order( $order_id ) {
		$url = Routes::BuildRoute( Routes::ORDER_DELETE, array( 'order_id' => $order_id ) );
		$response = Request_Podro::delete( $url, false );
		if (is_wp_error($response) || !isset($response->body)) {
			return false;
		}
		return $response;
	}
}
