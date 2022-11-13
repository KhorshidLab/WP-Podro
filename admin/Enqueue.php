<?php

/**
 * WP_PODRO
 *
 * @package   WP_PODRO
 * @author    Khorshid <info@khorshidlab.com>
 * @license   GPL-3.0+
 */

namespace WP_PODRO\Admin;

use WP_PODRO\Engine\WC_City_Select;

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
	}


	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since 0.0.1
	 * @return void
	 */
	public function enqueue_admin_styles() {
		$admin_page = \get_current_screen();

		\wp_enqueue_style( PODRO_TEXTDOMAIN . '-admin-styles', \plugins_url( 'assets/css/admin.css', PODRO_PLUGIN_ABSOLUTE ), array( 'dashicons' ), PODRO_VERSION );
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since
	 * @return void
	 */
	public function enqueue_admin_scripts() {
		\wp_enqueue_script( PODRO_TEXTDOMAIN . '-admin-scripts', \plugins_url( 'assets/js/admin.js', PODRO_PLUGIN_ABSOLUTE ), array( 'jquery' ), PODRO_VERSION, true );
		\wp_localize_script(
			PODRO_TEXTDOMAIN . '-admin-scripts',
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
			PODRO_TEXTDOMAIN . '-admin-scripts',
			'wp_podro_assets_url',
			[
				'assets_url'  => \plugins_url( 'assets/' ,PODRO_PLUGIN_ABSOLUTE),

			],
		);
	}

	public function enqueue_public_styles() {

		if ( is_cart() || is_checkout() || is_wc_endpoint_url( 'edit-address' ) ) {
			$city_select_path = PODRO_PLUGIN_ROOT_URL . 'assets/js/city-select.js';
			wp_enqueue_script(
				'wc-city-select',
				$city_select_path,
				array( 'jquery', 'woocommerce' ),
				PODRO_VERSION,
				true
			);

			$cities = json_encode( (new WC_City_Select)->get_cities() );
			wp_localize_script(
				'wc-city-select',
				'wc_city_select_params',
				array(
					'cities' => $cities,
					'i18n_select_city_text' => esc_attr__( 'Select an option&hellip;', 'woocommerce' )
				)
			);
		}

	}

}
