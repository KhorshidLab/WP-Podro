<?php

namespace WP_PODRO\Engine;

class WooZones
{

	private static $instance;

	public function __construct(){

	}

	public static function get_instance(){
		if( null == self::$instance ){
			self::$instance = new WooZones();
		}
		return self::$instance;
	}

	public function get_active_zones() {
		$active_zones   = array();
		if( class_exists( 'WC_Shipping_Zones' ) ) {
			$active_zones = \WC_Shipping_Zones::get_zones();
		}
		return $active_zones;
	}

	public function get_zones_active_methods(){
		$zones = $this->get_active_zones();
		$active_methods = [];
		foreach($zones as $zone){
			$methods = $zone['shipping_methods'];

			foreach($methods as $method){
				if( 'yes' == $method->enabled){
					$active_methods[] = $method;
				}
			}
		}
		return $active_methods;
	}

	public function is_podro_only_active_method(){
		$methods = $this->get_zones_active_methods();
		if( count($methods) != 1 )
			return false;

		if( 'podro_method' == $methods[0]->id)
			return true;

		return false;
	}


}
