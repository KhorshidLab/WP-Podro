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

	public static function are_we_in_podro_setting(){
		if(isset($_GET['page']) && $_GET['page'] == PODRO_SLUG . '-settings')
			return true;
		return false;
}

	public static function log($var){
		file_put_contents(dirname(__DIR__) . '/log.txt', print_r($var,true),FILE_APPEND);
	}
}
