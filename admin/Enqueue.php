<?php

/**
 * WP_PODRO
 *
 * @package   WP_PODRO
 * @author    Khorshid <info@khorshidlab.com>
 * @license   GPL-3.0+
 */

namespace WP_PODRO\Admin;

use WP_PODRO\Engine\Helper;
use WP_PODRO\Engine\WC_City_Select;
use WP_PODRO\Engine\WooSetting;
use WP_PODRO\Engine\WooZones;

/**
 * This class contain the Enqueue stuff for the backend
 */
class Enqueue {

	/**
	 * Initialize the class.
	 *
	 * @return void|bool
	 */
	public function initialize() {

		\add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		\add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		\add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_public_styles' ) );
		if('yes' == get_option('podro_province_position', 'no')) {
			\add_action('wp_enqueue_scripts', function () {
				\wp_enqueue_script(PODRO_SLUG . '-admin-scripts', \plugins_url('assets/js/province-first.js', PODRO_PLUGIN_ABSOLUTE), array('jquery'), PODRO_VERSION, true);
			});
		}
		add_action('woocommerce_before_checkout_process', function(){

			if(self::only_podro_shippment_available() && class_exists('PWS_Core')){
				remove_filter('woocommerce_checkout_process', [\PWS_Core::instance(), 'checkout_process'], 20, 1);
			}

		},22);

	}






	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since 0.0.1
	 * @return void
	 */
	public function enqueue_admin_styles() {
		$admin_page = \get_current_screen();

		\wp_enqueue_style( PODRO_SLUG.'-admin-styles', \plugins_url( 'assets/css/admin.css', PODRO_PLUGIN_ABSOLUTE ), array( 'dashicons' ), PODRO_VERSION );
		if(Helper::are_we_in_podro_setting())
			\wp_enqueue_style( PODRO_SLUG.'-select2-styles', \plugins_url( 'assets/css/select2.min.css', PODRO_PLUGIN_ABSOLUTE ), array( 'dashicons' ), PODRO_VERSION );

	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since
	 * @return void
	 */
	public function enqueue_admin_scripts() {
		\wp_enqueue_script( PODRO_SLUG.'-admin-scripts', \plugins_url( 'assets/js/admin.js', PODRO_PLUGIN_ABSOLUTE ), array( 'jquery' ), PODRO_VERSION, true );
		if(Helper::are_we_in_podro_setting())
			\wp_enqueue_script( PODRO_SLUG.'-select2-js', \plugins_url( 'assets/js/select2.min.js', PODRO_PLUGIN_ABSOLUTE ), array( 'jquery' ), PODRO_VERSION, true );

		\wp_localize_script(
			PODRO_SLUG . '-admin-scripts',
			'wp_podro_ajax_object',
			[
				'ajax_url'  => admin_url( 'admin-ajax.php' ),
				'security'  => wp_create_nonce( 'pod-options-nonce' ),
				'is_rtl'=> is_rtl(),
				'strings'	  => [
				],
			],
		);
		\wp_localize_script(
			PODRO_SLUG . '-admin-scripts',
			'wp_podro_assets_url',
			[
				'assets_url'  => \plugins_url( 'assets/' ,PODRO_PLUGIN_ABSOLUTE),

			],
		);
	}

	public function enqueue_public_styles() {

		if ( is_cart() || is_checkout() || is_wc_endpoint_url( 'edit-address' ) ) {


			if ( function_exists( 'PWS' ) || class_exists('PWS_Core')
				|| in_array( 'persian-woocommerce-shipping/woocommerce-shipping.php',
					apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

				if(  true == self::only_podro_shippment_available() && true == self::check_tick_for_only_podro()){

					add_action( 'wp_enqueue_scripts',function(){

						wp_dequeue_script('pwsCheckout');
						wp_deregister_script('pwsCheckout');

					},99999);
					/*
					 * Provinces will be loaded by Persian Woocommerce plugin
					 */
					$city_select_path = PODRO_PLUGIN_ROOT_URL . 'assets/js/only-podro-cities.js';
				}else{
					$city_select_path = PODRO_PLUGIN_ROOT_URL . 'assets/js/disable-podro.js';
				}
			}else if(!class_exists('Persian_Woocommerce_Core')) {

				$city_select_path = PODRO_PLUGIN_ROOT_URL . 'assets/js/only-podro-cities.js';
				/*
				 * We seperated the provinces here because province names should not
				 * be changed when PWS plugin is enabled
				 * Because woocommerce use another naming system we changed the names to
				 * only province name instead of Tehran(تهران)
				 */
				$province_select_path = PODRO_PLUGIN_ROOT_URL . 'assets/js/only-podro-provinces.js';
			}else if(class_exists('Persian_Woocommerce_Core')){

				$pwc_options = get_option('PW_Options', false);

				if(!$pwc_options || !is_array($pwc_options))
					return;
				if('yes' == ($pwc_options['enable_iran_cities'] ?? 'no')){
					$city_select_path = PODRO_PLUGIN_ROOT_URL . 'assets/js/disable-podro.js';
				}else {

					$city_select_path = PODRO_PLUGIN_ROOT_URL . 'assets/js/only-podro-cities.js';

				}
			}

			wp_enqueue_script(
				'wc-city-select',
				$city_select_path,
				array( 'jquery', 'woocommerce' ),
				PODRO_VERSION,
				true
			);

			if(isset($province_select_path)){
				wp_enqueue_script(
					'wc-province-select',
					$province_select_path,
					array( 'jquery', 'woocommerce' ),
					PODRO_VERSION,
					true
				);
			}
		}

	}

	public static function only_podro_shippment_available(){
		return (WooZones::get_instance())->is_podro_only_active_method();
	}

	public static function check_tick_for_only_podro(){


		$only_podro_functionality_state = get_option('podro_only_functionality');

		return ('yes' == $only_podro_functionality_state);

	}


}
