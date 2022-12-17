<?php

/**
 * @package   PODRO_WP
 * @license   GPL-3.0+
 * @link      https://khorshidlab.com
 *
 * @wordpress-plugin
 * Plugin Name:     Podro WP
 * Plugin URI:      https://khorshidlab.com/
 * Description:     پادروپین؛ ‌مارکت‌پلیس خدمات پستی است و به فروشگاه‌های آنلاین کمک می‌کند تا فرآیند ارسال سفارش‌های اینترنتی را مدیریت کنند. در پادروپین، بدون مراجعه و یا ثبت قرارداد با شرکت‌های پستی، می‌توان سفارش‌های اینترنتی را با هر یک از شرکت‌های پستی ارسال کرد
 * Version:         1.0.4
 * Author:          Khorshid, Podro
 * Author URI:      https://khorshidlab.com/fa/
 * Text Domain:     podro-wp
 * License:         GPL-3.0+
 * License URI:     http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:     /languages
 * Requires PHP:    7.2
 * Github:      		https://github.com/KhorshidLab/WP-Podro
 */

// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
	die( 'We\'re sorry, but you can not directly access this file.' );
}

if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	add_action('admin_notices', function(){
		echo '<div class="notice notice-error is-dismissible"><strong>'. esc_html('پادرو:', 'podro-wp') . '</strong><p>'. esc_html('برای کار با پادرو نیاز هست ووکامرس نصب و فعال باشد ', 'podro-wp'). '</p></div>';
	});
	return;
}

/**
 * Currently plugin version.
 */

define( 'PODRO_VERSION', '1.0.4' );
define( 'PODRO_SLUG', 'podro-wp' );
define( 'PODRO_NAME', 'WP PODRO' );
define( 'PODRO_PLUGIN_ROOT', plugin_dir_path( __FILE__ ) );
define( 'PODRO_PLUGIN_ABSOLUTE', __FILE__ );
define( 'PODRO_PLUGIN_ROOT_URL', plugin_dir_url( __FILE__ ) );
define( 'PODRO_MIN_PHP_VERSION', '7.2' );
define( 'PODRO_WP_VERSION', '5.3' );

add_action(
	'init',
	static function () {
		load_plugin_textdomain( 'podro-wp', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
);

if ( version_compare( PHP_VERSION, PODRO_MIN_PHP_VERSION, '<=' ) ) {
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
					esc_html__( 'WP-Podro requires PHP 7.2 or newer.', 'podro-wp' )
				)
			);
		}
	);

	// Return early to prevent loading the plugin.
	return;
}

require_once(PODRO_PLUGIN_ROOT . 'vendor/autoload.php');
if ( class_exists('WC_Payment_Gateway') ) {
	$GLOBALS['wc_city_select'] = new WP_PODRO\Engine\WC_City_Select();
}
$Setup = new WP_PODRO\Engine\Setup;
add_action('admin_init', function(){
	\WP_PODRO\Engine\WooSetting::get_instance();
});
