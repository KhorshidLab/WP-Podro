<?php
namespace WP_PODRO\Engine\API\V1;


class Routes
{
	const BASE_URL = 'https://portal.podro.com/api/v1';
    const LOGIN = '/login';
    const PROVINCES  = '/provinces';
    const CITIES  = '/cities';
    const DELIVERY_OPTIONS  = '/delivery-options';

    const ORDER_STATUS  = '/order/order_id/state';
    const ORDER_PDF  = '/orders/order_id/pdf';
    const ORDER_DETAILS  = '/orders/order_id';
    const ORDER_DELETE  = '/orders/order_id';
	const ORDERS = '/orders';
	const ORDER_CREATE = '/orders';
	const ORDER_SUBMIT = '/orders/order_id/finalize';
	const ORDER_PICKUP_DELAY = '/orders/order_id/pickup-delay';

	public static function BuildRoute( string $route, array $params = null )
	{

		$route = str_replace( array_keys( $params ), array_values( $params ), $route );

		return $route;
	}
}
