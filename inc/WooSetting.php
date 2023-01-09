<?php

namespace WP_PODRO\Engine;

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
			'options'  => $this->get_cities(),
		);

		$general_fields[3] = $city_fields;
		return $general_fields;
	}

	public static function get_provinces() {
		return array(
			array(
				"id" => 1,
				"name" => "آذربایجان شرقی",
				"code" => "EAZ",
				"cities"=>array(
					'0303'=>'تبریز',
					'0306'=>'مراغه',
				)
			),
			array(
				"id" => 2,
				"name" => "آذربایجان غربی",
				"code" => "WAZ",
				"cities"=>array(

					'0312'=>'بناب',
					'0401'=>'ارومیه',
					'0403'=>'خوی',
					'0407'=>'مهاباد',
					'0408'=>'میاندوآب',
					'0410'=>'بوکان',
				)
			),
			array(
				"id" => 3,
				"name" => "اردبیل",
				"code" => "ADL",
				"cities"=>array(
					"2401"=>'اردبیل'
				)
			),
			array(
				"id" => 4,
				"name" => "اصفهان",
				"code" => "ESF",
				"cities"=>array(
					'1002'=>'اصفهان',
					'1009'=>'شهرضا',
					'1010'=>'کاشان',
					'1018'=>'آران وبیدگل',
				)
			),
			array(
				"id" => 5,
				"name" => "البرز",
				"code" => "ABZ",
				"cities"=>array(
					'3001'=>'کرج',
					'3007'=>'هشتگرد',
				)
			),
			array(
				"id" => 6,
				"name" => "ایلام",
				"code" => "ILM",
				"cities"=>array(
					'1601'=>'ایلام',
				)
			),
			array(
				"id" => 7,
				"name" => "بوشهر",
				"code" => "BHR",
				"cities"=>array(
					'1801'=>'بوشهر',
					'1810'=>'عسلویه',
				)
			),
			array(
				"id" => 8,
				"name" => "تهران",
				"code" => "THR",
				"cities"=>array(

					'2301'=>'تهران',
					'2318'=>'پیشوا',
					'2306'=>'ورامین',
					'2321'=>'قرچک',
				)
			),
			array(
				"id" => 9,
				"name" => "چهارمحال و بختیاری",
				"code" => "CHB",
				"cities"=>array(
					'1401'=>'بروجن',
					'1402'=>'شهرکرد',
				)
			),
			array(
				"id" => 10,
				"name" => "خراسان جنوبی",
				"code" => "SKH",
				"cities"=>array(
					'2901'=>'بیرجند',
				)
			),
			array(
				"id" => 11,
				"name" => "خراسان رضوی",
				"code" => "RKH",
				"cities"=>array(
					'0908'=>'سبزوار',
					'0916'=>'مشهد',
					'0917'=>'نیشابور',
				)
			),
			array(
				"id" => 12,
				"name" => "خراسان شمالی",
				"code" => "NKH",
				"cities"=>array(

					'2802'=>'بجنورد',

				)
			),
			array(
				"id" => 13,
				"name" => "خوزستان",
				"code" => "KHZ",
				"cities"=>array(


					'0601'=>'آبادان',
					'0603'=>'اهواز',
					'0607'=>'خرمشهر',
					'0608'=>'دزفول',
				)
			),
			array(
				"id" => 14,
				"name" => "زنجان",
				"code" => "ZJN",
				"cities"=>array(
					'1901'=>'ابهر',
					'1904'=>'زنجان',
					'1907'=>'خرمدره',
				)
			),
			array(
				"id" => 15,
				"name" => "سمنان",
				"code" => "SMN",
				"cities"=>array(
					'2001'=>'دامغان',
					'2002'=>'سمنان',
					'2003'=>'شاهرود',
				)
			),
			array(
				"id" => 16,
				"name" => "سیستان و بلوچستان",
				"code" => "SBN",
				"cities"=>array(
					'1102'=>'چابهار',
					'1105'=>'زاهدان',
				)
			),
			array(
				"id" => 17,
				"name" => "فارس",
				"code" => "FRS",
				"cities"=>array(

					'0707'=>'شیراز',
					'0712'=>'مرودشت',
				)
			),
			array(
				"id" => 18,
				"name" => "قزوین",
				"code" => "GZN",
				"cities"=>array(
					'2603'=>'قزوین',
				)
			),
			array(
				"id" => 19,
				"name" => "قم",
				"code" => "QHM",
				"cities"=>array(
					'2501'=>'قم',
				)
			),
			array(
				"id" => 20,
				"name" => "کردستان",
				"code" => "KRD",
				"cities"=>array(

					'1203'=>'سقز',
					'1204'=>'سنندج',
				)
			),
			array(
				"id" => 21,
				"name" => "کرمان",
				"code" => "KRN",
				"cities"=>array(
					'0802'=>'بم',
					'0804'=>'رفسنجان',
					'0806'=>'سیرجان',
					'0808'=>'کرمان',
				)
			),
			array(
				"id" => 22,
				"name" => "کرمانشاه",
				"code" => "KRH",
				"cities"=>array(
					'0502'=>'کرمانشاه',
				)
			),
			array(
				"id" => 23,
				"name" => "کهگیلوییه و بویراحمد",
				"code" => "KBD",
				"cities"=>array(
					'1703'=>'گچساران',
					'1700'=>'یاسوج',
				)
			),
			array(
				"id" => 24,
				"name" => "گلستان",
				"code" => "GLS",
				"cities"=>array(
					'2705'=>'گرگان',
					'2710'=>'آزادشهر',
					'2706'=>'گنبدکاوس',
				)
			),
			array(
				"id" => 25,
				"name" => "گیلان",
				"code" => "GIL",
				"cities"=>array(

					'0101'=>'آستارا',
					'0103'=>'بندرانزلی',
					'0105'=>'رشت',
					'0111'=>'لاهیجان',
					'0110'=>'لنگرود',
					'0211'=>'تالش',
				)
			),
			array(
				"id" => 26,
				"name" => "لرستان",
				"code" => "LRS",
				"cities"=>array(
					'1503'=>'خرم آباد',
				)
			),
			array(
				"id" => 27,
				"name" => "مازندران",
				"code" => "MZN",
				"cities"=>array(

					'0201'=>'آمل',
					'0202'=>'بابل',
					'0204'=>'بهشهر',
					'0205'=>'تنکابن',
					'0206'=>'رامسر',
					'0207'=>'ساری',
					'0210'=>'قائم شهر',
					'0214'=>'نور',
					'0215'=>'نوشهر',
					'0218'=>'محمودآباد',
					'0216'=>'بابلسر',
				)
			),
			array(
				"id" => 28,
				"name" => "مرکزی",
				"code" => "MKZ",
				"cities"=>array(
					'0001'=>'اراک',
					'0006'=>'ساوه',
					'0005'=>'دلیجان',
				)
			),
			array(
				"id" => 29,
				"name" => "هرمزگان",
				"code" => "HRZ",
				"cities"=>array(

					'2202'=>'بندرعباس',
					'2204'=>'قشم',
					'2214'=>'کیش',
				)
			),
			array(
				"id" => 30,
				"name" => "همدان",
				"code" => "HDN",
				"cities"=>array(
					'1304'=>'همدان',
				)
			),
			array(
				"id" => 31,
				"name" => "یزد",
				"code" => "YZD",
				"cities"=>array(

					'2101'=>'اردکان',
					'2105'=>'یزد',
					'2106'=>'میبد',
				)
			)
		);
	}

	public function get_cities(){
		return array(
			'0001'=>'اراک',
			'0006'=>'ساوه',
			'0005'=>'دلیجان',
			'0101'=>'بندر آستارا',
			'0103'=>'بندر انزلی',
			'0105'=>'رشت',
			'0111'=>'لاهیجان',
			'0110'=>'لنگرود',
			'0201'=>'آمل',
			'0202'=>'بابل',
			'0204'=>'بهشهر',
			'0205'=>'تنکابن',
			'0206'=>'رامسر',
			'0207'=>'ساری',
			'0210'=>'قائم‌شهر',
			'0214'=>'نور',
			'0215'=>'نوشهر',
			'0218'=>'محمودآباد',
			'0216'=>'بابلسر',
			'0303'=>'تبریز',
			'0306'=>'مراغه',
			'0312'=>'بناب',
			'0401'=>'ارومیه',
			'0403'=>'خوی',
			'0407'=>'مهاباد',
			'0408'=>'میاندوآب',
			'0410'=>'بوکان',
			'0502'=>'کرمانشاه',
			'0601'=>'آبادان',
			'0603'=>'اهواز',
			'0607'=>'خرمشهر',
			'0608'=>'دزفول',
			'0707'=>'شیراز',
			'0712'=>'مرودشت',
			'0802'=>'بم',
			'0804'=>'رفسنجان',
			'0806'=>'سیرجان',
			'0808'=>'کرمان',
			'0908'=>'سبزوار',
			'0916'=>'مشهد مقدس',
			'0917'=>'نیشابور',
			'1002'=>'اصفهان',
			'1009'=>'شهرضا',
			'1010'=>'کاشان',
			'1018'=>'آران و بیدگل',
			'1102'=>'چابهار',
			'1105'=>'زاهدان',
			'1203'=>'سقز',
			'1204'=>'سنندج',
			'1304'=>'همدان',
			'1401'=>'بروجن',
			'1402'=>'شهرکرد',
			'1503'=>'خرم‌آباد',
			'1601'=>'ایلام',
			'1703'=>'گچساران',
			'1801'=>'بندر بوشهر',
			'1810'=>'عسلویه',
			'1901'=>'ابهر',
			'1904'=>'زنجان',
			'1907'=>'خرمدره',
			'2001'=>'دامغان',
			'2002'=>'سمنان',
			'2003'=>'شاهرود',
			'2101'=>'اردکان',
			'2105'=>'یزد',
			'2106'=>'میبد',
			'2202'=>'بندر عباس',
			'2204'=>'قشم',
			'2301'=>'تهران',
			'2318'=>'پیشوا',
			'2306'=>'ورامین',
			'2321'=>'قرچک',
			'2401'=>'اردبیل',
			'2501'=>'قم',
			'2603'=>'قزوین',
			'2705'=>'گرگان',
			'2710'=>'آزادشهر',
			'2706'=>'گنبدکاووس',
			'2802'=>'بجنورد',
			'2901'=>'بیرجند',
			'3001'=>'کرج',
			'0211'=>'تالش',
			'1700'=>'یاسوج',
			'3007'=>'هشتگرد',
			'2214'=>'کیش',

		);
	}

	public function get_city_by_name($name){
		foreach ($this->get_cities() as $code => $city_name){
			if($city_name == $name)
				return $code;
		}
	}
	public function get_store_city(){
		$current_city = $this->get_store_city_code_from_options();
		return $this->get_cities()[$current_city];
	}

	public function get_store_city_code_from_options(){
		return get_option('podro_store_city',0);
	}

	public function get_store_address(){
		return get_option('podro_store_address', '');
	}
	public function get_store_name(){
		return get_option('podro_store_name', '');
	}

}


