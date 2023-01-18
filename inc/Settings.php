<?php
namespace WP_PODRO\Engine;

class Settings {

	public function __construct(){
		add_filter( 'auto_update_plugin', [$this,'check_auto_update'], 10, 2 );
	}

	public function check_auto_update($update, $item) {
		

		$podro_auto_update = get_option('podro_auto_update', 'no');
		if('yes' == $podro_auto_update){
			return $this->do_enable_auto_update($update, $item);
		}
	}

	private function do_enable_auto_update($update, $item)
	{

		$plugins = array (
			PODRO_SLUG,
		);
		if ( in_array( $item->slug, $plugins ) ) {
			return true; // Always update plugins in this array
		} else {
			return $update; // Else, use the normal API response to decide whether to update or not
		}

	}

}
