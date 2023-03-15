<?php

namespace WP_PODRO\Engine;

use WP_PODRO\Engine\API\V1\Request_Podro;

class WooSetting
{
	private static $instance;
	public function __construct(){
		add_filter( 'woocommerce_general_settings' , [$this,'change_default_city_filed'] );
	}

	public static function get_instance(){
		if( null == self::$instance ){
			self::$instance = new WooSetting();
		}
		//self::generate_cities();
		//self::generate_source_cities();
		return self::$instance;

	}
	public function change_default_city_filed($general_fields){

		$city_fields = array(
			'title'    => __( 'City', 'woocommerce' ),
			'desc'     => __( 'The city in which your business is located.', 'woocommerce' ),
			'id'       => 'woocommerce_store_city',
			'default'  => '',
			'type'     => 'select',
			'desc_tip' => true,
			'options'  => self::get_podro_destination_only_cities_from_file(),
		);

		$general_fields[3] = $city_fields;
		return $general_fields;
	}

	public static function get_extended_provinces(){
		return [
			'EAZ'=>'آذربایجان شرقی',
			'WAZ'=>"آذربایجان غربی",
			'ADL'=>"اردبیل",
			'ESF'=>"اصفهان",
			'ABZ'=>"البرز",
			'ILM'=>"ایلام",
			'BHR'=>"بوشهر",
			'THR'=>"تهران",
			'CHB'=>"چهار محال بختیاری",
			'SKH'=>"خراسان جنوبی",
			'RKH'=>"خراسان رضوی",
			'NKH'=>"خراسان شمالی",
			'KHZ'=>"خوزستان",
			'ZJN'=>"زنجان",
			'SMN'=>"سمنان",
			'SBN'=>"سیستان و بلوچستان",
			'FRS'=>"فارس",
			'GZN'=>"قزوین",
			'QHM'=>"قم",
			'KRD'=>"کردستان",
			'KRN'=>"کرمان",
			'KRH'=>"کرمانشاه",
			'KBD'=>"کهگیلویه و بویراحمد",
			'GLS'=>"گلستان",
			'GIL'=>"گیلان",
			'LRS'=>"لرستان",
			'MZN'=>"مازندران",
			'MKZ'=>"مرکزی",
			'HRZ'=>"هرمزگان",
			'HDN'=>"همدان",
			'YZD'=>"یزد",
		];
	}
	public static function generate_source_cities(){
		$provinces = self::get_extended_provinces();
		$lines = file(dirname(dirname(__FILE__)) . '/cities/podro-source.csv' );
		//$lines = Request_Podro::get('/provinces/1/cities');
		$cities_code = [];
		foreach($lines as $line){
			$cities_code[] = trim(explode(',',$line)[1]);
		}

		$row = '';
		foreach($provinces as $province){
			$lines = Request_Podro::get("/provinces/{$province['id']}/cities");
			foreach($lines as $line){

				if(!$line['code'] == false && (!$line['name'] == false) && in_array($line['code'], $cities_code))
					$row .= "{$line['code']},{$line['name']},{$province['id']},{$province['code']},{$province['name']}\n";
			}
		}


		file_put_contents((dirname(__FILE__,2)) . '/cities/source_temp.txt', $row);
	}

	public static function generate_destination_cities(){
		$provinces = self::get_extended_provinces();

		//$lines = Request_Podro::get('/provinces/1/cities');
		$row = '';
		foreach($provinces as $province){
			$lines = Request_Podro::get("/provinces/{$province['id']}/cities");
			foreach($lines as $line){

				if(!$line['code'] == false && (!$line['name'] == false))
					$row .= "{$line['code']},{$line['name']},{$province['id']},{$province['code']},{$province['name']}\n";
			}
		}


		file_put_contents((dirname(__FILE__,2)) . '/cities/temp.txt', $row);
	}

	public static function get_extended_mixed_cities(){
		$provinces_list = self::get_extended_provinces();

		$persian_woocommerce = file(dirname(dirname(__FILE__)) . '/cities/persian-woocommerce.csv' );
		$woocommerce_shipping = file(dirname(dirname(__FILE__)) . '/cities/woocommerce-shipping.csv' );

		$provinces = [];
		foreach($provinces_list as $province_key => $value){

			$provinces[$province_key] = [];
		}
		/*
		 * Each line consist array[
		 * '3741','0001', 'arak-podro' , '28', 'arak-persianwoo', 'markazi'
		 * ]
		 */
		foreach($persian_woocommerce as $line){
			$city = explode(',', $line);
			$city[0] = trim($city[0]);
			$city[1] = trim($city[1]);
			$city[2] = trim($city[2]);
			$city[3] = trim($city[3]);
			$city[4] = trim($city[4]);
			$city[5] = trim($city[5]);
			$city[6] = trim($city[6]);
			$city[7] = trim($city[7]);
			$provinces[trim($city[6])]['code'] = $city[6];
			$provinces[trim($city[6])]['name'] = $city[5];
			$provinces[trim($city[6])]['cities'][$city[4]] = $city[1];
			/*
			 * ['EAZ'] = [
			 *
			 * 	'name'=>'EAST Azerbayjan',
			 * 	'cities' => [
			 * 		'0001'=>'x1',
			 * 		'0002'=>'x2'
			 * 	]
			 *
			 * ]
			 */
		}
		foreach($woocommerce_shipping as $line){
			$city = explode(',', $line);
			$city[0] = trim($city[0]);
			$city[1] = trim($city[1]);
			$city[2] = trim($city[2]);
			$city[3] = trim($city[3]);
			$city[4] = trim($city[4]);
			$city[5] = trim($city[5]);
			$city[6] = trim($city[6]);
			$city[7] = trim($city[7]);


			$provinces[trim($city[6])]['code'] = $city[6];
			$provinces[trim($city[6])]['name'] = $city[5];
			$provinces[trim($city[6])]['cities'][$city[4]] = $city[1];
			/*
			 * ['EAZ'] = [
			 *
			 * 	'name'=>'EAST Azerbayjan',
			 * 	'cities' => [
			 * 		'0001'=>'x1',
			 * 		'0002'=>'x2'
			 * 	]
			 *
			 * ]
			 */
		}

		return $provinces;
	}


	public static function get_podro_source_cities_from_file(){
		$lines = file(dirname(dirname(__FILE__)) . '/cities/podro-source.csv' );

		$cities = [];
		foreach($lines as $line){
			$city = explode(',', $line);
			$cities[trim($city[3])]['name'] =  trim($city[4]);
			$cities[trim($city[3])]['cities'][$city[0]] =  trim($city[1]);
		}
		return $cities;
	}

	public static function get_podro_destination_province_and_cities_from_file(){
		$lines = file(dirname(dirname(__FILE__)) . '/cities/podro-destination.csv' );

		$cities = [];
		foreach($lines as $line){
			$city = explode(',', $line);

			$cities[trim($city[3])]['code'] =  trim($city[3]);
			$cities[trim($city[3])]['name'] =  trim($city[4]);
			$cities[trim($city[3])]['cities'][$city[0]] =  trim($city[1]);
		}
		return $cities;
	}

	public static function get_podro_destination_only_cities_from_file(){
		$lines = file(dirname(dirname(__FILE__)) . '/cities/podro-destination.csv' );

		$cities = [];
		foreach($lines as $line){
			$city = explode(',', $line);

			$cities[trim($city[0])] =  trim($city[1]);


		}
		return $cities;
	}


	public static function get_extended_only_cities_from_persian_woocommerce(){
		$provinces_list = self::get_extended_provinces();

		$persian_woocommerce = file(dirname(dirname(__FILE__)) . '/cities/persian-woocommerce.csv' );
		$woocommerce_shipping = file(dirname(dirname(__FILE__)) . '/cities/woocommerce-shipping.csv' );
		$only_podro = file(dirname(dirname(__FILE__)) . '/cities/podro-destination.csv' );
		$provinces = [];

		foreach($persian_woocommerce as $line){
			$city = explode(',', $line);

			$provinces[trim($city[4])] = $city[1];

		}
		foreach($woocommerce_shipping as $line){
			$city = explode(',', $line);

			$provinces[trim($city[4])] = $city[1];

		}
		foreach($only_podro as $line){
			$city = explode(',', $line);

			$provinces[trim($city[1])] = $city[0];

		}
		return $provinces;
	}

	public static function get_city_by_code($code){
		$cities = self::get_podro_destination_only_cities_from_file();
		if( array_key_exists($code, $cities) )
			return $cities[$code];
	}

	public static function is_podro_city($city_code){

		$mixed_cities = self::get_extended_only_cities_from_persian_woocommerce();

		foreach($mixed_cities as $city_name => $code){
			if($city_code == $code)
				return true;
		}
		return false;
	}

	public static function get_city_by_name($name){
		$mixed_cities = self::get_extended_only_cities_from_persian_woocommerce();

		foreach ($mixed_cities as $city_name => $code){
			if($city_name == $name)
				return $code;
		}
	}
	public function get_store_city(){
		$current_city = $this->get_store_city_code_from_options();
		$current_city = !empty($current_city)? $current_city : '0001';
		return $this->get_cities()[$current_city];
	}

	public function get_store_city_code_from_options(){
		return get_option('podro_store_city','');
	}

	public function get_store_address(){
		return get_option('podro_store_address', '');
	}
	public function get_store_name(){
		return get_option('podro_store_name', '');
	}

}


