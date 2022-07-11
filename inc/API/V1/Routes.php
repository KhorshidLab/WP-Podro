<?php
namespace WP_PODRO\Engine\API\V1;


class Routes
{
	const BASE_URL = 'https://portal.podro.com/api/v1';
    const LOGIN = '/login';

	public static function BuildRoute( string $route, array $params = null )
	{

		$route = str_replace( array_keys( $params ), array_values( $params ), $route );

		return $route;
	}
}
