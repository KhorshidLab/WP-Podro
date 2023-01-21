<?php
namespace WP_PODRO\Engine;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      0.0.1
 * @package   WP_PODRO
 * @author    Khorshid <info@khorshidlab.com>
 * @license   GPL-3.0+
 * @link      https://github.com/KhorshidLab/WP-Podro
 */

use WP_PODRO\Engine\Helper;
use WP_PODRO\Admin\Enqueue;
use WP_PODRO\Engine\API\V1\Payments;


class Setup {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    0.0.1
	 * @access   protected
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    0.0.1
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    0.0.1
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;


	public static $IS_WC_ACTIVE = false;

	/**
	 * Define the core functionality of the plugin.
	 *
	 *
	 * @since    0.0.1
	 */
	public function __construct() {

		if ( class_exists('WC_Payment_Gateway') ) {
			self::$IS_WC_ACTIVE = true;
		}

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();

		(new Enqueue)->initialize();
		new Settings();
		$this->run();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    0.0.1
	 * @access   private
	 */


	public function podro_get_cities(){
		$woosetting = new WooSetting();
		$cities = $woosetting->get_cities();

		wp_send_json($cities);
		wp_die();
	}
	private function load_dependencies() {

		$Api_Key = new Api_Key;
		$MetaBox = new MetaBox;
		$this->loader = new Loader();



		add_action( 'wp_ajax_nopriv_get_podro_cities', [$this, 'podro_get_cities'] );
		add_action( 'wp_ajax_get_podro_cities', [$this, 'podro_get_cities'] );



		$this->loader->add_action( 'admin_init', $Api_Key, 'set_pdo_api_key' );
		$this->loader->add_action( 'add_meta_boxes', $MetaBox, 'add_meta_boxes' );

		// Ajax
		$this->loader->add_action( 'wp_ajax_pod_delivery_step_1', $MetaBox, 'ajax_saving_options_step_1' );
		$this->loader->add_action( 'wp_ajax_pod_delivery_step_2', $MetaBox, 'ajax_saving_options_step_2' );
		$this->loader->add_action( 'wp_ajax_pod_delivery_step_3', $MetaBox, 'ajax_saving_options_step_3' );
		$this->loader->add_action( 'wp_ajax_pod_delivery_step_4', $MetaBox, 'ajax_saving_options_step_4' );
		$this->loader->add_action( 'wp_ajax_pod_token', $MetaBox, 'ajax_get_token' );
		$this->loader->add_action( 'wp_ajax_cancel_order', $MetaBox, 'ajax_cancel_order' );

		$payments = new Payments();


		$this->loader->add_action( 'wp_ajax_pod_payment_step', $payments, 'echo_payments' );

		// Register shipping method
		require_once( PODRO_PLUGIN_ROOT . 'WC/Shipping_Method.php' );


		add_action( 'wp_ajax_nopriv_get_podro_cities_by_province', function(){

			$provinces = WooSetting::get_provinces();
			if(!isset($_POST['province']) || empty($_POST['province'])){
				wp_send_json( $provinces);
				wp_die();
			}
			$province_code = $_POST['province'];
			foreach ($provinces as $province){
				if($province['name'] == $province_code)
				{
					wp_send_json( wp_json_encode($province));
					wp_die();
				}
			}

		} );
		add_action( 'wp_ajax_get_podro_cities_by_province', function(){

			$provinces = WooSetting::get_provinces();
			if(!isset($_POST['province']) || empty($_POST['province'])){
				wp_send_json( $provinces);
				wp_die();
			}
			$province_code = $_POST['province'];
			foreach ($provinces as $province){
				if($province['name'] == $province_code)
				{
					wp_send_json( wp_json_encode($province));
					wp_die();
				}
			}

		} );
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the load_plugin_textdomain function in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    0.0.1
	 * @access   private
	 */
	private function set_locale() {

		$this->loader->add_action( 'plugins_loaded', $this, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 */
	private function define_admin_hooks() {

		$this->loader->add_action( 'admin_menu', $this, 'setup_admin_menu' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    0.0.1
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     0.0.1
	 * @return    Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    0.0.1
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			PODRO_SLUG,
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

	public function setup_admin_menu() {

		if (self::is_plugin_setup_done()) {
			add_menu_page(
				__( 'تنظیمات پادرو', 'podro-wp' ),
				__( 'پادرو', 'podro-wp'),
				'manage_options',
				PODRO_SLUG,
				[$this, 'delivery_page'],
				PODRO_PLUGIN_ROOT_URL . 'assets/images/podro.png',
				200
			);

			add_submenu_page(
				PODRO_SLUG,
				__( 'سفارشات پادرو', 'podro-wp' ),
				__( 'سفارشات', 'podro-wp' ),
				'manage_options',
				'podro-wp',
				[$this, 'delivery_page'],
			);

			add_submenu_page(
				PODRO_SLUG,
				__( 'تنظیمات پادرو', 'podro-wp' ),
				__( 'تنظیمات', 'podro-wp' ),
				'manage_options',
				PODRO_SETTINGS_PAGE_SLUG,
				[$this, 'settings_page'],
			);
		} else {

			add_menu_page(
				__( 'پادرو', 'podro-wp' ),
				__( 'پادرو', 'podro-wp'),
				'manage_options',
				PODRO_SLUG,
				[$this, 'settings_page'],
				PODRO_PLUGIN_ROOT_URL . 'assets/images/podro.png',
				200
			);

			add_submenu_page(
				PODRO_SLUG,
				__( 'تنظیمات پادرو', 'podro-wp' ),
				__( 'تنظیمات', 'podro-wp' ),
				'manage_options',
				PODRO_SETTINGS_PAGE_SLUG,
				[$this, 'settings_page'],
			);

		}

		add_submenu_page(
			PODRO_SLUG,
			__( 'درباره پادرو', 'podro-wp' ),
			__( 'درباره', 'podro-wp' ),
			'manage_options',
			PODRO_SLUG . '-about-us',
			[$this, 'about_us_page'],
		);

	}

	public function settings_page() {
		$podro_status = self::is_plugin_setup_done();
		$action = isset($_GET['action']) ? sanitize_text_field($_GET['action']) : false;
		if ( !$podro_status || $action == 'config-api' ) {
			require_once( PODRO_PLUGIN_ROOT . 'admin/views/pages/api-key-settings.php' );
		} else {
			require_once( PODRO_PLUGIN_ROOT . 'admin/views/pages/api-key-settings.php' );
		}
	}

	public function about_us_page() {
		require_once( PODRO_PLUGIN_ROOT . 'admin/views/pages/about-us.php' );
	}

	public function delivery_page() {
		require_once( PODRO_PLUGIN_ROOT . 'admin/views/pages/delivery.php' );
	}

	/**
	 * Print plugin status
	 *
	 * @return string
	 */
	public static function plugin_status() {

		$credentials_status = get_option( 'podro_plugin_status' );
		switch ($credentials_status) {
			case 'connected':
				$status = '<span class="active">' . esc_html__( 'فعال', 'podro-wp' ) . '</span>';
				break;
			default:
				$status = '<span class="disable">' . esc_html__( 'غیرفعال', 'podro-wp' ) . '</span>';
				break;
		}

		return wp_kses_post($status);

	}

	/**
	 * Check if plugin Setup is done and connected
	 *
	 * @return boolean
	 */
	public static function is_plugin_setup_done() {
		$status = get_option( 'podro_plugin_status' );

		return $status === 'connected' ? true : false;
	}

	public function check_delivery_options() {
		$delivery_options = get_option( 'podro_delivery_options' );
		if ( !$delivery_options ) {
			$delivery_options = [
				'link' => 1,
				'pishropost' => 1,
				'post' => 1,
				'mahex' => 1,
			];
			update_option( 'podro_delivery_options', $delivery_options );
		}
	}

}
