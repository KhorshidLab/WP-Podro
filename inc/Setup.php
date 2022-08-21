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
use WP_PODRO\Admin\Enqueue;

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

	/**
	 * Define the core functionality of the plugin.
	 *
	 *
	 * @since    0.0.1
	 */
	public function __construct() {

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();

		(new Enqueue)->initialize();

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
	private function load_dependencies() {

		$Api_Key = new Api_Key;
		$MetaBox = new MetaBox;
		$WC_City_Select = new WC_City_Select;
		$this->loader = new Loader();


		// Disable Persian Woocommerce City Select
		if ( function_exists( 'PW' ) && PW()->get_options( 'enable_iran_cities' ) != 'no' ) {
			$settings                       = PW()->get_options();
			$settings['enable_iran_cities'] = 'no';
			update_option( 'PW_Options', $settings );
		}

		// Disable Persian Woocommerce shipping City Select
		if ( function_exists( 'PWS' ) || class_exists('PWS_Core') || in_array( 'persian-woocommerce-shipping/woocommerce-shipping.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			remove_filter( 'woocommerce_form_field_shipping_city', [ \PWS_Core::class, 'checkout_cities_field' ], 11 );
			remove_filter( 'woocommerce_form_field_billing_city', [ \PWS_Core::class, 'checkout_cities_field' ], 11 );
			remove_filter( 'woocommerce_form_field_billing_district', [ \PWS_Core::class, 'checkout_cities_field' ], 11 );
			remove_filter( 'woocommerce_form_field_shipping_district', [ \PWS_Core::class, 'checkout_cities_field' ], 11 );
			remove_filter( 'manage_state_city_custom_column', [ \PWS_Core::class, 'edit_state_city_rows_taxonomy' ], 10 );
			remove_filter( 'manage_edit-state_city_columns', [ \PWS_Core::class, 'edit_state_city_columns_taxonomy' ], 10 );
			remove_filter( 'woocommerce_states', [ \PWS_Core::class, 'iran_states' ], 20 );
			remove_filter( 'wp_ajax_mahdiy_load_cities', [ \PWS_Core::class, 'load_cities_callback' ]);
			remove_filter( 'wp_ajax_nopriv_mahdiy_load_cities', [ \PWS_Core::class, 'load_cities_callback' ]);
			remove_filter( 'wp_ajax_nopriv_mahdiy_load_districts', [ \PWS_Core::class, 'load_districts_callback' ]);
			remove_filter( 'wp_ajax_mahdiy_load_districts', [ \PWS_Core::class, 'load_districts_callback' ]);
			remove_filter( 'wp_ajax_mahdiy_load_districts', [ \PWS_Core::class, 'load_districts_callback' ]);



			add_action( 'wp_enqueue_scripts', function() {
				wp_dequeue_script( 'pwsCheckout' );
			}, 999999 );
		}


		$this->loader->add_filter( 'woocommerce_billing_fields', $WC_City_Select, 'billing_fields', 999999, 2 );
		$this->loader->add_filter( 'woocommerce_shipping_fields', $WC_City_Select, 'shipping_fields', 999999, 2 );
		$this->loader->add_filter( 'woocommerce_form_field_city', $WC_City_Select, 'form_field_city', 999999, 4 );

		$this->loader->add_action( 'admin_init', $Api_Key, 'set_pdo_api_key' );
		$this->loader->add_action( 'add_meta_boxes', $MetaBox, 'add_meta_boxes' );

		// Ajax
		$this->loader->add_action( 'wp_ajax_pod_delivery_step_1', $MetaBox, 'ajax_saving_options_step_1' );
		$this->loader->add_action( 'wp_ajax_pod_delivery_step_2', $MetaBox, 'ajax_saving_options_step_2' );
		$this->loader->add_action( 'wp_ajax_pod_delivery_step_3', $MetaBox, 'ajax_saving_options_step_3' );
		$this->loader->add_action( 'wp_ajax_pod_delivery_step_4', $MetaBox, 'ajax_saving_options_step_4' );
		$this->loader->add_action( 'wp_ajax_pod_token', $MetaBox, 'ajax_get_token' );

		// Register shipping method
		require_once( POD_PLUGIN_ROOT . 'WC/Shipping_Method.php' );

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
			POD_TEXTDOMAIN,
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

	public function setup_admin_menu() {

		if (self::is_plugin_setup_done()) {
			add_menu_page(
				__( 'Podro Setting', POD_TEXTDOMAIN ),
				__( 'Podro', POD_TEXTDOMAIN),
				'manage_options',
				POD_TEXTDOMAIN,
				[$this, 'delivery_page'],
				POD_PLUGIN_ROOT_URL . 'assets/images/podro.png',
				200
			);
			add_submenu_page(
				POD_TEXTDOMAIN,
				__( 'Podro Orders', POD_TEXTDOMAIN ),
				__( 'Orders', POD_TEXTDOMAIN ),
				'manage_options',
				POD_TEXTDOMAIN,
				[$this, 'delivery_page'],
			);

			add_submenu_page(
				POD_TEXTDOMAIN,
				__( 'Podro Setting', POD_TEXTDOMAIN ),
				__( 'Setting', POD_TEXTDOMAIN ),
				'manage_options',
				POD_TEXTDOMAIN . '-setting',
				[$this, 'settings_page'],
			);
		} else {

			add_menu_page(
				__( 'Podro Setting', POD_TEXTDOMAIN ),
				__( 'Podro', POD_TEXTDOMAIN),
				'manage_options',
				POD_TEXTDOMAIN,
				[$this, 'settings_page'],
				POD_PLUGIN_ROOT_URL . 'assets/images/podro.png',
				200
			);

			add_submenu_page(
				POD_TEXTDOMAIN,
				__( 'Podro Setting', POD_TEXTDOMAIN ),
				__( 'Setting', POD_TEXTDOMAIN ),
				'manage_options',
				POD_TEXTDOMAIN,
				[$this, 'settings_page'],
			);

		}

		add_submenu_page(
			POD_TEXTDOMAIN,
			__( 'About Podro', POD_TEXTDOMAIN ),
			__( 'About us', POD_TEXTDOMAIN ),
			'manage_options',
			POD_TEXTDOMAIN . '-about-us',
			[$this, 'about_us_page'],
		);

	}

	public function settings_page() {
		$podro_status = self::is_plugin_setup_done();
		$action = isset($_GET['action']) ? sanitize_text_field($_GET['action']) : false;
		if ( !$podro_status || $action == 'config-api' ) {
			require_once( POD_PLUGIN_ROOT . 'admin/views/pages/api-key-settings.php' );
		} else {
			require_once( POD_PLUGIN_ROOT . 'admin/views/pages/settings.php' );
		}
	}

	public function about_us_page() {
		require_once( POD_PLUGIN_ROOT . 'admin/views/pages/about-us.php' );
	}

	public function delivery_page() {
		require_once( POD_PLUGIN_ROOT . 'admin/views/pages/delivery.php' );
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
				$status = '<span class="active">' . esc_html__( 'Active', POD_TEXTDOMAIN ) . '</span>';
				break;
			default:
				$status = '<span class="disable">' . esc_html__( 'Disable', POD_TEXTDOMAIN ) . '</span>';
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
