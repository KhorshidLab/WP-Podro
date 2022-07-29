<?php
namespace WP_PODRO\Engine;

class Settings {
	public function save_settings() {
		if( ! isset( $_POST[ 'save_podro_settings' ] ) ) {
			return;
		}

		$pdo_email = sanitize_email( $_POST[ 'pdo_email' ] );
	}

}
