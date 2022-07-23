<?php

namespace WP_PODRO\Engine;

class Location {

	public static function get_provinces() {
		return array(
			array(
				"id" => 1,
				"name" => "آذربایجان شرقی",
				"code" => "EAZ"
			),
			array(
				"id" => 2,
				"name" => "آذربایجان غربی",
				"code" => "WAZ"
			),
			array(
				"id" => 3,
				"name" => "اردبیل",
				"code" => "ADL"
			),
			array(
				"id" => 4,
				"name" => "اصفهان",
				"code" => "ESF"
			),
			array(
				"id" => 5,
				"name" => "البرز",
				"code" => "ABZ"
			),
			array(
				"id" => 6,
				"name" => "ایلام",
				"code" => "ILM"
			),
			array(
				"id" => 7,
				"name" => "بوشهر",
				"code" => "BHR"
			),
			array(
				"id" => 8,
				"name" => "تهران",
				"code" => "THR"
			),
			array(
				"id" => 9,
				"name" => "چهارمحال و بختیاری",
				"code" => "CHB"
			),
			array(
				"id" => 10,
				"name" => "خراسان جنوبی",
				"code" => "SKH"
			),
			array(
				"id" => 11,
				"name" => "خراسان رضوی",
				"code" => "RKH"
			),
			array(
				"id" => 12,
				"name" => "خراسان شمالی",
				"code" => "NKH"
			),
			array(
				"id" => 13,
				"name" => "خوزستان",
				"code" => "KHZ"
			),
			array(
				"id" => 14,
				"name" => "زنجان",
				"code" => "ZJN"
			),
			array(
				"id" => 15,
				"name" => "سمنان",
				"code" => "SMN"
			),
			array(
				"id" => 16,
				"name" => "سیستان و بلوچستان",
				"code" => "SBN"
			),
			array(
				"id" => 17,
				"name" => "فارس",
				"code" => "FRS"
			),
			array(
				"id" => 18,
				"name" => "قزوین",
				"code" => "GZN"
			),
			array(
				"id" => 19,
				"name" => "قم",
				"code" => "QHM"
			),
			array(
				"id" => 20,
				"name" => "کردستان",
				"code" => "KRD"
			),
			array(
				"id" => 21,
				"name" => "کرمان",
				"code" => "KRN"
			),
			array(
				"id" => 22,
				"name" => "کرمانشاه",
				"code" => "KRH"
			),
			array(
				"id" => 23,
				"name" => "کهگیلوییه و بویراحمد",
				"code" => "KBD"
			),
			array(
				"id" => 24,
				"name" => "گلستان",
				"code" => "GLS"
			),
			array(
				"id" => 25,
				"name" => "گیلان",
				"code" => "GIL"
			),
			array(
				"id" => 26,
				"name" => "لرستان",
				"code" => "LRS"
			),
			array(
				"id" => 27,
				"name" => "مازندران",
				"code" => "MZN"
			),
			array(
				"id" => 28,
				"name" => "مرکزی",
				"code" => "MKZ"
			),
			array(
				"id" => 29,
				"name" => "هرمزگان",
				"code" => "HRZ"
			),
			array(
				"id" => 30,
				"name" => "همدان",
				"code" => "HDN"
			),
			array(
				"id" => 31,
				"name" => "یزد",
				"code" => "YZD"
			)
		);
	}

	public static function get_cities() : array {
		return array (
			array (
			  'label' => 'اراک',
			  'persian_code' => 3516,
			  'code' => '0001',
			),
			array (
			  'label' => 'آشتیان',
			  'persian_code' => 3632,
			  'code' => '0002',
			),
			array (
			  'label' => 'تفرش',
			  'persian_code' => 3631,
			  'code' => '0003',
			),
			array (
			  'label' => 'خمین',
			  'persian_code' => 3627,
			  'code' => '0004',
			),
			array (
			  'label' => 'ساوه',
			  'persian_code' => 3517,
			  'code' => '0006',
			),
			array (
			  'label' => 'دلیجان',
			  'persian_code' => 3622,
			  'code' => '0005',
			),
			array (
			  'label' => 'محلات',
			  'persian_code' => 3621,
			  'code' => '0009',
			),
			array (
			  'label' => 'خنداب',
			  'persian_code' => 3623,
			  'code' => '0012',
			),
			array (
			  'label' => 'شازند',
			  'persian_code' => 3625,
			  'code' => '0007',
			),
			array (
			  'label' => 'کمیجان',
			  'persian_code' => 3624,
			  'code' => '0011',
			),
			array (
			  'label' => 'آستارا',
			  'persian_code' => 3642,
			  'code' => '0101',
			),
			array (
			  'label' => 'آستانه اشرفیه',
			  'persian_code' => 3644,
			  'code' => '0102',
			),
			array (
			  'label' => 'بندرانزلی',
			  'persian_code' => 3519,
			  'code' => '0103',
			),
			array (
			  'label' => 'رشت',
			  'persian_code' => 3361,
			  'code' => '0105',
			),
			array (
			  'label' => 'رودسر',
			  'persian_code' => 3648,
			  'code' => '0107',
			),
			array (
			  'label' => 'رودبار',
			  'persian_code' => 3646,
			  'code' => '0106',
			),
			array (
			  'label' => 'لاهیجان',
			  'persian_code' => 3520,
			  'code' => '0111',
			),
			array (
			  'label' => 'شفت',
			  'persian_code' => 4139,
			  'code' => '0112',
			),
			array (
			  'label' => 'صومعه سرا',
			  'persian_code' => 3639,
			  'code' => '0108',
			),
			array (
			  'label' => 'فومن',
			  'persian_code' => 3638,
			  'code' => '0109',
			),
			array (
			  'label' => 'لنگرود',
			  'persian_code' => 3647,
			  'code' => '0110',
			),
			array (
			  'label' => 'املش',
			  'persian_code' => 4216,
			  'code' => '0113',
			),
			array (
			  'label' => 'سیاهکل',
			  'persian_code' => 3643,
			  'code' => '0115',
			),
			array (
			  'label' => 'ماسال',
			  'persian_code' => 3641,
			  'code' => '0116',
			),
			array (
			  'label' => 'آمل',
			  'persian_code' => 3522,
			  'code' => '0201',
			),
			array (
			  'label' => 'بابل',
			  'persian_code' => 3523,
			  'code' => '0202',
			),
			array (
			  'label' => 'بهشهر',
			  'persian_code' => 3671,
			  'code' => '0204',
			),
			array (
			  'label' => 'تنکابن',
			  'persian_code' => 3660,
			  'code' => '0205',
			),
			array (
			  'label' => 'رامسر',
			  'persian_code' => 3661,
			  'code' => '0206',
			),
			array (
			  'label' => 'ساری',
			  'persian_code' => 3524,
			  'code' => '0207',
			),
			array (
			  'label' => 'قائم شهر',
			  'persian_code' => 3665,
			  'code' => '0210',
			),
			array (
			  'label' => 'نور',
			  'persian_code' => 3656,
			  'code' => '0214',
			),
			array (
			  'label' => 'نوشهر',
			  'persian_code' => 3657,
			  'code' => '0215',
			),
			array (
			  'label' => 'محمودآباد',
			  'persian_code' => 3196,
			  'code' => '0218',
			),
			array (
			  'label' => 'بابلسر',
			  'persian_code' => 3663,
			  'code' => '0216',
			),
			array (
			  'label' => 'چالوس',
			  'persian_code' => 3658,
			  'code' => '0220',
			),
			array (
			  'label' => 'جویبار',
			  'persian_code' => 3666,
			  'code' => '0221',
			),
			array (
			  'label' => 'کلاردشت',
			  'persian_code' => 3233,
			  'code' => '0228',
			),
			array (
			  'label' => 'گلوگاه',
			  'persian_code' => 3672,
			  'code' => '0222',
			),
			array (
			  'label' => 'عباس آباد',
			  'persian_code' => 3238,
			  'code' => '0224',
			),
			array (
			  'label' => 'اهر',
			  'persian_code' => 3691,
			  'code' => '0302',
			),
			array (
			  'label' => 'تبریز',
			  'persian_code' => 3366,
			  'code' => '0303',
			),
			array (
			  'label' => 'مراغه',
			  'persian_code' => 3529,
			  'code' => '0306',
			),
			array (
			  'label' => 'سراب',
			  'persian_code' => 3693,
			  'code' => '0305',
			),
			array (
			  'label' => 'مرند',
			  'persian_code' => 3528,
			  'code' => '0307',
			),
			array (
			  'label' => 'میانه',
			  'persian_code' => 3527,
			  'code' => '0310',
			),
			array (
			  'label' => 'هشترود',
			  'persian_code' => 4500,
			  'code' => '0311',
			),
			array (
			  'label' => 'بناب',
			  'persian_code' => 3696,
			  'code' => '0312',
			),
			array (
			  'label' => 'شبستر',
			  'persian_code' => 3687,
			  'code' => '0314',
			),
			array (
			  'label' => 'بستان آباد',
			  'persian_code' => 3694,
			  'code' => '0313',
			),
			array (
			  'label' => 'کلیبر',
			  'persian_code' => 3692,
			  'code' => '0315',
			),
			array (
			  'label' => 'هریس',
			  'persian_code' => 3688,
			  'code' => '0316',
			),
			array (
			  'label' => 'جلفا',
			  'persian_code' => 3690,
			  'code' => '0319',
			),
			array (
			  'label' => 'ملکان',
			  'persian_code' => 3697,
			  'code' => '0320',
			),
			array (
			  'label' => 'آذرشهر',
			  'persian_code' => 3686,
			  'code' => '0321',
			),
			array (
			  'label' => 'ورزقان',
			  'persian_code' => 4447,
			  'code' => '0324',
			),
			array (
			  'label' => 'عجب شیر',
			  'persian_code' => 3695,
			  'code' => '0325',
			),
			array (
			  'label' => 'اسکو',
			  'persian_code' => 3684,
			  'code' => '0322',
			),
			array (
			  'label' => 'هوراند',
			  'persian_code' => 4441,
			  'code' => '0327',
			),
			array (
			  'label' => 'ارومیه',
			  'persian_code' => 3533,
			  'code' => '0401',
			),
			array (
			  'label' => 'پیرانشهر',
			  'persian_code' => 3058,
			  'code' => '0402',
			),
			array (
			  'label' => 'خوی',
			  'persian_code' => 3535,
			  'code' => '0403',
			),
			array (
			  'label' => 'سردشت',
			  'persian_code' => 4639,
			  'code' => '0404',
			),
			array (
			  'label' => 'سلماس',
			  'persian_code' => 3066,
			  'code' => '0405',
			),
			array (
			  'label' => 'مهاباد',
			  'persian_code' => 5563,
			  'code' => '0407',
			),
			array (
			  'label' => 'ماکو',
			  'persian_code' => 3064,
			  'code' => '0406',
			),
			array (
			  'label' => 'میاندوآب',
			  'persian_code' => 3072,
			  'code' => '0408',
			),
			array (
			  'label' => 'بوکان',
			  'persian_code' => 3070,
			  'code' => '0410',
			),
			array (
			  'label' => 'نقده',
			  'persian_code' => 3709,
			  'code' => '0409',
			),
			array (
			  'label' => 'شاهین دژ',
			  'persian_code' => 3073,
			  'code' => '0411',
			),
			array (
			  'label' => 'تکاب',
			  'persian_code' => 3074,
			  'code' => '0412',
			),
			array (
			  'label' => 'اشنویه',
			  'persian_code' => 3057,
			  'code' => '0413',
			),
			array (
			  'label' => 'پلدشت',
			  'persian_code' => 2977,
			  'code' => '0415',
			),
			array (
			  'label' => 'شوط',
			  'persian_code' => 2976,
			  'code' => '0417',
			),
			array (
			  'label' => 'کرمانشاه',
			  'persian_code' => 3542,
			  'code' => '0502',
			),
			array (
			  'label' => 'پاوه',
			  'persian_code' => 3108,
			  'code' => '0503',
			),
			array (
			  'label' => 'سرپل ذهاب',
			  'persian_code' => 3106,
			  'code' => '0504',
			),
			array (
			  'label' => 'سنقر',
			  'persian_code' => 3104,
			  'code' => '0505',
			),
			array (
			  'label' => 'قصرشیرین',
			  'persian_code' => 3107,
			  'code' => '0506',
			),
			array (
			  'label' => 'کنگاور',
			  'persian_code' => 4392,
			  'code' => '0507',
			),
			array (
			  'label' => 'گیلانغرب',
			  'persian_code' => 4712,
			  'code' => '0508',
			),
			array (
			  'label' => 'جوانرود',
			  'persian_code' => 4720,
			  'code' => '0509',
			),
			array (
			  'label' => 'صحنه',
			  'persian_code' => 3188,
			  'code' => '0510',
			),
			array (
			  'label' => 'هرسین',
			  'persian_code' => 3102,
			  'code' => '0511',
			),
			array (
			  'label' => 'روانسر',
			  'persian_code' => 4718,
			  'code' => '0514',
			),
			array (
			  'label' => 'آبادان',
			  'persian_code' => 3538,
			  'code' => '0601',
			),
			array (
			  'label' => 'اندیمشک',
			  'persian_code' => 3086,
			  'code' => '0602',
			),
			array (
			  'label' => 'اهواز',
			  'persian_code' => 3374,
			  'code' => '0603',
			),
			array (
			  'label' => 'ایذه',
			  'persian_code' => 3080,
			  'code' => '0604',
			),
			array (
			  'label' => 'بهبهان',
			  'persian_code' => 4634,
			  'code' => '0606',
			),
			array (
			  'label' => 'خرمشهر',
			  'persian_code' => 3539,
			  'code' => '0607',
			),
			array (
			  'label' => 'دزفول',
			  'persian_code' => 3084,
			  'code' => '0608',
			),
			array (
			  'label' => 'رامهرمز',
			  'persian_code' => 3079,
			  'code' => '0610',
			),
			array (
			  'label' => 'شادگان',
			  'persian_code' => 3081,
			  'code' => '0611',
			),
			array (
			  'label' => 'شوشتر',
			  'persian_code' => 3083,
			  'code' => '0612',
			),
			array (
			  'label' => 'شوش',
			  'persian_code' => 3085,
			  'code' => '0614',
			),
			array (
			  'label' => 'باغ ملک',
			  'persian_code' => 4651,
			  'code' => '0615',
			),
			array (
			  'label' => 'امیدیه',
			  'persian_code' => 4640,
			  'code' => '0616',
			),
			array (
			  'label' => 'لالی',
			  'persian_code' => 4697,
			  'code' => '0617',
			),
			array (
			  'label' => 'هندیجان',
			  'persian_code' => 4633,
			  'code' => '0618',
			),
			array (
			  'label' => 'رامشیر',
			  'persian_code' => 4646,
			  'code' => '0619',
			),
			array (
			  'label' => 'گتوند',
			  'persian_code' => 4672,
			  'code' => '0620',
			),
			array (
			  'label' => 'هویزه',
			  'persian_code' => 4665,
			  'code' => '0623',
			),
			array (
			  'label' => 'حمیدیه',
			  'persian_code' => 4621,
			  'code' => '0625',
			),
			array (
			  'label' => 'آغاجاری',
			  'persian_code' => 3078,
			  'code' => '0626',
			),
			array (
			  'label' => 'آباده',
			  'persian_code' => 3713,
			  'code' => '0701',
			),
			array (
			  'label' => 'استهبان',
			  'persian_code' => 3716,
			  'code' => '0702',
			),
			array (
			  'label' => 'اقلید',
			  'persian_code' => 3712,
			  'code' => '0703',
			),
			array (
			  'label' => 'جهرم',
			  'persian_code' => 3546,
			  'code' => '0704',
			),
			array (
			  'label' => 'داراب',
			  'persian_code' => 3719,
			  'code' => '0705',
			),
			array (
			  'label' => 'شیراز',
			  'persian_code' => 4481,
			  'code' => '0707',
			),
			array (
			  'label' => 'فسا',
			  'persian_code' => 3717,
			  'code' => '0708',
			),
			array (
			  'label' => 'کازرون',
			  'persian_code' => 3545,
			  'code' => '0710',
			),
			array (
			  'label' => 'مرودشت',
			  'persian_code' => 3711,
			  'code' => '0712',
			),
			array (
			  'label' => 'نی ریز',
			  'persian_code' => 3720,
			  'code' => '0714',
			),
			array (
			  'label' => 'لامرد',
			  'persian_code' => 3269,
			  'code' => '0715',
			),
			array (
			  'label' => 'بوانات',
			  'persian_code' => 4881,
			  'code' => '0716',
			),
			array (
			  'label' => 'ارسنجان',
			  'persian_code' => 4868,
			  'code' => '0717',
			),
			array (
			  'label' => 'فراشبند',
			  'persian_code' => 3301,
			  'code' => '0722',
			),
			array (
			  'label' => 'خنج',
			  'persian_code' => 3276,
			  'code' => '0724',
			),
			array (
			  'label' => 'سروستان',
			  'persian_code' => 4845,
			  'code' => '0725',
			),
			array (
			  'label' => 'گراش',
			  'persian_code' => 3715,
			  'code' => '0727',
			),
			array (
			  'label' => 'کوار',
			  'persian_code' => 4846,
			  'code' => '0728',
			),
			array (
			  'label' => 'خرامه',
			  'persian_code' => 4844,
			  'code' => '0729',
			),
			array (
			  'label' => 'بافت',
			  'persian_code' => 3745,
			  'code' => '0801',
			),
			array (
			  'label' => 'بم',
			  'persian_code' => 3732,
			  'code' => '0802',
			),
			array (
			  'label' => 'جیرفت',
			  'persian_code' => 3746,
			  'code' => '0803',
			),
			array (
			  'label' => 'رفسنجان',
			  'persian_code' => 3549,
			  'code' => '0804',
			),
			array (
			  'label' => 'زرند',
			  'persian_code' => 3739,
			  'code' => '0805',
			),
			array (
			  'label' => 'سیرجان',
			  'persian_code' => 3550,
			  'code' => '0806',
			),
			array (
			  'label' => 'شهربابک',
			  'persian_code' => 3738,
			  'code' => '0807',
			),
			array (
			  'label' => 'کرمان',
			  'persian_code' => 3548,
			  'code' => '0808',
			),
			array (
			  'label' => 'کهنوج',
			  'persian_code' => 3748,
			  'code' => '0809',
			),
			array (
			  'label' => 'بردسیر',
			  'persian_code' => 3744,
			  'code' => '0810',
			),
			array (
			  'label' => 'راور',
			  'persian_code' => 3731,
			  'code' => '0811',
			),
			array (
			  'label' => 'عنبرآباد',
			  'persian_code' => 3747,
			  'code' => '0812',
			),
			array (
			  'label' => 'منوجان',
			  'persian_code' => 3749,
			  'code' => '0813',
			),
			array (
			  'label' => 'کوهبنان',
			  'persian_code' => 3741,
			  'code' => '0814',
			),
			array (
			  'label' => 'قلعه گنج',
			  'persian_code' => 5031,
			  'code' => '0816',
			),
			array (
			  'label' => 'رابر',
			  'persian_code' => 5019,
			  'code' => '0818',
			),
			array (
			  'label' => 'فهرج',
			  'persian_code' => 4953,
			  'code' => '0819',
			),
			array (
			  'label' => 'انار',
			  'persian_code' => 3737,
			  'code' => '0820',
			),
			array (
			  'label' => 'نرماشیر',
			  'persian_code' => 4952,
			  'code' => '0821',
			),
			array (
			  'label' => 'فاریاب',
			  'persian_code' => 5038,
			  'code' => '0822',
			),
			array (
			  'label' => 'تایباد',
			  'persian_code' => 3033,
			  'code' => '0904',
			),
			array (
			  'label' => 'تربت حیدریه',
			  'persian_code' => 3561,
			  'code' => '0905',
			),
			array (
			  'label' => 'تربت جام',
			  'persian_code' => 3031,
			  'code' => '0906',
			),
			array (
			  'label' => 'سبزوار',
			  'persian_code' => 3562,
			  'code' => '0908',
			),
			array (
			  'label' => 'درگز',
			  'persian_code' => 3026,
			  'code' => '0907',
			),
			array (
			  'label' => 'قوچان',
			  'persian_code' => 3025,
			  'code' => '0913',
			),
			array (
			  'label' => 'کاشمر',
			  'persian_code' => 3037,
			  'code' => '0914',
			),
			array (
			  'label' => 'گناباد',
			  'persian_code' => 3039,
			  'code' => '0915',
			),
			array (
			  'label' => 'مشهد',
			  'persian_code' => 3387,
			  'code' => '0916',
			),
			array (
			  'label' => 'نیشابور',
			  'persian_code' => 3559,
			  'code' => '0917',
			),
			array (
			  'label' => 'چناران',
			  'persian_code' => 3019,
			  'code' => '0918',
			),
			array (
			  'label' => 'خواف',
			  'persian_code' => 3030,
			  'code' => '0919',
			),
			array (
			  'label' => 'سرخس',
			  'persian_code' => 3021,
			  'code' => '0920',
			),
			array (
			  'label' => 'فریمان',
			  'persian_code' => 3022,
			  'code' => '0922',
			),
			array (
			  'label' => 'بردسکن',
			  'persian_code' => 3038,
			  'code' => '0923',
			),
			array (
			  'label' => 'رشتخوار',
			  'persian_code' => 3028,
			  'code' => '0927',
			),
			array (
			  'label' => 'کلات',
			  'persian_code' => 3020,
			  'code' => '0928',
			),
			array (
			  'label' => 'خلیل آباد',
			  'persian_code' => 2904,
			  'code' => '0929',
			),
			array (
			  'label' => 'بجستان',
			  'persian_code' => 5363,
			  'code' => '0931',
			),
			array (
			  'label' => 'جغتای',
			  'persian_code' => 3035,
			  'code' => '0934',
			),
			array (
			  'label' => 'جوین',
			  'persian_code' => 4197,
			  'code' => '0936',
			),
			array (
			  'label' => 'باخرز',
			  'persian_code' => 2868,
			  'code' => '0937',
			),
			array (
			  'label' => 'داورزن',
			  'persian_code' => 3034,
			  'code' => '0939',
			),
			array (
			  'label' => 'صالح آباد',
			  'persian_code' => 3827,
			  'code' => '0940',
			),
			array (
			  'label' => 'اردستان',
			  'persian_code' => 3766,
			  'code' => '1001',
			),
			array (
			  'label' => 'اصفهان',
			  'persian_code' => 3386,
			  'code' => '1002',
			),
			array (
			  'label' => 'خمینی شهر',
			  'persian_code' => 3553,
			  'code' => '1003',
			),
			array (
			  'label' => 'خوانسار',
			  'persian_code' => 2995,
			  'code' => '1004',
			),
			array (
			  'label' => 'سمیرم',
			  'persian_code' => 2986,
			  'code' => '1005',
			),
			array (
			  'label' => 'فلاورجان',
			  'persian_code' => 3770,
			  'code' => '1008',
			),
			array (
			  'label' => 'شهرضا',
			  'persian_code' => 3555,
			  'code' => '1009',
			),
			array (
			  'label' => 'کاشان',
			  'persian_code' => 3556,
			  'code' => '1010',
			),
			array (
			  'label' => 'گلپایگان',
			  'persian_code' => 2993,
			  'code' => '1011',
			),
			array (
			  'label' => 'نجف آباد',
			  'persian_code' => 3554,
			  'code' => '1014',
			),
			array (
			  'label' => 'نطنز',
			  'persian_code' => 2992,
			  'code' => '1015',
			),
			array (
			  'label' => 'مبارکه',
			  'persian_code' => 3773,
			  'code' => '1017',
			),
			array (
			  'label' => 'آران وبیدگل',
			  'persian_code' => 2990,
			  'code' => '1018',
			),
			array (
			  'label' => 'چادگان',
			  'persian_code' => 3779,
			  'code' => '1020',
			),
			array (
			  'label' => 'دهاقان',
			  'persian_code' => 2984,
			  'code' => '1021',
			),
			array (
			  'label' => 'ایرانشهر',
			  'persian_code' => 3565,
			  'code' => '1101',
			),
			array (
			  'label' => 'چابهار',
			  'persian_code' => 3783,
			  'code' => '1102',
			),
			array (
			  'label' => 'خاش',
			  'persian_code' => 3053,
			  'code' => '1103',
			),
			array (
			  'label' => 'زابل',
			  'persian_code' => 3050,
			  'code' => '1104',
			),
			array (
			  'label' => 'زاهدان',
			  'persian_code' => 3564,
			  'code' => '1105',
			),
			array (
			  'label' => 'سراوان',
			  'persian_code' => 4129,
			  'code' => '1106',
			),
			array (
			  'label' => 'نیک شهر',
			  'persian_code' => 3785,
			  'code' => '1107',
			),
			array (
			  'label' => 'سرباز',
			  'persian_code' => 3054,
			  'code' => '1108',
			),
			array (
			  'label' => 'کنارک',
			  'persian_code' => 3784,
			  'code' => '1109',
			),
			array (
			  'label' => 'زهک',
			  'persian_code' => 3051,
			  'code' => '1110',
			),
			array (
			  'label' => 'میرجاوه',
			  'persian_code' => 3048,
			  'code' => '1117',
			),
			array (
			  'label' => 'قصرقند',
			  'persian_code' => 5502,
			  'code' => '1118',
			),
			array (
			  'label' => 'فنوج',
			  'persian_code' => 5469,
			  'code' => '1119',
			),
			array (
			  'label' => 'بمپور',
			  'persian_code' => 3055,
			  'code' => '1120',
			),
			array (
			  'label' => 'بانه',
			  'persian_code' => 3101,
			  'code' => '1201',
			),
			array (
			  'label' => 'سقز',
			  'persian_code' => 3100,
			  'code' => '1203',
			),
			array (
			  'label' => 'بیجار',
			  'persian_code' => 3097,
			  'code' => '1202',
			),
			array (
			  'label' => 'سنندج',
			  'persian_code' => 3541,
			  'code' => '1204',
			),
			array (
			  'label' => 'قروه',
			  'persian_code' => 3098,
			  'code' => '1205',
			),
			array (
			  'label' => 'مریوان',
			  'persian_code' => 3099,
			  'code' => '1206',
			),
			array (
			  'label' => 'دیواندره',
			  'persian_code' => 3096,
			  'code' => '1207',
			),
			array (
			  'label' => 'کامیاران',
			  'persian_code' => 3095,
			  'code' => '1208',
			),
			array (
			  'label' => 'سروآباد',
			  'persian_code' => 3162,
			  'code' => '1209',
			),
			array (
			  'label' => 'دهگلان',
			  'persian_code' => 3154,
			  'code' => '1210',
			),
			array (
			  'label' => 'تویسرکان',
			  'persian_code' => 3093,
			  'code' => '1301',
			),
			array (
			  'label' => 'ملایر',
			  'persian_code' => 3092,
			  'code' => '1302',
			),
			array (
			  'label' => 'نهاوند',
			  'persian_code' => 3910,
			  'code' => '1303',
			),
			array (
			  'label' => 'کبودرآهنگ',
			  'persian_code' => 3090,
			  'code' => '1305',
			),
			array (
			  'label' => 'همدان',
			  'persian_code' => 3540,
			  'code' => '1304',
			),
			array (
			  'label' => 'اسدآباد',
			  'persian_code' => 5355,
			  'code' => '1306',
			),
			array (
			  'label' => 'بهار',
			  'persian_code' => 3088,
			  'code' => '1307',
			),
			array (
			  'label' => 'رزن',
			  'persian_code' => 2730,
			  'code' => '1308',
			),
			array (
			  'label' => 'فامنین',
			  'persian_code' => 3091,
			  'code' => '1309',
			),
			array (
			  'label' => 'بروجن',
			  'persian_code' => 3002,
			  'code' => '1401',
			),
			array (
			  'label' => 'شهرکرد',
			  'persian_code' => 3557,
			  'code' => '1402',
			),
			array (
			  'label' => 'فارسان',
			  'persian_code' => 3001,
			  'code' => '1403',
			),
			array (
			  'label' => 'لردگان',
			  'persian_code' => 3004,
			  'code' => '1404',
			),
			array (
			  'label' => 'اردل',
			  'persian_code' => 3003,
			  'code' => '1405',
			),
			array (
			  'label' => 'سامان',
			  'persian_code' => 4094,
			  'code' => '1408',
			),
			array (
			  'label' => 'بن',
			  'persian_code' => 5234,
			  'code' => '1409',
			),
			array (
			  'label' => 'الیگودرز',
			  'persian_code' => 3112,
			  'code' => '1501',
			),
			array (
			  'label' => 'بروجرد',
			  'persian_code' => 3544,
			  'code' => '1502',
			),
			array (
			  'label' => 'خرم آباد',
			  'persian_code' => 3893,
			  'code' => '1503',
			),
			array (
			  'label' => 'دورود',
			  'persian_code' => 3114,
			  'code' => '1505',
			),
			array (
			  'label' => 'کوهدشت',
			  'persian_code' => 3110,
			  'code' => '1506',
			),
			array (
			  'label' => 'ازنا',
			  'persian_code' => 3113,
			  'code' => '1507',
			),
			array (
			  'label' => 'ایلام',
			  'persian_code' => 3116,
			  'code' => '1601',
			),
			array (
			  'label' => 'دره شهر',
			  'persian_code' => 3119,
			  'code' => '1602',
			),
			array (
			  'label' => 'دهلران',
			  'persian_code' => 3121,
			  'code' => '1603',
			),
			array (
			  'label' => 'مهران',
			  'persian_code' => 3122,
			  'code' => '1605',
			),
			array (
			  'label' => 'آبدانان',
			  'persian_code' => 3120,
			  'code' => '1606',
			),
			array (
			  'label' => 'ایوان',
			  'persian_code' => 3117,
			  'code' => '1607',
			),
			array (
			  'label' => 'بدره',
			  'persian_code' => 4791,
			  'code' => '1610',
			),
			array (
			  'label' => 'چرام',
			  'persian_code' => 4918,
			  'code' => '1706',
			),
			array (
			  'label' => 'باشت',
			  'persian_code' => 4927,
			  'code' => '1707',
			),
			array (
			  'label' => 'لنده',
			  'persian_code' => 4916,
			  'code' => '1708',
			),
			array (
			  'label' => 'بوشهر',
			  'persian_code' => 3547,
			  'code' => '1801',
			),
			array (
			  'label' => 'دشتی',
			  'persian_code' => 5076,
			  'code' => '1804',
			),
			array (
			  'label' => 'عسلویه',
			  'persian_code' => 4893,
			  'code' => '1810',
			),
			array (
			  'label' => 'جم',
			  'persian_code' => 4906,
			  'code' => '1809',
			),
			array (
			  'label' => 'ابهر',
			  'persian_code' => 3652,
			  'code' => '1901',
			),
			array (
			  'label' => 'زنجان',
			  'persian_code' => 3521,
			  'code' => '1904',
			),
			array (
			  'label' => 'ماهنشان',
			  'persian_code' => 3650,
			  'code' => '1909',
			),
			array (
			  'label' => 'خرمدره',
			  'persian_code' => 3653,
			  'code' => '1907',
			),
			array (
			  'label' => 'سلطانیه',
			  'persian_code' => 3651,
			  'code' => '1910',
			),
			array (
			  'label' => 'دامغان',
			  'persian_code' => 3615,
			  'code' => '2001',
			),
			array (
			  'label' => 'سمنان',
			  'persian_code' => 3513,
			  'code' => '2002',
			),
			array (
			  'label' => 'شاهرود',
			  'persian_code' => 3514,
			  'code' => '2003',
			),
			array (
			  'label' => 'گرمسار',
			  'persian_code' => 3609,
			  'code' => '2004',
			),
			array (
			  'label' => 'مهدی شهر',
			  'persian_code' => 3607,
			  'code' => '2005',
			),
			array (
			  'label' => 'میامی',
			  'persian_code' => 2796,
			  'code' => '2007',
			),
			array (
			  'label' => 'سرخه',
			  'persian_code' => 3606,
			  'code' => '2008',
			),
			array (
			  'label' => 'اردکان',
			  'persian_code' => 3008,
			  'code' => '2101',
			),
			array (
			  'label' => 'بافق',
			  'persian_code' => 3010,
			  'code' => '2102',
			),
			array (
			  'label' => 'تفت',
			  'persian_code' => 3012,
			  'code' => '2103',
			),
			array (
			  'label' => 'مهریز',
			  'persian_code' => 3011,
			  'code' => '2104',
			),
			array (
			  'label' => 'یزد',
			  'persian_code' => 3558,
			  'code' => '2105',
			),
			array (
			  'label' => 'میبد',
			  'persian_code' => 3009,
			  'code' => '2106',
			),
			array (
			  'label' => 'ابرکوه',
			  'persian_code' => 3005,
			  'code' => '2107',
			),
			array (
			  'label' => 'بهاباد',
			  'persian_code' => 5283,
			  'code' => '2111',
			),
			array (
			  'label' => 'ابوموسی',
			  'persian_code' => 5065,
			  'code' => '2201',
			),
			array (
			  'label' => 'بندرعباس',
			  'persian_code' => 3551,
			  'code' => '2202',
			),
			array (
			  'label' => 'قشم',
			  'persian_code' => 3752,
			  'code' => '2204',
			),
			array (
			  'label' => 'میناب',
			  'persian_code' => 3755,
			  'code' => '2205',
			),
			array (
			  'label' => 'بستک',
			  'persian_code' => 3753,
			  'code' => '2209',
			),
			array (
			  'label' => 'پارسیان',
			  'persian_code' => 5077,
			  'code' => '2211',
			),
			array (
			  'label' => 'سیریک',
			  'persian_code' => 5055,
			  'code' => '2212',
			),
			array (
			  'label' => 'تهران',
			  'persian_code' => 3322,
			  'code' => '2301',
			),
			array (
			  'label' => 'دماوند',
			  'persian_code' => 3633,
			  'code' => '2302',
			),
			array (
			  'label' => 'ری',
			  'persian_code' => 3586,
			  'code' => '2303',
			),
			array (
			  'label' => 'ملارد',
			  'persian_code' => 3848,
			  'code' => '2317',
			),
			array (
			  'label' => 'پیشوا',
			  'persian_code' => 3593,
			  'code' => '2318',
			),
			array (
			  'label' => 'بهارستان',
			  'persian_code' => 5578,
			  'code' => '2319',
			),
			array (
			  'label' => 'پردیس',
			  'persian_code' => 5588,
			  'code' => '2320',
			),
			array (
			  'label' => 'ورامین',
			  'persian_code' => 3592,
			  'code' => '2306',
			),
			array (
			  'label' => 'شهریار',
			  'persian_code' => 3589,
			  'code' => '2309',
			),
			array (
			  'label' => 'رباط کریم',
			  'persian_code' => 3620,
			  'code' => '2312',
			),
			array (
			  'label' => 'پاکدشت',
			  'persian_code' => 3871,
			  'code' => '2313',
			),
			array (
			  'label' => 'فیروزکوه',
			  'persian_code' => 3634,
			  'code' => '2314',
			),
			array (
			  'label' => 'قرچک',
			  'persian_code' => 5591,
			  'code' => '2321',
			),
			array (
			  'label' => 'اردبیل',
			  'persian_code' => 3532,
			  'code' => '2401',
			),
			array (
			  'label' => 'بیله سوار',
			  'persian_code' => 3704,
			  'code' => '2402',
			),
			array (
			  'label' => 'خلخال',
			  'persian_code' => 3705,
			  'code' => '2403',
			),
			array (
			  'label' => 'گرمی',
			  'persian_code' => 3702,
			  'code' => '2405',
			),
			array (
			  'label' => 'پارس آباد',
			  'persian_code' => 3706,
			  'code' => '2406',
			),
			array (
			  'label' => 'نمین',
			  'persian_code' => 3700,
			  'code' => '2408',
			),
			array (
			  'label' => 'نیر',
			  'persian_code' => 3701,
			  'code' => '2409',
			),
			array (
			  'label' => 'سرعین',
			  'persian_code' => 4520,
			  'code' => '2410',
			),
			array (
			  'label' => 'اصلاندوز',
			  'persian_code' => 4560,
			  'code' => '2411',
			),
			array (
			  'label' => 'قم',
			  'persian_code' => 3515,
			  'code' => '2501',
			),
			array (
			  'label' => 'تاکستان',
			  'persian_code' => 3602,
			  'code' => '2602',
			),
			array (
			  'label' => 'قزوین',
			  'persian_code' => 3512,
			  'code' => '2603',
			),
			array (
			  'label' => 'آبیک',
			  'persian_code' => 3598,
			  'code' => '2604',
			),
			array (
			  'label' => 'کردکوی',
			  'persian_code' => 3674,
			  'code' => '2704',
			),
			array (
			  'label' => 'گرگان',
			  'persian_code' => 3525,
			  'code' => '2705',
			),
			array (
			  'label' => 'علی آباد',
			  'persian_code' => 3677,
			  'code' => '2703',
			),
			array (
			  'label' => 'کلاله',
			  'persian_code' => 3681,
			  'code' => '2709',
			),
			array (
			  'label' => 'آزادشهر',
			  'persian_code' => 3678,
			  'code' => '2710',
			),
			array (
			  'label' => 'گنبدکاوس',
			  'persian_code' => 3679,
			  'code' => '2706',
			),
			array (
			  'label' => 'مینودشت',
			  'persian_code' => 3883,
			  'code' => '2707',
			),
			array (
			  'label' => 'آق قلا',
			  'persian_code' => 3676,
			  'code' => '2708',
			),
			array (
			  'label' => 'رامیان',
			  'persian_code' => 4316,
			  'code' => '2711',
			),
			array (
			  'label' => 'گالیکش',
			  'persian_code' => 4365,
			  'code' => '2714',
			),
			array (
			  'label' => 'اسفراین',
			  'persian_code' => 2892,
			  'code' => '2801',
			),
			array (
			  'label' => 'بجنورد',
			  'persian_code' => 3560,
			  'code' => '2802',
			),
			array (
			  'label' => 'جاجرم',
			  'persian_code' => 2880,
			  'code' => '2803',
			),
			array (
			  'label' => 'شیروان',
			  'persian_code' => 2834,
			  'code' => '2804',
			),
			array (
			  'label' => 'فاروج',
			  'persian_code' => 5324,
			  'code' => '2805',
			),
			array (
			  'label' => 'گرمه',
			  'persian_code' => 3023,
			  'code' => '2807',
			),
			array (
			  'label' => 'بیرجند',
			  'persian_code' => 3563,
			  'code' => '2901',
			),
			array (
			  'label' => 'سربیشه',
			  'persian_code' => 4928,
			  'code' => '2903',
			),
			array (
			  'label' => 'نهبندان',
			  'persian_code' => 3042,
			  'code' => '2905',
			),
			array (
			  'label' => 'سرایان',
			  'persian_code' => 5394,
			  'code' => '2906',
			),
			array (
			  'label' => 'فردوس',
			  'persian_code' => 3590,
			  'code' => '2907',
			),
			array (
			  'label' => 'بشرویه',
			  'persian_code' => 3045,
			  'code' => '2908',
			),
			array (
			  'label' => 'خوسف',
			  'persian_code' => 5367,
			  'code' => '2910',
			),
			array (
			  'label' => 'کرج',
			  'persian_code' => 3351,
			  'code' => '3001',
			),
			array (
			  'label' => 'نظرآباد',
			  'persian_code' => 3587,
			  'code' => '3003',
			),
			array (
			  'label' => 'طالقان',
			  'persian_code' => 3856,
			  'code' => '3004',
			),
			array (
			  'label' => 'اشتهارد',
			  'persian_code' => 3821,
			  'code' => '3005',
			),
			array (
			  'label' => 'یاسوج',
			  'persian_code' => 3728,
			  'code' => '1700',
			),
			array (
			  'label' => 'کیش',
			  'persian_code' => 3751,
			  'code' => '2214',
			),
			array (
			  'label' => 'جعفرآباد',
			  'persian_code' => 3791,
			  'code' => '2415',
			),
			array (
			  'label' => 'رضی',
			  'persian_code' => 4538,
			  'code' => '2416',
			),
			array (
			  'label' => 'عنبران',
			  'persian_code' => 4516,
			  'code' => '2417',
			),
			array (
			  'label' => 'فخرآباد',
			  'persian_code' => 4537,
			  'code' => '2418',
			),
			array (
			  'label' => 'کلور',
			  'persian_code' => 4555,
			  'code' => '2419',
			),
			array (
			  'label' => 'لاهرود',
			  'persian_code' => 4562,
			  'code' => '2422',
			),
			array (
			  'label' => 'مرادلو',
			  'persian_code' => 4540,
			  'code' => '2423',
			),
			array (
			  'label' => 'هشتجین',
			  'persian_code' => 4553,
			  'code' => '2424',
			),
			array (
			  'label' => 'هیر',
			  'persian_code' => 4524,
			  'code' => '2425',
			),
			array (
			  'label' => 'ابریشم',
			  'persian_code' => 5586,
			  'code' => '1026',
			),
			array (
			  'label' => 'ابوزیدآباد',
			  'persian_code' => 5187,
			  'code' => '1027',
			),
			array (
			  'label' => 'اژیه',
			  'persian_code' => 5543,
			  'code' => '1028',
			),
			array (
			  'label' => 'افوس',
			  'persian_code' => 5587,
			  'code' => '1029',
			),
			array (
			  'label' => 'انارک',
			  'persian_code' => 5556,
			  'code' => '1030',
			),
			array (
			  'label' => 'بادرود',
			  'persian_code' => 5582,
			  'code' => '1032',
			),
			array (
			  'label' => 'بافران',
			  'persian_code' => 5557,
			  'code' => '1034',
			),
			array (
			  'label' => 'برزک',
			  'persian_code' => 5191,
			  'code' => '1035',
			),
			array (
			  'label' => 'برف انبار',
			  'persian_code' => 5147,
			  'code' => '1036',
			),
			array (
			  'label' => 'بهارستان',
			  'persian_code' => 5578,
			  'code' => '1039',
			),
			array (
			  'label' => 'پیربکران',
			  'persian_code' => 5571,
			  'code' => '1040',
			),
			array (
			  'label' => 'تودشک',
			  'persian_code' => 5581,
			  'code' => '1041',
			),
			array (
			  'label' => 'تیران',
			  'persian_code' => 3775,
			  'code' => '1042',
			),
			array (
			  'label' => 'جندق',
			  'persian_code' => 5531,
			  'code' => '1043',
			),
			array (
			  'label' => 'جوزدان',
			  'persian_code' => 5141,
			  'code' => '1044',
			),
			array (
			  'label' => 'چرمهین',
			  'persian_code' => 5097,
			  'code' => '1046',
			),
			array (
			  'label' => 'چمگردان',
			  'persian_code' => 5100,
			  'code' => '1047',
			),
			array (
			  'label' => 'حبیب آباد',
			  'persian_code' => 5524,
			  'code' => '1048',
			),
			array (
			  'label' => 'حنا',
			  'persian_code' => 2987,
			  'code' => '1050',
			),
			array (
			  'label' => 'خالدآباد',
			  'persian_code' => 5583,
			  'code' => '1051',
			),
			array (
			  'label' => 'خور',
			  'persian_code' => 3764,
			  'code' => '1052',
			),
			array (
			  'label' => 'خوراسگان',
			  'persian_code' => 5514,
			  'code' => '1053',
			),
			array (
			  'label' => 'خورزوق',
			  'persian_code' => 5523,
			  'code' => '1054',
			),
			array (
			  'label' => 'داران',
			  'persian_code' => 4436,
			  'code' => '1055',
			),
			array (
			  'label' => 'دامنه',
			  'persian_code' => 5127,
			  'code' => '1056',
			),
			array (
			  'label' => 'دستگرد',
			  'persian_code' => 5498,
			  'code' => '1058',
			),
			array (
			  'label' => 'دولت آباد',
			  'persian_code' => 4432,
			  'code' => '1059',
			),
			array (
			  'label' => 'دهق',
			  'persian_code' => 3776,
			  'code' => '1060',
			),
			array (
			  'label' => 'دیزیچه',
			  'persian_code' => 5102,
			  'code' => '1061',
			),
			array (
			  'label' => 'رزوه',
			  'persian_code' => 5136,
			  'code' => '1062',
			),
			array (
			  'label' => 'زاینده رود',
			  'persian_code' => 5109,
			  'code' => '1064',
			),
			array (
			  'label' => 'زواره',
			  'persian_code' => 3769,
			  'code' => '1066',
			),
			array (
			  'label' => 'سده لنجان',
			  'persian_code' => 5096,
			  'code' => '1068',
			),
			array (
			  'label' => 'سگزی',
			  'persian_code' => 5580,
			  'code' => '1070',
			),
			array (
			  'label' => 'شاهین شهر',
			  'persian_code' => 3552,
			  'code' => '1072',
			),
			array (
			  'label' => 'طالخونچه',
			  'persian_code' => 5113,
			  'code' => '1073',
			),
			array (
			  'label' => 'عسگران',
			  'persian_code' => 5117,
			  'code' => '1074',
			),
			array (
			  'label' => 'فرخی',
			  'persian_code' => 5532,
			  'code' => '1076',
			),
			array (
			  'label' => 'فولادشهر',
			  'persian_code' => 3774,
			  'code' => '1077',
			),
			array (
			  'label' => 'قمصر',
			  'persian_code' => 3796,
			  'code' => '1078',
			),
			array (
			  'label' => 'قهجاورستان',
			  'persian_code' => 5541,
			  'code' => '1079',
			),
			array (
			  'label' => 'کرکوند',
			  'persian_code' => 5108,
			  'code' => '1081',
			),
			array (
			  'label' => 'کلیشادوسودرجان',
			  'persian_code' => 5572,
			  'code' => '1082',
			),
			array (
			  'label' => 'کمشچه',
			  'persian_code' => 5530,
			  'code' => '1083',
			),
			array (
			  'label' => 'کمه',
			  'persian_code' => 5169,
			  'code' => '1084',
			),
			array (
			  'label' => 'کوشک',
			  'persian_code' => 4864,
			  'code' => '1085',
			),
			array (
			  'label' => 'کوهپایه',
			  'persian_code' => 3765,
			  'code' => '1086',
			),
			array (
			  'label' => 'کهریزسنگ',
			  'persian_code' => 5142,
			  'code' => '1087',
			),
			array (
			  'label' => 'گرگاب',
			  'persian_code' => 5520,
			  'code' => '1088',
			),
			array (
			  'label' => 'گلدشت',
			  'persian_code' => 5140,
			  'code' => '1090',
			),
			array (
			  'label' => 'گلشن',
			  'persian_code' => 4972,
			  'code' => '1091',
			),
			array (
			  'label' => 'گلشهر',
			  'persian_code' => 5206,
			  'code' => '1092',
			),
			array (
			  'label' => 'گوگد',
			  'persian_code' => 2994,
			  'code' => '1093',
			),
			array (
			  'label' => 'لای بید',
			  'persian_code' => 5527,
			  'code' => '1094',
			),
			array (
			  'label' => 'محمدآباد',
			  'persian_code' => 5538,
			  'code' => '1095',
			),
			array (
			  'label' => 'مشکات',
			  'persian_code' => 5184,
			  'code' => '1096',
			),
			array (
			  'label' => 'منظریه',
			  'persian_code' => 5162,
			  'code' => '1097',
			),
			array (
			  'label' => 'مهاباد',
			  'persian_code' => 5563,
			  'code' => '1098',
			),
			array (
			  'label' => 'میمه',
			  'persian_code' => 3763,
			  'code' => '1099',
			),
			array (
			  'label' => 'نصرآباد',
			  'persian_code' => 2854,
			  'code' => '1150',
			),
			array (
			  'label' => 'نوش آباد',
			  'persian_code' => 5577,
			  'code' => '1151',
			),
			array (
			  'label' => 'نیاسر',
			  'persian_code' => 5585,
			  'code' => '1152',
			),
			array (
			  'label' => 'نیک آباد',
			  'persian_code' => 5542,
			  'code' => '1153',
			),
			array (
			  'label' => 'ورزنه',
			  'persian_code' => 5540,
			  'code' => '1154',
			),
			array (
			  'label' => 'ورنامخواست',
			  'persian_code' => 5095,
			  'code' => '1155',
			),
			array (
			  'label' => 'وزوان',
			  'persian_code' => 5526,
			  'code' => '1156',
			),
			array (
			  'label' => 'ونک',
			  'persian_code' => 5166,
			  'code' => '1157',
			),
			array (
			  'label' => 'آسارا',
			  'persian_code' => 3818,
			  'code' => '3008',
			),
			array (
			  'label' => 'چهارباغ',
			  'persian_code' => 5617,
			  'code' => '3010',
			),
			array (
			  'label' => 'کمال شهر',
			  'persian_code' => 5614,
			  'code' => '3013',
			),
			array (
			  'label' => 'کوهسار',
			  'persian_code' => 3853,
			  'code' => '3014',
			),
			array (
			  'label' => 'گرمدره',
			  'persian_code' => 4123,
			  'code' => '3015',
			),
			array (
			  'label' => 'محمدشهر',
			  'persian_code' => 5612,
			  'code' => '3017',
			),
			array (
			  'label' => 'ارکواز',
			  'persian_code' => 4805,
			  'code' => '1611',
			),
			array (
			  'label' => 'آسمان آباد',
			  'persian_code' => 4784,
			  'code' => '1612',
			),
			array (
			  'label' => 'پهله',
			  'persian_code' => 4800,
			  'code' => '1613',
			),
			array (
			  'label' => 'توحید',
			  'persian_code' => 4781,
			  'code' => '1614',
			),
			array (
			  'label' => 'چوار',
			  'persian_code' => 4775,
			  'code' => '1615',
			),
			array (
			  'label' => 'زرنه',
			  'persian_code' => 5129,
			  'code' => '1617',
			),
			array (
			  'label' => 'سراب باغ',
			  'persian_code' => 4794,
			  'code' => '1618',
			),
			array (
			  'label' => 'صالح آباد',
			  'persian_code' => 3827,
			  'code' => '1620',
			),
			array (
			  'label' => 'لومار',
			  'persian_code' => 4783,
			  'code' => '1621',
			),
			array (
			  'label' => 'مورموری',
			  'persian_code' => 4795,
			  'code' => '1622',
			),
			array (
			  'label' => 'موسیان',
			  'persian_code' => 4797,
			  'code' => '1623',
			),
			array (
			  'label' => 'ایلخچی',
			  'persian_code' => 4400,
			  'code' => '0328',
			),
			array (
			  'label' => 'باسمنج',
			  'persian_code' => 4405,
			  'code' => '0331',
			),
			array (
			  'label' => 'ترک',
			  'persian_code' => 4383,
			  'code' => '0334',
			),
			array (
			  'label' => 'ترکمانچای',
			  'persian_code' => 4384,
			  'code' => '0335',
			),
			array (
			  'label' => 'تسوج',
			  'persian_code' => 4420,
			  'code' => '0336',
			),
			array (
			  'label' => 'تیکمه داش',
			  'persian_code' => 5576,
			  'code' => '0337',
			),
			array (
			  'label' => 'خاروانا',
			  'persian_code' => 4440,
			  'code' => '0338',
			),
			array (
			  'label' => 'خامنه',
			  'persian_code' => 4416,
			  'code' => '0339',
			),
			array (
			  'label' => 'خراجو',
			  'persian_code' => 4476,
			  'code' => '0340',
			),
			array (
			  'label' => 'خسروشهر',
			  'persian_code' => 4397,
			  'code' => '0341',
			),
			array (
			  'label' => 'خمارلو',
			  'persian_code' => 4450,
			  'code' => '0342',
			),
			array (
			  'label' => 'خواجه',
			  'persian_code' => 4427,
			  'code' => '0343',
			),
			array (
			  'label' => 'زرنق',
			  'persian_code' => 4425,
			  'code' => '0345',
			),
			array (
			  'label' => 'زنوز',
			  'persian_code' => 4431,
			  'code' => '0346',
			),
			array (
			  'label' => 'سردرود',
			  'persian_code' => 3685,
			  'code' => '0347',
			),
			array (
			  'label' => 'سیس',
			  'persian_code' => 4417,
			  'code' => '0348',
			),
			array (
			  'label' => 'شربیان',
			  'persian_code' => 4463,
			  'code' => '0350',
			),
			array (
			  'label' => 'شرفخانه',
			  'persian_code' => 4421,
			  'code' => '0351',
			),
			array (
			  'label' => 'شندآباد',
			  'persian_code' => 4419,
			  'code' => '0352',
			),
			array (
			  'label' => 'صوفیان',
			  'persian_code' => 4418,
			  'code' => '0354',
			),
			array (
			  'label' => 'گوگان',
			  'persian_code' => 4412,
			  'code' => '0359',
			),
			array (
			  'label' => 'لیلان',
			  'persian_code' => 4498,
			  'code' => '0360',
			),
			array (
			  'label' => 'ممقان',
			  'persian_code' => 4411,
			  'code' => '0361',
			),
			array (
			  'label' => 'مهربان',
			  'persian_code' => 4464,
			  'code' => '0362',
			),
			array (
			  'label' => 'نظرکهریزی',
			  'persian_code' => 4504,
			  'code' => '0363',
			),
			array (
			  'label' => 'وایقان',
			  'persian_code' => 4459,
			  'code' => '0364',
			),
			array (
			  'label' => 'هادیشهر',
			  'persian_code' => 3689,
			  'code' => '0365',
			),
			array (
			  'label' => 'یامچی',
			  'persian_code' => 4434,
			  'code' => '0366',
			),
			array (
			  'label' => 'ایواوغلی',
			  'persian_code' => 3060,
			  'code' => '0367',
			),
			array (
			  'label' => 'باروق',
			  'persian_code' => 4613,
			  'code' => '0419',
			),
			array (
			  'label' => 'بازرگان',
			  'persian_code' => 2972,
			  'code' => '0420',
			),
			array (
			  'label' => 'تازه شهر',
			  'persian_code' => 3067,
			  'code' => '0421',
			),
			array (
			  'label' => 'ربط',
			  'persian_code' => 4594,
			  'code' => '0425',
			),
			array (
			  'label' => 'سرو',
			  'persian_code' => 2928,
			  'code' => '0426',
			),
			array (
			  'label' => 'سیمینه',
			  'persian_code' => 4587,
			  'code' => '0428',
			),
			array (
			  'label' => 'فیرورق',
			  'persian_code' => 3062,
			  'code' => '0430',
			),
			array (
			  'label' => 'قطور',
			  'persian_code' => 2962,
			  'code' => '0432',
			),
			array (
			  'label' => 'قوشچی',
			  'persian_code' => 3708,
			  'code' => '0433',
			),
			array (
			  'label' => 'گردکشانه',
			  'persian_code' => 2949,
			  'code' => '0435',
			),
			array (
			  'label' => 'محمودآباد',
			  'persian_code' => 3196,
			  'code' => '0437',
			),
			array (
			  'label' => 'میرآباد',
			  'persian_code' => 5120,
			  'code' => '0439',
			),
			array (
			  'label' => 'نالوس',
			  'persian_code' => 2939,
			  'code' => '0440',
			),
			array (
			  'label' => 'امام حسن',
			  'persian_code' => 4891,
			  'code' => '1812',
			),
			array (
			  'label' => 'انارستان',
			  'persian_code' => 4837,
			  'code' => '1813',
			),
			array (
			  'label' => 'آبپخش',
			  'persian_code' => 4910,
			  'code' => '1815',
			),
			array (
			  'label' => 'بردخون',
			  'persian_code' => 4901,
			  'code' => '1818',
			),
			array (
			  'label' => 'بندردیر',
			  'persian_code' => 4902,
			  'code' => '1819',
			),
			array (
			  'label' => 'بندرریگ',
			  'persian_code' => 4887,
			  'code' => '1821',
			),
			array (
			  'label' => 'بندرکنگان',
			  'persian_code' => 4905,
			  'code' => '1822',
			),
			array (
			  'label' => 'بندرگناوه',
			  'persian_code' => 3721,
			  'code' => '1823',
			),
			array (
			  'label' => 'تنگ ارم',
			  'persian_code' => 4913,
			  'code' => '1825',
			),
			array (
			  'label' => 'دالکی',
			  'persian_code' => 4908,
			  'code' => '1829',
			),
			array (
			  'label' => 'دلوار',
			  'persian_code' => 4898,
			  'code' => '1830',
			),
			array (
			  'label' => 'ریز',
			  'persian_code' => 4904,
			  'code' => '1831',
			),
			array (
			  'label' => 'سعدآباد',
			  'persian_code' => 4911,
			  'code' => '1832',
			),
			array (
			  'label' => 'سیراف',
			  'persian_code' => 5620,
			  'code' => '1833',
			),
			array (
			  'label' => 'شبانکاره',
			  'persian_code' => 4909,
			  'code' => '1834',
			),
			array (
			  'label' => 'شنبه',
			  'persian_code' => 4895,
			  'code' => '1835',
			),
			array (
			  'label' => 'کاکی',
			  'persian_code' => 4896,
			  'code' => '1836',
			),
			array (
			  'label' => 'کلمه',
			  'persian_code' => 4914,
			  'code' => '1837',
			),
			array (
			  'label' => 'نخل تقی',
			  'persian_code' => 3725,
			  'code' => '1838',
			),
			array (
			  'label' => 'وحدتیه',
			  'persian_code' => 4912,
			  'code' => '1839',
			),
			array (
			  'label' => 'ارجمند',
			  'persian_code' => 4121,
			  'code' => '2324',
			),
			array (
			  'label' => 'اندیشه',
			  'persian_code' => 4004,
			  'code' => '2325',
			),
			array (
			  'label' => 'آبسرد',
			  'persian_code' => 4114,
			  'code' => '2326',
			),
			array (
			  'label' => 'آبعلی',
			  'persian_code' => 4112,
			  'code' => '2327',
			),
			array (
			  'label' => 'باغستان',
			  'persian_code' => 3845,
			  'code' => '2328',
			),
			array (
			  'label' => 'بومهن',
			  'persian_code' => 3787,
			  'code' => '2330',
			),
			array (
			  'label' => 'چهاردانگه',
			  'persian_code' => 3831,
			  'code' => '2332',
			),
			array (
			  'label' => 'رودهن',
			  'persian_code' => 4110,
			  'code' => '2334',
			),
			array (
			  'label' => 'شاهدشهر',
			  'persian_code' => 3847,
			  'code' => '2335',
			),
			array (
			  'label' => 'شریف آباد',
			  'persian_code' => 3872,
			  'code' => '2336',
			),
			array (
			  'label' => 'صفادشت',
			  'persian_code' => 5615,
			  'code' => '2338',
			),
			array (
			  'label' => 'فردوسیه',
			  'persian_code' => 4973,
			  'code' => '2339',
			),
			array (
			  'label' => 'فرون آباد',
			  'persian_code' => 3807,
			  'code' => '2340',
			),
			array (
			  'label' => 'فشم',
			  'persian_code' => 3841,
			  'code' => '2341',
			),
			array (
			  'label' => 'کهریزک',
			  'persian_code' => 3793,
			  'code' => '2342',
			),
			array (
			  'label' => 'کیلان',
			  'persian_code' => 4113,
			  'code' => '2343',
			),
			array (
			  'label' => 'گلستان',
			  'persian_code' => 5590,
			  'code' => '2344',
			),
			array (
			  'label' => 'لواسان',
			  'persian_code' => 3588,
			  'code' => '2345',
			),
			array (
			  'label' => 'نسیم شهر',
			  'persian_code' => 5589,
			  'code' => '2346',
			),
			array (
			  'label' => 'نصیرآباد',
			  'persian_code' => 4006,
			  'code' => '2347',
			),
			array (
			  'label' => 'آلونی',
			  'persian_code' => 5258,
			  'code' => '1411',
			),
			array (
			  'label' => 'باباحیدر',
			  'persian_code' => 5236,
			  'code' => '1412',
			),
			array (
			  'label' => 'بلداجی',
			  'persian_code' => 5246,
			  'code' => '1413',
			),
			array (
			  'label' => 'جونقان',
			  'persian_code' => 5240,
			  'code' => '1414',
			),
			array (
			  'label' => 'سودجان',
			  'persian_code' => 5227,
			  'code' => '1417',
			),
			array (
			  'label' => 'سورشجان',
			  'persian_code' => 5225,
			  'code' => '1418',
			),
			array (
			  'label' => 'طاقانک',
			  'persian_code' => 5220,
			  'code' => '1420',
			),
			array (
			  'label' => 'فرادنبه',
			  'persian_code' => 5244,
			  'code' => '1421',
			),
			array (
			  'label' => 'فرخ شهر',
			  'persian_code' => 2996,
			  'code' => '1422',
			),
			array (
			  'label' => 'کیان',
			  'persian_code' => 5219,
			  'code' => '1423',
			),
			array (
			  'label' => 'گندمان',
			  'persian_code' => 5248,
			  'code' => '1424',
			),
			array (
			  'label' => 'گهرو',
			  'persian_code' => 5224,
			  'code' => '1425',
			),
			array (
			  'label' => 'مال خلیفه',
			  'persian_code' => 5259,
			  'code' => '1426',
			),
			array (
			  'label' => 'ناغان',
			  'persian_code' => 5250,
			  'code' => '1427',
			),
			array (
			  'label' => 'نافچ',
			  'persian_code' => 5232,
			  'code' => '1428',
			),
			array (
			  'label' => 'نقنه',
			  'persian_code' => 5243,
			  'code' => '1429',
			),
			array (
			  'label' => 'هفشجان',
			  'persian_code' => 2998,
			  'code' => '1430',
			),
			array (
			  'label' => 'ارسک',
			  'persian_code' => 5396,
			  'code' => '2912',
			),
			array (
			  'label' => 'اسلامیه',
			  'persian_code' => 5593,
			  'code' => '2915',
			),
			array (
			  'label' => 'آرین شهر',
			  'persian_code' => 2891,
			  'code' => '2916',
			),
			array (
			  'label' => 'آیسک',
			  'persian_code' => 5375,
			  'code' => '2917',
			),
			array (
			  'label' => 'حاجی آباد',
			  'persian_code' => 5121,
			  'code' => '2918',
			),
			array (
			  'label' => 'زهان',
			  'persian_code' => 5391,
			  'code' => '2920',
			),
			array (
			  'label' => 'سه قلعه',
			  'persian_code' => 5402,
			  'code' => '2921',
			),
			array (
			  'label' => 'شوسف',
			  'persian_code' => 5383,
			  'code' => '2922',
			),
			array (
			  'label' => 'قهستان',
			  'persian_code' => 5592,
			  'code' => '2925',
			),
			array (
			  'label' => 'گزیک',
			  'persian_code' => 5377,
			  'code' => '2926',
			),
			array (
			  'label' => 'مود',
			  'persian_code' => 3040,
			  'code' => '2928',
			),
			array (
			  'label' => 'نیمبلوک',
			  'persian_code' => 5374,
			  'code' => '2929',
			),
			array (
			  'label' => 'انابد',
			  'persian_code' => 2912,
			  'code' => '0942',
			),
			array (
			  'label' => 'باجگیران',
			  'persian_code' => 5328,
			  'code' => '0943',
			),
			array (
			  'label' => 'بار',
			  'persian_code' => 5318,
			  'code' => '0944',
			),
			array (
			  'label' => 'بیدخت',
			  'persian_code' => 5359,
			  'code' => '0946',
			),
			array (
			  'label' => 'جنگل',
			  'persian_code' => 5348,
			  'code' => '0947',
			),
			array (
			  'label' => 'چاپشلو',
			  'persian_code' => 5335,
			  'code' => '0948',
			),
			array (
			  'label' => 'چکنه',
			  'persian_code' => 5315,
			  'code' => '0949',
			),
			array (
			  'label' => 'خرو',
			  'persian_code' => 2776,
			  'code' => '0950',
			),
			array (
			  'label' => 'رباط سنگ',
			  'persian_code' => 5354,
			  'code' => '0953',
			),
			array (
			  'label' => 'رضویه',
			  'persian_code' => 5595,
			  'code' => '0954',
			),
			array (
			  'label' => 'سلامی',
			  'persian_code' => 2849,
			  'code' => '0958',
			),
			array (
			  'label' => 'سلطان آباد',
			  'persian_code' => 4010,
			  'code' => '0959',
			),
			array (
			  'label' => 'سنگان',
			  'persian_code' => 2844,
			  'code' => '0960',
			),
			array (
			  'label' => 'شادمهر',
			  'persian_code' => 5342,
			  'code' => '0961',
			),
			array (
			  'label' => 'شاندیز',
			  'persian_code' => 2784,
			  'code' => '0962',
			),
			array (
			  'label' => 'ششتمد',
			  'persian_code' => 3036,
			  'code' => '0963',
			),
			array (
			  'label' => 'شهرآباد',
			  'persian_code' => 3846,
			  'code' => '0964',
			),
			array (
			  'label' => 'عشق آباد',
			  'persian_code' => 2780,
			  'code' => '0968',
			),
			array (
			  'label' => 'فرهادگرد',
			  'persian_code' => 2813,
			  'code' => '0969',
			),
			array (
			  'label' => 'فیض آباد',
			  'persian_code' => 4950,
			  'code' => '0970',
			),
			array (
			  'label' => 'قاسم آباد',
			  'persian_code' => 2846,
			  'code' => '0971',
			),
			array (
			  'label' => 'قدمگاه',
			  'persian_code' => 4410,
			  'code' => '0972',
			),
			array (
			  'label' => 'قلندرآباد',
			  'persian_code' => 2812,
			  'code' => '0973',
			),
			array (
			  'label' => 'کاخک',
			  'persian_code' => 5361,
			  'code' => '0974',
			),
			array (
			  'label' => 'کاریز',
			  'persian_code' => 2864,
			  'code' => '0975',
			),
			array (
			  'label' => 'کدکن',
			  'persian_code' => 3029,
			  'code' => '0976',
			),
			array (
			  'label' => 'کندر',
			  'persian_code' => 2905,
			  'code' => '0977',
			),
			array (
			  'label' => 'گلمکان',
			  'persian_code' => 2794,
			  'code' => '0978',
			),
			array (
			  'label' => 'لطف آباد',
			  'persian_code' => 5333,
			  'code' => '0979',
			),
			array (
			  'label' => 'مشهدریزه',
			  'persian_code' => 2867,
			  'code' => '0981',
			),
			array (
			  'label' => 'ملک آباد',
			  'persian_code' => 2782,
			  'code' => '0982',
			),
			array (
			  'label' => 'نشتیفان',
			  'persian_code' => 2843,
			  'code' => '0983',
			),
			array (
			  'label' => 'نصر آباد',
			  'persian_code' => 5579,
			  'code' => '0984',
			),
			array (
			  'label' => 'نوخندان',
			  'persian_code' => 5336,
			  'code' => '0986',
			),
			array (
			  'label' => 'نیل شهر',
			  'persian_code' => 2852,
			  'code' => '0987',
			),
			array (
			  'label' => 'همت آباد',
			  'persian_code' => 5596,
			  'code' => '0988',
			),
			array (
			  'label' => 'یونسی',
			  'persian_code' => 5358,
			  'code' => '0989',
			),
			array (
			  'label' => 'پیش قلعه',
			  'persian_code' => 2830,
			  'code' => '2811',
			),
			array (
			  'label' => 'درق',
			  'persian_code' => 3016,
			  'code' => '2814',
			),
			array (
			  'label' => 'راز',
			  'persian_code' => 2831,
			  'code' => '2815',
			),
			array (
			  'label' => 'سنخواست',
			  'persian_code' => 2826,
			  'code' => '2816',
			),
			array (
			  'label' => 'شوقان',
			  'persian_code' => 3015,
			  'code' => '2817',
			),
			array (
			  'label' => 'صفی آباد',
			  'persian_code' => 4677,
			  'code' => '2818',
			),
			array (
			  'label' => 'قاضی',
			  'persian_code' => 2824,
			  'code' => '2819',
			),
			array (
			  'label' => 'لوجلی',
			  'persian_code' => 3017,
			  'code' => '2820',
			),
			array (
			  'label' => 'اروندکنار',
			  'persian_code' => 3075,
			  'code' => '0628',
			),
			array (
			  'label' => 'بستان',
			  'persian_code' => 4668,
			  'code' => '0631',
			),
			array (
			  'label' => 'بندرامام خمینی',
			  'persian_code' => 4630,
			  'code' => '0633',
			),
			array (
			  'label' => 'جایزان',
			  'persian_code' => 4647,
			  'code' => '0637',
			),
			array (
			  'label' => 'چمران',
			  'persian_code' => 4092,
			  'code' => '0643',
			),
			array (
			  'label' => 'حسینیه',
			  'persian_code' => 4692,
			  'code' => '0649',
			),
			array (
			  'label' => 'دارخوین',
			  'persian_code' => 4657,
			  'code' => '0653',
			),
			array (
			  'label' => 'دهدز',
			  'persian_code' => 4655,
			  'code' => '0657',
			),
			array (
			  'label' => 'رفیع',
			  'persian_code' => 4667,
			  'code' => '0659',
			),
			array (
			  'label' => 'زهره',
			  'persian_code' => 5599,
			  'code' => '0661',
			),
			array (
			  'label' => 'سالند',
			  'persian_code' => 5601,
			  'code' => '0663',
			),
			array (
			  'label' => 'شرافت',
			  'persian_code' => 5600,
			  'code' => '0673',
			),
			array (
			  'label' => 'شیبان',
			  'persian_code' => 5597,
			  'code' => '0675',
			),
			array (
			  'label' => 'صالح شهر',
			  'persian_code' => 4631,
			  'code' => '0677',
			),
			array (
			  'label' => 'صیدون',
			  'persian_code' => 4650,
			  'code' => '0683',
			),
			array (
			  'label' => 'قلعه تل',
			  'persian_code' => 4652,
			  'code' => '0685',
			),
			array (
			  'label' => 'قلعه خواجه',
			  'persian_code' => 3869,
			  'code' => '0687',
			),
			array (
			  'label' => 'گوریه',
			  'persian_code' => 4670,
			  'code' => '0689',
			),
			array (
			  'label' => 'ملاثانی',
			  'persian_code' => 3076,
			  'code' => '0695',
			),
			array (
			  'label' => 'مینوشهر',
			  'persian_code' => 4660,
			  'code' => '0901',
			),
			array (
			  'label' => 'ویس',
			  'persian_code' => 5598,
			  'code' => '0902',
			),
			array (
			  'label' => 'هفتگل',
			  'persian_code' => 4699,
			  'code' => '0903',
			),
			array (
			  'label' => 'چورزق',
			  'persian_code' => 3204,
			  'code' => '1914',
			),
			array (
			  'label' => 'حلب',
			  'persian_code' => 3205,
			  'code' => '1915',
			),
			array (
			  'label' => 'دندی',
			  'persian_code' => 4232,
			  'code' => '1916',
			),
			array (
			  'label' => 'زرین رود',
			  'persian_code' => 3208,
			  'code' => '1918',
			),
			array (
			  'label' => 'سجاس',
			  'persian_code' => 4245,
			  'code' => '1919',
			),
			array (
			  'label' => 'سهرورد',
			  'persian_code' => 4243,
			  'code' => '1920',
			),
			array (
			  'label' => 'صائین قلعه',
			  'persian_code' => 4241,
			  'code' => '1921',
			),
			array (
			  'label' => 'قیدار',
			  'persian_code' => 3654,
			  'code' => '1922',
			),
			array (
			  'label' => 'گرماب',
			  'persian_code' => 3198,
			  'code' => '1923',
			),
			array (
			  'label' => 'امیریه',
			  'persian_code' => 4122,
			  'code' => '2009',
			),
			array (
			  'label' => 'ایوانکی',
			  'persian_code' => 3610,
			  'code' => '2010',
			),
			array (
			  'label' => 'بسطام',
			  'persian_code' => 3612,
			  'code' => '2011',
			),
			array (
			  'label' => 'بیارجمند',
			  'persian_code' => 3614,
			  'code' => '2012',
			),
			array (
			  'label' => 'درجزین',
			  'persian_code' => 3935,
			  'code' => '2013',
			),
			array (
			  'label' => 'دیباج',
			  'persian_code' => 3990,
			  'code' => '2014',
			),
			array (
			  'label' => 'شهمیرزاد',
			  'persian_code' => 3608,
			  'code' => '2015',
			),
			array (
			  'label' => 'کلاته خیج',
			  'persian_code' => 3966,
			  'code' => '2016',
			),
			array (
			  'label' => 'مجن',
			  'persian_code' => 3613,
			  'code' => '2017',
			),
			array (
			  'label' => 'ادیمی',
			  'persian_code' => 5432,
			  'code' => '1121',
			),
			array (
			  'label' => 'اسپکه',
			  'persian_code' => 5466,
			  'code' => '1122',
			),
			array (
			  'label' => 'بزمان',
			  'persian_code' => 5472,
			  'code' => '1123',
			),
			array (
			  'label' => 'بنت',
			  'persian_code' => 5468,
			  'code' => '1124',
			),
			array (
			  'label' => 'بنجار',
			  'persian_code' => 5438,
			  'code' => '1125',
			),
			array (
			  'label' => 'پیشین',
			  'persian_code' => 5463,
			  'code' => '1126',
			),
			array (
			  'label' => 'جالق',
			  'persian_code' => 5476,
			  'code' => '1127',
			),
			array (
			  'label' => 'راسک',
			  'persian_code' => 5462,
			  'code' => '1130',
			),
			array (
			  'label' => 'سیرکان',
			  'persian_code' => 5477,
			  'code' => '1134',
			),
			array (
			  'label' => 'گشت',
			  'persian_code' => 4143,
			  'code' => '1136',
			),
			array (
			  'label' => 'محمد آباد',
			  'persian_code' => 5300,
			  'code' => '1139',
			),
			array (
			  'label' => 'محمدی',
			  'persian_code' => 5474,
			  'code' => '1140',
			),
			array (
			  'label' => 'نصرت آباد',
			  'persian_code' => 3046,
			  'code' => '1141',
			),
			array (
			  'label' => 'نگور',
			  'persian_code' => 5488,
			  'code' => '1142',
			),
			array (
			  'label' => 'اردکان',
			  'persian_code' => 3008,
			  'code' => '0730',
			),
			array (
			  'label' => 'اشکنان',
			  'persian_code' => 3274,
			  'code' => '0732',
			),
			array (
			  'label' => 'افزر',
			  'persian_code' => 3299,
			  'code' => '0733',
			),
			array (
			  'label' => 'اوز',
			  'persian_code' => 3268,
			  'code' => '0735',
			),
			array (
			  'label' => 'ایج',
			  'persian_code' => 3280,
			  'code' => '0737',
			),
			array (
			  'label' => 'ایزدخواست',
			  'persian_code' => 3262,
			  'code' => '0738',
			),
			array (
			  'label' => 'آباده طشک',
			  'persian_code' => 3313,
			  'code' => '0739',
			),
			array (
			  'label' => 'باب انار',
			  'persian_code' => 3265,
			  'code' => '0740',
			),
			array (
			  'label' => 'بالاده',
			  'persian_code' => 4841,
			  'code' => '0741',
			),
			array (
			  'label' => 'بنارویه',
			  'persian_code' => 3271,
			  'code' => '0742',
			),
			array (
			  'label' => 'بهمن',
			  'persian_code' => 5574,
			  'code' => '0743',
			),
			array (
			  'label' => 'بیرم',
			  'persian_code' => 3273,
			  'code' => '0744',
			),
			array (
			  'label' => 'بیضا',
			  'persian_code' => 4858,
			  'code' => '0745',
			),
			array (
			  'label' => 'جویم',
			  'persian_code' => 3270,
			  'code' => '0747',
			),
			array (
			  'label' => 'خاوران',
			  'persian_code' => 3320,
			  'code' => '0752',
			),
			array (
			  'label' => 'خشت',
			  'persian_code' => 4836,
			  'code' => '0753',
			),
			array (
			  'label' => 'داریان',
			  'persian_code' => 4811,
			  'code' => '0756',
			),
			array (
			  'label' => 'دژکرد',
			  'persian_code' => 4878,
			  'code' => '0758',
			),
			array (
			  'label' => 'دهرم',
			  'persian_code' => 3302,
			  'code' => '0761',
			),
			array (
			  'label' => 'رونیز',
			  'persian_code' => 3278,
			  'code' => '0763',
			),
			array (
			  'label' => 'زاهدشهر',
			  'persian_code' => 3293,
			  'code' => '0764',
			),
			array (
			  'label' => 'زرقان',
			  'persian_code' => 3124,
			  'code' => '0765',
			),
			array (
			  'label' => 'سده',
			  'persian_code' => 4876,
			  'code' => '0766',
			),
			array (
			  'label' => 'سورمق',
			  'persian_code' => 3261,
			  'code' => '0768',
			),
			array (
			  'label' => 'سیدان',
			  'persian_code' => 4869,
			  'code' => '0769',
			),
			array (
			  'label' => 'ششده',
			  'persian_code' => 3291,
			  'code' => '0770',
			),
			array (
			  'label' => 'صغاد',
			  'persian_code' => 4880,
			  'code' => '0773',
			),
			array (
			  'label' => 'فدامی',
			  'persian_code' => 3309,
			  'code' => '0777',
			),
			array (
			  'label' => 'قادرآباد',
			  'persian_code' => 4867,
			  'code' => '0778',
			),
			array (
			  'label' => 'قائمیه',
			  'persian_code' => 3123,
			  'code' => '0779',
			),
			array (
			  'label' => 'قطب آباد',
			  'persian_code' => 3283,
			  'code' => '0780',
			),
			array (
			  'label' => 'قطرویه',
			  'persian_code' => 3318,
			  'code' => '0781',
			),
			array (
			  'label' => 'قیر',
			  'persian_code' => 3300,
			  'code' => '0782',
			),
			array (
			  'label' => 'کنارتخته',
			  'persian_code' => 4835,
			  'code' => '0786',
			),
			array (
			  'label' => 'کوهنجان',
			  'persian_code' => 4817,
			  'code' => '0787',
			),
			array (
			  'label' => 'لپوئی',
			  'persian_code' => 4842,
			  'code' => '0790',
			),
			array (
			  'label' => 'لطیفی',
			  'persian_code' => 3272,
			  'code' => '0791',
			),
			array (
			  'label' => 'مبارک آباد',
			  'persian_code' => 3297,
			  'code' => '0792',
			),
			array (
			  'label' => 'مشکان',
			  'persian_code' => 3317,
			  'code' => '0793',
			),
			array (
			  'label' => 'میمند',
			  'persian_code' => 3298,
			  'code' => '0795',
			),
			array (
			  'label' => 'نوبندگان',
			  'persian_code' => 3290,
			  'code' => '0796',
			),
			array (
			  'label' => 'نودان',
			  'persian_code' => 4838,
			  'code' => '0798',
			),
			array (
			  'label' => 'نورآباد',
			  'persian_code' => 4649,
			  'code' => '0799',
			),
			array (
			  'label' => 'وراوی',
			  'persian_code' => 4833,
			  'code' => '0800',
			),
			array (
			  'label' => 'ارداق',
			  'persian_code' => 5602,
			  'code' => '2607',
			),
			array (
			  'label' => 'اسفرورین',
			  'persian_code' => 3894,
			  'code' => '2608',
			),
			array (
			  'label' => 'اقبالیه',
			  'persian_code' => 3596,
			  'code' => '2609',
			),
			array (
			  'label' => 'آبگرم',
			  'persian_code' => 3900,
			  'code' => '2611',
			),
			array (
			  'label' => 'بوئین زهرا',
			  'persian_code' => 3599,
			  'code' => '2612',
			),
			array (
			  'label' => 'بیدستان',
			  'persian_code' => 3877,
			  'code' => '2613',
			),
			array (
			  'label' => 'خاکعلی',
			  'persian_code' => 3889,
			  'code' => '2614',
			),
			array (
			  'label' => 'خرمدشت',
			  'persian_code' => 3789,
			  'code' => '2615',
			),
			array (
			  'label' => 'دانسفهان',
			  'persian_code' => 3896,
			  'code' => '2616',
			),
			array (
			  'label' => 'رازمیان',
			  'persian_code' => 3916,
			  'code' => '2617',
			),
			array (
			  'label' => 'سگزآباد',
			  'persian_code' => 3891,
			  'code' => '2618',
			),
			array (
			  'label' => 'سیردان',
			  'persian_code' => 3904,
			  'code' => '2619',
			),
			array (
			  'label' => 'شال',
			  'persian_code' => 3895,
			  'code' => '2620',
			),
			array (
			  'label' => 'کوهین',
			  'persian_code' => 3917,
			  'code' => '2623',
			),
			array (
			  'label' => 'محمدیه',
			  'persian_code' => 3603,
			  'code' => '2624',
			),
			array (
			  'label' => 'معلم کلایه',
			  'persian_code' => 3882,
			  'code' => '2626',
			),
			array (
			  'label' => 'نرجه',
			  'persian_code' => 5603,
			  'code' => '2627',
			),
			array (
			  'label' => 'جعفریه',
			  'persian_code' => 2739,
			  'code' => '2502',
			),
			array (
			  'label' => 'دستجرد',
			  'persian_code' => 3975,
			  'code' => '2503',
			),
			array (
			  'label' => 'سلفچگان',
			  'persian_code' => 4002,
			  'code' => '2504',
			),
			array (
			  'label' => 'قنوات',
			  'persian_code' => 3617,
			  'code' => '2505',
			),
			array (
			  'label' => 'کهک',
			  'persian_code' => 3997,
			  'code' => '2506',
			),
			array (
			  'label' => 'بلبان آباد',
			  'persian_code' => 3153,
			  'code' => '1213',
			),
			array (
			  'label' => 'بوئین سفلی',
			  'persian_code' => 3172,
			  'code' => '1214',
			),
			array (
			  'label' => 'چناره',
			  'persian_code' => 3159,
			  'code' => '1215',
			),
			array (
			  'label' => 'دزج',
			  'persian_code' => 3151,
			  'code' => '1216',
			),
			array (
			  'label' => 'دلبران',
			  'persian_code' => 3150,
			  'code' => '1217',
			),
			array (
			  'label' => 'زرینه',
			  'persian_code' => 3140,
			  'code' => '1218',
			),
			array (
			  'label' => 'سریش آباد',
			  'persian_code' => 3156,
			  'code' => '1219',
			),
			array (
			  'label' => 'شویشه',
			  'persian_code' => 5604,
			  'code' => '1220',
			),
			array (
			  'label' => 'صاحب',
			  'persian_code' => 3167,
			  'code' => '1221',
			),
			array (
			  'label' => 'کانی سور',
			  'persian_code' => 3175,
			  'code' => '1223',
			),
			array (
			  'label' => 'موچش',
			  'persian_code' => 3136,
			  'code' => '1224',
			),
			array (
			  'label' => 'یاسوکند',
			  'persian_code' => 3144,
			  'code' => '1225',
			),
			array (
			  'label' => 'اختیارآباد',
			  'persian_code' => 4940,
			  'code' => '0824',
			),
			array (
			  'label' => 'اندوهجرد',
			  'persian_code' => 4944,
			  'code' => '0827',
			),
			array (
			  'label' => 'باغین',
			  'persian_code' => 4939,
			  'code' => '0828',
			),
			array (
			  'label' => 'بروات',
			  'persian_code' => 3733,
			  'code' => '0829',
			),
			array (
			  'label' => 'بزنجان',
			  'persian_code' => 5018,
			  'code' => '0830',
			),
			array (
			  'label' => 'بهرمان',
			  'persian_code' => 4975,
			  'code' => '0831',
			),
			array (
			  'label' => 'پاریز',
			  'persian_code' => 3743,
			  'code' => '0832',
			),
			array (
			  'label' => 'جبالبارز',
			  'persian_code' => 5022,
			  'code' => '0833',
			),
			array (
			  'label' => 'جوپار',
			  'persian_code' => 4938,
			  'code' => '0834',
			),
			array (
			  'label' => 'جوزم',
			  'persian_code' => 4982,
			  'code' => '0835',
			),
			array (
			  'label' => 'چترود',
			  'persian_code' => 3742,
			  'code' => '0836',
			),
			array (
			  'label' => 'خاتون آباد',
			  'persian_code' => 3875,
			  'code' => '0837',
			),
			array (
			  'label' => 'خانوک',
			  'persian_code' => 4994,
			  'code' => '0838',
			),
			array (
			  'label' => 'خورسند',
			  'persian_code' => 4979,
			  'code' => '0839',
			),
			array (
			  'label' => 'درب بهشت',
			  'persian_code' => 5025,
			  'code' => '0840',
			),
			array (
			  'label' => 'دوساری',
			  'persian_code' => 5033,
			  'code' => '0841',
			),
			array (
			  'label' => 'دهج',
			  'persian_code' => 4983,
			  'code' => '0842',
			),
			array (
			  'label' => 'راین',
			  'persian_code' => 3734,
			  'code' => '0843',
			),
			array (
			  'label' => 'رودبار',
			  'persian_code' => 3646,
			  'code' => '0844',
			),
			array (
			  'label' => 'زنگی آباد',
			  'persian_code' => 4870,
			  'code' => '0846',
			),
			array (
			  'label' => 'زیدآباد',
			  'persian_code' => 5007,
			  'code' => '0847',
			),
			array (
			  'label' => 'سرچشمه',
			  'persian_code' => 3736,
			  'code' => '0848',
			),
			array (
			  'label' => 'شهداد',
			  'persian_code' => 4945,
			  'code' => '0849',
			),
			array (
			  'label' => 'کاظم آباد',
			  'persian_code' => 4999,
			  'code' => '0851',
			),
			array (
			  'label' => 'کشکوئیه',
			  'persian_code' => 4971,
			  'code' => '0852',
			),
			array (
			  'label' => 'گلباف',
			  'persian_code' => 3730,
			  'code' => '0854',
			),
			array (
			  'label' => 'گلزار',
			  'persian_code' => 5011,
			  'code' => '0855',
			),
			array (
			  'label' => 'لاله زار',
			  'persian_code' => 5012,
			  'code' => '0856',
			),
			array (
			  'label' => 'ماهان',
			  'persian_code' => 3729,
			  'code' => '0857',
			),
			array (
			  'label' => 'محی آباد',
			  'persian_code' => 5605,
			  'code' => '0859',
			),
			array (
			  'label' => 'مردهک',
			  'persian_code' => 5032,
			  'code' => '0860',
			),
			array (
			  'label' => 'نجف شهر',
			  'persian_code' => 5002,
			  'code' => '0861',
			),
			array (
			  'label' => 'نظام شهر',
			  'persian_code' => 4957,
			  'code' => '0862',
			),
			array (
			  'label' => 'نگار',
			  'persian_code' => 5010,
			  'code' => '0863',
			),
			array (
			  'label' => 'نودژ',
			  'persian_code' => 5037,
			  'code' => '0864',
			),
			array (
			  'label' => 'هجدک',
			  'persian_code' => 5000,
			  'code' => '0865',
			),
			array (
			  'label' => 'ازگله',
			  'persian_code' => 2773,
			  'code' => '0515',
			),
			array (
			  'label' => 'باینگان',
			  'persian_code' => 4715,
			  'code' => '0516',
			),
			array (
			  'label' => 'بیستون',
			  'persian_code' => 3182,
			  'code' => '0517',
			),
			array (
			  'label' => 'حمیل',
			  'persian_code' => 2762,
			  'code' => '0519',
			),
			array (
			  'label' => 'رباط',
			  'persian_code' => 2840,
			  'code' => '0520',
			),
			array (
			  'label' => 'سطر',
			  'persian_code' => 3195,
			  'code' => '0522',
			),
			array (
			  'label' => 'سومار',
			  'persian_code' => 4711,
			  'code' => '0523',
			),
			array (
			  'label' => 'کوزران',
			  'persian_code' => 2766,
			  'code' => '0526',
			),
			array (
			  'label' => 'گهواره',
			  'persian_code' => 2765,
			  'code' => '0527',
			),
			array (
			  'label' => 'میان راهان',
			  'persian_code' => 4743,
			  'code' => '0528',
			),
			array (
			  'label' => 'نودشه',
			  'persian_code' => 4717,
			  'code' => '0529',
			),
			array (
			  'label' => 'نوسود',
			  'persian_code' => 4716,
			  'code' => '0530',
			),
			array (
			  'label' => 'هلشی',
			  'persian_code' => 3179,
			  'code' => '0531',
			),
			array (
			  'label' => 'دهدشت',
			  'persian_code' => 3726,
			  'code' => '1712',
			),
			array (
			  'label' => 'دیشموک',
			  'persian_code' => 4919,
			  'code' => '1713',
			),
			array (
			  'label' => 'سوق',
			  'persian_code' => 4915,
			  'code' => '1714',
			),
			array (
			  'label' => 'قلعه رئیسی',
			  'persian_code' => 4920,
			  'code' => '1716',
			),
			array (
			  'label' => 'گراب سفلی',
			  'persian_code' => 4931,
			  'code' => '1717',
			),
			array (
			  'label' => 'لیکک',
			  'persian_code' => 4917,
			  'code' => '1718',
			),
			array (
			  'label' => 'مادوان',
			  'persian_code' => 3304,
			  'code' => '1719',
			),
			array (
			  'label' => 'مارگون',
			  'persian_code' => 4934,
			  'code' => '1720',
			),
			array (
			  'label' => 'اینچه برون',
			  'persian_code' => 4314,
			  'code' => '2716',
			),
			array (
			  'label' => 'جلین',
			  'persian_code' => 4366,
			  'code' => '2717',
			),
			array (
			  'label' => 'خان ببین',
			  'persian_code' => 4346,
			  'code' => '2718',
			),
			array (
			  'label' => 'دلند',
			  'persian_code' => 4347,
			  'code' => '2719',
			),
			array (
			  'label' => 'سیمین شهر',
			  'persian_code' => 4319,
			  'code' => '2721',
			),
			array (
			  'label' => 'فاضل آباد',
			  'persian_code' => 4339,
			  'code' => '2722',
			),
			array (
			  'label' => 'گمیش تپه',
			  'persian_code' => 4330,
			  'code' => '2723',
			),
			array (
			  'label' => 'نگین شهر',
			  'persian_code' => 4318,
			  'code' => '2725',
			),
			array (
			  'label' => 'نوده خاندوز',
			  'persian_code' => 4353,
			  'code' => '2726',
			),
			array (
			  'label' => 'نوکنده',
			  'persian_code' => 4313,
			  'code' => '2727',
			),
			array (
			  'label' => 'اسالم',
			  'persian_code' => 4165,
			  'code' => '0118',
			),
			array (
			  'label' => 'اطاقور',
			  'persian_code' => 4206,
			  'code' => '0119',
			),
			array (
			  'label' => 'توتکابن',
			  'persian_code' => 4195,
			  'code' => '0123',
			),
			array (
			  'label' => 'جیرنده',
			  'persian_code' => 4189,
			  'code' => '0124',
			),
			array (
			  'label' => 'چابکسر',
			  'persian_code' => 4211,
			  'code' => '0125',
			),
			array (
			  'label' => 'چوبر',
			  'persian_code' => 4141,
			  'code' => '0127',
			),
			array (
			  'label' => 'حویق',
			  'persian_code' => 4157,
			  'code' => '0128',
			),
			array (
			  'label' => 'خمام',
			  'persian_code' => 3637,
			  'code' => '0130',
			),
			array (
			  'label' => 'دیلمان',
			  'persian_code' => 4179,
			  'code' => '0131',
			),
			array (
			  'label' => 'رانکوه',
			  'persian_code' => 4210,
			  'code' => '0132',
			),
			array (
			  'label' => 'رحیم آباد',
			  'persian_code' => 4214,
			  'code' => '0133',
			),
			array (
			  'label' => 'رستم آباد',
			  'persian_code' => 4194,
			  'code' => '0134',
			),
			array (
			  'label' => 'رودبنه',
			  'persian_code' => 5607,
			  'code' => '0137',
			),
			array (
			  'label' => 'سنگر',
			  'persian_code' => 4127,
			  'code' => '0138',
			),
			array (
			  'label' => 'شلمان',
			  'persian_code' => 4202,
			  'code' => '0139',
			),
			array (
			  'label' => 'کلاچای',
			  'persian_code' => 3649,
			  'code' => '0140',
			),
			array (
			  'label' => 'کوچصفهان',
			  'persian_code' => 4134,
			  'code' => '0141',
			),
			array (
			  'label' => 'کومله',
			  'persian_code' => 4203,
			  'code' => '0142',
			),
			array (
			  'label' => 'کیاشهر',
			  'persian_code' => 4184,
			  'code' => '0143',
			),
			array (
			  'label' => 'لوشان',
			  'persian_code' => 4187,
			  'code' => '0146',
			),
			array (
			  'label' => 'لولمان',
			  'persian_code' => 4138,
			  'code' => '0147',
			),
			array (
			  'label' => 'لوندویل',
			  'persian_code' => 4169,
			  'code' => '0148',
			),
			array (
			  'label' => 'لیسار',
			  'persian_code' => 4155,
			  'code' => '0149',
			),
			array (
			  'label' => 'ماسوله',
			  'persian_code' => 4142,
			  'code' => '0150',
			),
			array (
			  'label' => 'مرجقل',
			  'persian_code' => 4145,
			  'code' => '0151',
			),
			array (
			  'label' => 'منجیل',
			  'persian_code' => 3645,
			  'code' => '0152',
			),
			array (
			  'label' => 'واجارگاه',
			  'persian_code' => 4213,
			  'code' => '0153',
			),
			array (
			  'label' => 'اشترینان',
			  'persian_code' => 4769,
			  'code' => '1512',
			),
			array (
			  'label' => 'چقابل',
			  'persian_code' => 4733,
			  'code' => '1516',
			),
			array (
			  'label' => 'درب گنبد',
			  'persian_code' => 4737,
			  'code' => '1517',
			),
			array (
			  'label' => 'زاغه',
			  'persian_code' => 4755,
			  'code' => '1518',
			),
			array (
			  'label' => 'سپیددشت',
			  'persian_code' => 4762,
			  'code' => '1519',
			),
			array (
			  'label' => 'سراب دوره',
			  'persian_code' => 4756,
			  'code' => '1520',
			),
			array (
			  'label' => 'شول آباد',
			  'persian_code' => 4749,
			  'code' => '1521',
			),
			array (
			  'label' => 'کونانی',
			  'persian_code' => 4735,
			  'code' => '1523',
			),
			array (
			  'label' => 'گراب',
			  'persian_code' => 4736,
			  'code' => '1524',
			),
			array (
			  'label' => 'معمولان',
			  'persian_code' => 4742,
			  'code' => '1525',
			),
			array (
			  'label' => 'هفت چشمه',
			  'persian_code' => 4414,
			  'code' => '1529',
			),
			array (
			  'label' => 'امیرکلا',
			  'persian_code' => 3662,
			  'code' => '0229',
			),
			array (
			  'label' => 'ایزدشهر',
			  'persian_code' => 5609,
			  'code' => '0230',
			),
			array (
			  'label' => 'آلاشت',
			  'persian_code' => 4275,
			  'code' => '0231',
			),
			array (
			  'label' => 'بلده',
			  'persian_code' => 3220,
			  'code' => '0232',
			),
			array (
			  'label' => 'بهنمیر',
			  'persian_code' => 4250,
			  'code' => '0233',
			),
			array (
			  'label' => 'چمستان',
			  'persian_code' => 3216,
			  'code' => '0236',
			),
			array (
			  'label' => 'خلیل شهر',
			  'persian_code' => 4307,
			  'code' => '0238',
			),
			array (
			  'label' => 'دابودشت',
			  'persian_code' => 4256,
			  'code' => '0240',
			),
			array (
			  'label' => 'رویان',
			  'persian_code' => 3969,
			  'code' => '0242',
			),
			array (
			  'label' => 'رینه',
			  'persian_code' => 3212,
			  'code' => '0243',
			),
			array (
			  'label' => 'زرگر محله',
			  'persian_code' => 4380,
			  'code' => '0244',
			),
			array (
			  'label' => 'زیرآب',
			  'persian_code' => 3667,
			  'code' => '0245',
			),
			array (
			  'label' => 'سرخرود',
			  'persian_code' => 3210,
			  'code' => '0246',
			),
			array (
			  'label' => 'سورک',
			  'persian_code' => 4294,
			  'code' => '0248',
			),
			array (
			  'label' => 'شیرود',
			  'persian_code' => 3247,
			  'code' => '0250',
			),
			array (
			  'label' => 'فریم',
			  'persian_code' => 4288,
			  'code' => '0251',
			),
			array (
			  'label' => 'کلارآباد',
			  'persian_code' => 3237,
			  'code' => '0253',
			),
			array (
			  'label' => 'کله بست',
			  'persian_code' => 4252,
			  'code' => '0254',
			),
			array (
			  'label' => 'کوهی خیل',
			  'persian_code' => 4271,
			  'code' => '0255',
			),
			array (
			  'label' => 'کیاسر',
			  'persian_code' => 3669,
			  'code' => '0256',
			),
			array (
			  'label' => 'گتاب',
			  'persian_code' => 4255,
			  'code' => '0258',
			),
			array (
			  'label' => 'گزنک',
			  'persian_code' => 3215,
			  'code' => '0259',
			),
			array (
			  'label' => 'مرزن آباد',
			  'persian_code' => 3231,
			  'code' => '0261',
			),
			array (
			  'label' => 'نشتارود',
			  'persian_code' => 3244,
			  'code' => '0263',
			),
			array (
			  'label' => 'آستانه',
			  'persian_code' => 3989,
			  'code' => '0014',
			),
			array (
			  'label' => 'پرندک',
			  'persian_code' => 4108,
			  'code' => '0015',
			),
			array (
			  'label' => 'توره',
			  'persian_code' => 4058,
			  'code' => '0016',
			),
			array (
			  'label' => 'داودآباد',
			  'persian_code' => 3870,
			  'code' => '0019',
			),
			array (
			  'label' => 'رازقان',
			  'persian_code' => 4086,
			  'code' => '0020',
			),
			array (
			  'label' => 'زاویه',
			  'persian_code' => 4091,
			  'code' => '0021',
			),
			array (
			  'label' => 'ساروق',
			  'persian_code' => 4038,
			  'code' => '0022',
			),
			array (
			  'label' => 'سنجان',
			  'persian_code' => 4048,
			  'code' => '0023',
			),
			array (
			  'label' => 'غرق آباد',
			  'persian_code' => 3629,
			  'code' => '0025',
			),
			array (
			  'label' => 'فرمهین',
			  'persian_code' => 4097,
			  'code' => '0026',
			),
			array (
			  'label' => 'قورچی باشی',
			  'persian_code' => 4072,
			  'code' => '0027',
			),
			array (
			  'label' => 'کرهرود',
			  'persian_code' => 4036,
			  'code' => '0028',
			),
			array (
			  'label' => 'میلاجرد',
			  'persian_code' => 4052,
			  'code' => '0030',
			),
			array (
			  'label' => 'نراق',
			  'persian_code' => 4033,
			  'code' => '0031',
			),
			array (
			  'label' => 'نوبران',
			  'persian_code' => 4083,
			  'code' => '0032',
			),
			array (
			  'label' => 'نیمور',
			  'persian_code' => 4024,
			  'code' => '0033',
			),
			array (
			  'label' => 'هندودر',
			  'persian_code' => 4065,
			  'code' => '0034',
			),
			array (
			  'label' => 'جناح',
			  'persian_code' => 5071,
			  'code' => '2219',
			),
			array (
			  'label' => 'درگهان',
			  'persian_code' => 5059,
			  'code' => '2221',
			),
			array (
			  'label' => 'رویدر',
			  'persian_code' => 5069,
			  'code' => '2223',
			),
			array (
			  'label' => 'سندرک',
			  'persian_code' => 5081,
			  'code' => '2227',
			),
			array (
			  'label' => 'سوزا',
			  'persian_code' => 5060,
			  'code' => '2228',
			),
			array (
			  'label' => 'فارغان',
			  'persian_code' => 5049,
			  'code' => '2229',
			),
			array (
			  'label' => 'فین',
			  'persian_code' => 5047,
			  'code' => '2230',
			),
			array (
			  'label' => 'کنگ',
			  'persian_code' => 5067,
			  'code' => '2232',
			),
			array (
			  'label' => 'گوهران',
			  'persian_code' => 5084,
			  'code' => '2234',
			),
			array (
			  'label' => 'هرمز',
			  'persian_code' => 5061,
			  'code' => '2235',
			),
			array (
			  'label' => 'هشتبندی',
			  'persian_code' => 5513,
			  'code' => '2236',
			),
			array (
			  'label' => 'ازندریان',
			  'persian_code' => 2756,
			  'code' => '1310',
			),
			array (
			  'label' => 'جورقان',
			  'persian_code' => 3128,
			  'code' => '1312',
			),
			array (
			  'label' => 'جوکار',
			  'persian_code' => 2737,
			  'code' => '1313',
			),
			array (
			  'label' => 'دمق',
			  'persian_code' => 2729,
			  'code' => '1314',
			),
			array (
			  'label' => 'زنگنه',
			  'persian_code' => 2734,
			  'code' => '1315',
			),
			array (
			  'label' => 'سامن',
			  'persian_code' => 2735,
			  'code' => '1316',
			),
			array (
			  'label' => 'سرکان',
			  'persian_code' => 2740,
			  'code' => '1317',
			),
			array (
			  'label' => 'شیرین سو',
			  'persian_code' => 2722,
			  'code' => '1318',
			),
			array (
			  'label' => 'فیروزان',
			  'persian_code' => 2751,
			  'code' => '1321',
			),
			array (
			  'label' => 'قهاوند',
			  'persian_code' => 2725,
			  'code' => '1323',
			),
			array (
			  'label' => 'گل تپه',
			  'persian_code' => 2723,
			  'code' => '1324',
			),
			array (
			  'label' => 'گیان',
			  'persian_code' => 2749,
			  'code' => '1325',
			),
			array (
			  'label' => 'لالجین',
			  'persian_code' => 4703,
			  'code' => '1326',
			),
			array (
			  'label' => 'مریانج',
			  'persian_code' => 2711,
			  'code' => '1327',
			),
			array (
			  'label' => 'احمدآباد',
			  'persian_code' => 3977,
			  'code' => '2112',
			),
			array (
			  'label' => 'بفروئیه',
			  'persian_code' => 5278,
			  'code' => '2114',
			),
			array (
			  'label' => 'حمیدیا',
			  'persian_code' => 5610,
			  'code' => '2115',
			),
			array (
			  'label' => 'دیهوک',
			  'persian_code' => 5403,
			  'code' => '2117',
			),
			array (
			  'label' => 'زارچ',
			  'persian_code' => 5305,
			  'code' => '2118',
			),
			array (
			  'label' => 'شاهدیه',
			  'persian_code' => 5268,
			  'code' => '2119',
			),
			array (
			  'label' => 'مروست',
			  'persian_code' => 5291,
			  'code' => '2123',
			),
			array (
			  'label' => 'مهردشت',
			  'persian_code' => 5266,
			  'code' => '2124',
			),
			array (
			  'label' => 'ندوشن',
			  'persian_code' => 5272,
			  'code' => '2125',
			),
			array (
			  'label' => 'پرند',
			  'persian_code' => 4009,
			  'code' => '2322',
			),
			array (
			  'label' => 'هرند',
			  'persian_code' => 5539,
			  'code' => '1025',
			),
			array (
			  'label' => 'هیدج',
			  'persian_code' => 4240,
			  'code' => '1911',
			),
			array (
			  'label' => 'کندوان',
			  'persian_code' => 4457,
			  'code' => '0368',
			),
			array (
			  'label' => 'سپاهان شهر',
			  'persian_code' => 5218,
			  'code' => '2574',
			),
			array (
			  'label' => 'خسروی',
			  'persian_code' => 4709,
			  'code' => '0532',
			),
			array (
			  'label' => 'اچاچی',
			  'persian_code' => 4389,
			  'code' => '3500',
			),
			array (
			  'label' => 'تیمورلو',
			  'persian_code' => 4409,
			  'code' => '3501',
			),
			array (
			  'label' => 'نازک علیا',
			  'persian_code' => 2978,
			  'code' => '3506',
			),
			array (
			  'label' => 'قصابه',
			  'persian_code' => 4536,
			  'code' => '3508',
			),
			array (
			  'label' => 'گلسار',
			  'persian_code' => 3850,
			  'code' => '3520',
			),
			array (
			  'label' => 'بادوله',
			  'persian_code' => 4894,
			  'code' => '3525',
			),
			array (
			  'label' => 'دشتک',
			  'persian_code' => 5255,
			  'code' => '3538',
			),
			array (
			  'label' => 'هارونی',
			  'persian_code' => 2999,
			  'code' => '3545',
			),
			array (
			  'label' => 'زیارت',
			  'persian_code' => 2839,
			  'code' => '3549',
			),
			array (
			  'label' => 'ابوحمیظه',
			  'persian_code' => 4664,
			  'code' => '3553',
			),
			array (
			  'label' => 'گلگیر',
			  'persian_code' => 4702,
			  'code' => '3565',
			),
			array (
			  'label' => 'منصوریه',
			  'persian_code' => 4638,
			  'code' => '3566',
			),
			array (
			  'label' => 'کرسف',
			  'persian_code' => 4244,
			  'code' => '3568',
			),
			array (
			  'label' => 'نیک پی',
			  'persian_code' => 4231,
			  'code' => '3570',
			),
			array (
			  'label' => 'خانیمن',
			  'persian_code' => 4865,
			  'code' => '3575',
			),
			array (
			  'label' => 'قره بلاغ',
			  'persian_code' => 4387,
			  'code' => '3578',
			),
			array (
			  'label' => 'بلوک',
			  'persian_code' => 5035,
			  'code' => '3587',
			),
			array (
			  'label' => 'بلورد',
			  'persian_code' => 5003,
			  'code' => '3588',
			),
			array (
			  'label' => 'ریجاب',
			  'persian_code' => 2763,
			  'code' => '3594',
			),
			array (
			  'label' => 'تاتارعلیا',
			  'persian_code' => 4357,
			  'code' => '3597',
			),
			array (
			  'label' => 'کجور',
			  'persian_code' => 3227,
			  'code' => '3608',
			),
			array (
			  'label' => 'اجین',
			  'persian_code' => 2716,
			  'code' => '3620',
			),
		);
	}

	public static function get_province_by_code($code) {
		$provinces = self::get_provinces();
		foreach ($provinces as $province) {
			if ($province['code'] == $code) {
				return $province;
			}
		}
		return false;
	}


	public static function get_city_by_persian_code( $persian_Code ) {
		$cities = self::get_cities();
		foreach ( $cities as $city ) {
			if ( $city['persian_code'] == $persian_Code ) {
				return $city;
			}
		}
		return false;
	}

	public static function get_city_by_name( $city_name ) {
		$cities = self::get_cities();
		foreach ( $cities as $city ) {
			if ( $city['label'] == $city_name ) {
				return $city;
			}
		}
		return false;
	}
}




