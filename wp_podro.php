<?php

/**
 * @package   WP_PODRO
 * @license   GPL-3.0+
 *
 * Plugin Name:     WP PODRO
 * Plugin URI:      https://github.com/KhorshidLab/WP-Podro
 * Description:     @TODO
 * Version:         0.0.2
 * Author:          Khorshid
 * Author URI:      https://khorshidlab.com
 * Text Domain:     plugin_textdomain
 * License:         GPL-3.0+
 * License URI:     http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:     /languages
 * Requires PHP:    7.0
 */

// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
	die( 'We\'re sorry, but you can not directly access this file.' );
}

define( 'POD_VERSION', '0.0.2' );
define( 'POD_TEXTDOMAIN', 'wp_podro' );
define( 'POD_NAME', 'WP PODRO' );
define( 'POD_PLUGIN_ROOT', plugin_dir_path( __FILE__ ) );
define( 'POD_PLUGIN_ABSOLUTE', __FILE__ );
define( 'POD_PLUGIN_ROOT_URL', plugin_dir_url( __FILE__ ) );
define( 'POD_MIN_PHP_VERSION', '7.0' );
define( 'POD_WP_VERSION', '5.3' );

function write_log( $log ) {
	if ( is_array( $log ) || is_object( $log ) ) {
		error_log( print_r( $log, true ) );
	} else {
		error_log( $log );
	}
}

add_action(
	'init',
	static function () {
		load_plugin_textdomain( POD_TEXTDOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
	);

if ( version_compare( PHP_VERSION, POD_MIN_PHP_VERSION, '<=' ) ) {
	add_action(
		'admin_init',
		static function() {
			deactivate_plugins( plugin_basename( __FILE__ ) );
		}
	);
	add_action(
		'admin_notices',
		static function() {
			echo wp_kses_post(
				sprintf(
					'<div class="notice notice-error"><p>%s</p></div>',
					__( '"Plugin Name" requires PHP 5.6 or newer.', POD_TEXTDOMAIN )
				)
			);
		}
	);

	// Return early to prevent loading the plugin.
	return;
}
require_once(POD_PLUGIN_ROOT . 'vendor/autoload.php');
new WP_PODRO\Engine\Setup;
