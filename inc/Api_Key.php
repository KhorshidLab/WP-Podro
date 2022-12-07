<?php
namespace WP_PODRO\Engine;

use WP_Encryption\Encryption;
use WP_PODRO\Engine\API\V1\Auth;


/**
 *
 * @since      0.0.2
 * @package   WP_PODRO
 * @author    Khorshid <info@khorshidlab.com>
 * @license   GPL-3.0+
 * @link      https://github.com/KhorshidLab/WP-Podro
 */

class Api_Key {

	/**
	 * check and validate api key by sending request to Podro
	 *
	 * @param string $api_key
	 * @return boolean
    */
    private static function validate_api_key(string $email, string $password) {

		$response = (new Auth())->Login($email, $password);


		if ( !$response ) {
			add_action( 'admin_notices', function (){
				echo wp_kses_post('<div class="notice notice-error is-dismissible">
					<p>'. esc_html__( 'کاربر غیر مجاز است.', 'wp-podro' ) .'</p>
				</div>');
			} );
		}

		$http_code = $response['status_code'];

		if ($http_code == 500) {
			add_action( 'admin_notices', function () {
				echo wp_kses_post('<div class="notice notice-error is-dismissible">
						<p>'. esc_html__( 'پادرو در حال حاضر پاسخی نمی دهد. لطفا بعدا دوباره امتحان کنید', 'wp-podro' ) .'</p>
					</div>');
			} );
		} else if ($http_code == 401) {
			add_action( 'admin_notices', function () {
				echo wp_kses_post('<div class="notice notice-error is-dismissible">
					<p>'. esc_html__( 'کلید Podro API نامعتبر است. لطفا دوباره تلاش کنید.', 'wp-podro' ) .'</p>
				</div>');
			} );

			self::reset_api_key();
		} else if ($http_code != 200) {
			add_action( 'admin_notices', function () use ($response) {
				echo wp_kses_post('<div class="notice notice-error is-dismissible">
					<p>'. esc_html__( $response['message'] ) .'</p>
				</div>');
			} );

			self::reset_api_key();
		}

		if ($http_code == 200) {
			return $response['access_token'];
		} else {
			return false;
		}
	}

    /**
	 * Sets the access control system and saves it to an option after encryption
	 *
	 * @since 0.0.1
	 * @return void
    */
	public static function set_pdo_api_key() {



		if(  isset( $_POST[ 'config_podro_api_key' ] ) ) {
			$pdo_email = sanitize_email( $_POST[ 'pdo_email' ] );
			$pdo_password = sanitize_text_field( $_POST[ 'pdo_password' ] );
			if ( $pdo_email == null || $pdo_password == null || ( ! empty( $pdo_email ) && !empty( $pdo_password ) && $pdo_password === "**************" ) ) {
				add_action( 'admin_notices', function () {
					echo wp_kses_post('<div class="notice notice-error is-dismissible">
						<p>'. esc_html__( "لطفا موارد موردنیاز را وارد کنید.", 'wp-podro' ) .'</p>
					</div>');
				} );
				return false;
			}

			if ( !$token = self::validate_api_key( $pdo_email, (new Encryption)->encrypt($pdo_password) ) ) {
				return false;
			}

			$save_settings = update_option( 'podro_api_key', (new Encryption)->encrypt($token) );

			if( $save_settings ) {
				update_option( 'podro_plugin_status', 'connected');
				update_option( 'podro_plugin_credentials', [
					'email' => $pdo_email,
					'password' => (new Encryption)->encrypt($pdo_password),
				]);

				wp_redirect( home_url( '/wp-admin/admin.php?page=' . PODRO_SETTINGS_PAGE_SLUG ) );

				add_action( 'admin_notices', function () {
					echo wp_kses_post('<div class="notice notice-success is-dismissible">
						<p>'. esc_html__( "تنظیمات ذخیره شد.", 'wp-podro' ) .'</p>
					</div>');
				} );
			}
		}else if( isset($_POST['config_podro_store_info']) ){

			if( empty($_POST['podro_store_name']) || empty($_POST['podro_store_address']) ){
				add_action( 'admin_notices', function () {
					echo wp_kses_post('<div class="notice notice-error is-dismissible">
						<p>'. esc_html__( "نام فروشگاه، شهرو آدرس نمی تواند خالی باشد", 'wp-podro' ) .'</p>
					</div>');
				} );
				return false;
			}

			update_option('podro_store_name', sanitize_text_field($_POST['podro_store_name']??''));
			update_option('podro_store_city', sanitize_text_field($_POST['podro_store_city']??''));
			update_option('podro_store_address', sanitize_text_field($_POST['podro_store_address']??''));


			add_action( 'admin_notices', function () {
				echo wp_kses_post('<div class="notice notice-success is-dismissible">
						<p>'. esc_html__( "تنظیمات ذخیره شد.", 'wp-podro' ) .'</p>
					</div>');
			});
		}


	}

	/**
	 * Get Podro Api key
	 *
	 * @return string
	 */
	public static function get_pdo_api_key() {
    	$api_key = get_option( 'podro_api_key' );

		if( empty( $api_key ) ) {
			return;
		}
		return (new Encryption)->decrypt( $api_key );
	}


	/**
	 * reset plugin by delete api key and status
	 *
	 * @return void
	 */
	public static function reset_api_key() {
		delete_option( 'podro_plugin_status' );
		delete_option( 'podro_plugin_credentials' );
		delete_option( 'podro_api_key' );
	}
}
