<?php

/**
 * WP_PODRO
 *
 * @package   WP_PODRO
 * @author    Khorshid <info@khorshidlab.com>
 * @license   GPL-3.0+
 */

namespace WP_PODRO\Admin;


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
	}


	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since 0.0.1
	 * @return void
	 */
	public function enqueue_admin_styles() {
		$admin_page = \get_current_screen();

		\wp_enqueue_style( POD_TEXTDOMAIN . '-admin-styles', \plugins_url( 'assets/css/admin.css', POD_PLUGIN_ABSOLUTE ), array( 'dashicons' ), POD_VERSION );
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since
	 * @return void
	 */
	public function enqueue_admin_scripts() {
		\wp_enqueue_script( POD_TEXTDOMAIN . '-admin-scripts', \plugins_url( 'assets/js/admin.js', POD_PLUGIN_ABSOLUTE ), array( 'jquery' ), POD_VERSION, true );
		\wp_localize_script(
			POD_TEXTDOMAIN . '-admin-scripts',
			'wp_podro_ajax_object',
			[
				'ajax_url'  => admin_url( 'admin-ajax.php' ),
				'security'  => wp_create_nonce( 'pod-options-nonce' ),
				'is_rtl'=> is_rtl(),
				'strings'	  => [
				],
			],
		);
	}

}
