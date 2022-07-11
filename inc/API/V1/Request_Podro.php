<?php
namespace WP_PODRO\Engine\API\V1;
use WP_Encryption\Encryption;

class Request_Podro
{

	private static function get_headers(?string $api_key): array
    {
        $api_key = (new Encryption)->decrypt($api_key == null ? get_option('podro_api_key') : $api_key);

		if ($api_key == null) {
			return [
				'Accept' => 'application/json',
				'Content-Type' => 'application/json',
			];
		}

        $api_key = 'Apikey ' . (substr($api_key, 0, 6) == 'Apikey' || substr($api_key, 0, 6) == 'apikey' ? substr($api_key, 6) : $api_key);
        $headers = array(
            'Authorization' => $api_key,
            'Content-Type' => 'application/json',
        );
        return $headers;
    }

	private static function validate_get_response($response)
    {
        if (is_wp_error($response) || !isset($response['body'])) {
            return false;
        }

        $res = json_decode($response['body'], true)['data'];
        $res['status_code'] = wp_remote_retrieve_response_code($response);

        return $res;
    }

	    /**
     * Send Get request to Podro
     *
     * @param string $endpoint
     * @param bool $should_validate
     * @param string|null $api_key
     * @return false|mixed
     */
	public static function get(string $endpoint = 'login/', $should_validate = true, string $api_key = null )
    {

		$args = ['headers' => self::get_headers($api_key)];
        $response = wp_remote_get( Routes::BASE_URL . $endpoint, $args );

		return $should_validate ? self::validate_get_response($response) : $response;

	}

	public static function post(string $endpoint = 'login/', string $data, string $api_key = null)
    {

		$headers = self::get_headers($api_key);
        $response = \Requests::post( Routes::BASE_URL . $endpoint, $headers, $data );

		return $response;

	}

	public static function patch(string $endpoint, string $new_cache_setting, string $api_key = null)
    {

		$headers = self::get_headers($api_key);
		$url = Routes::BASE_URL . $endpoint;

		return \Requests::patch( $url,  $headers,  $new_cache_setting );

    }

	public static function delete(string $endpoint, string $api_key = null)
    {

        $headers = self::get_headers($api_key);

        $url = Routes::BASE_URL . $endpoint;
		return \Requests::delete( $url,  $headers);

    }

}
