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
		$this->loader = new Loader();
		$this->loader->add_action( 'admin_init', $Api_Key, 'set_pdo_api_key' );

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

}
