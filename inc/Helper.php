<?php

namespace WP_PODRO\Engine;

class Helper
{
	public static function sanitize_recursive(&$input, $sanitizer){
		if (empty($input))
			return;
		if( !is_array($input) ) {

			$input = call_user_func($sanitizer, $input);

		}
		else{
			foreach ($input as $key => &$item){
				self::sanitize_recursive($item, $sanitizer);

			}
		}

	}

	public static function log($var){
		file_put_contents(dirname(__FILE__) . '/log.txt', print_r($var, true));
	}
}
