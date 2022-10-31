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

	public function get_cities(){
		return array(
			'0001'=>'اراک',
			'0006'=>'ساوه',
			'0005'=>'دلیجان',
			'0101'=>'آستارا',
			'0103'=>'بندرانزلی',
			'0105'=>'رشت',
			'0111'=>'لاهیجان',
			'0110'=>'لنگرود',
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
			'0916'=>'مشهد',
			'0917'=>'نیشابور',
			'1002'=>'اصفهان',
			'1009'=>'شهرضا',
			'1010'=>'کاشان',
			'1018'=>'آران وبیدگل',
			'1102'=>'چابهار',
			'1105'=>'زاهدان',
			'1203'=>'سقز',
			'1204'=>'سنندج',
			'1304'=>'همدان',
			'1401'=>'بروجن',
			'1402'=>'شهرکرد',
			'1503'=>'خرم آباد',
			'1601'=>'ایلام',
			'1703'=>'گچساران',
			'1801'=>'بوشهر',
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
			'2202'=>'بندرعباس',
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
			'2706'=>'گنبدکاوس',
			'2802'=>'بجنورد',
			'2901'=>'بیرجند',
			'3001'=>'کرج',
			'0211'=>'تالش',
			'1700'=>'یاسوج',
			'3007'=>'هشتگرد',
			'2214'=>'کیش',

		);
	}

	public function get_store_city(){
		$current_city = $this->get_store_city_code_from_options();
		return $this->get_cities()[$current_city];
	}

	public function get_store_city_code_from_options(){
		return get_option('woocommerce_store_city',0);
	}

}


