<?php
/**
 *
 * @since      0.0.2
 * @package   WP_PODRO
 * @author    Khorshid <info@khorshidlab.com>
 * @license   GPL-3.0+
 * @link      https://github.com/KhorshidLab/WP-Podro
 */

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	function podro_shipping_method_init() {
		if ( ! class_exists( 'WC_Shipping_Podro' ) ) {
			class WC_Shipping_Podro extends WC_Shipping_Method {

				/**
				 * Constructor. The instance ID is passed to this.
				 */
				public function __construct( $instance_id = 0 ) {
					$this->id                    = 'podro_method';
					$this->instance_id           = absint( $instance_id );
					$this->method_title          = __( 'Podro Shipping Method', POD_TEXTDOMAIN );
					$this->method_description    = __( 'پادروپین؛ ‌مارکت‌پلیس خدمات پستی است و به فروشگاه‌های آنلاین کمک می‌کند تا فرآیند ارسال سفارش‌های اینترنتی را مدیریت کنند. در پادروپین، بدون مراجعه و یا ثبت قرارداد با شرکت‌های پستی، می‌توان سفارش‌های اینترنتی را با هر یک از شرکت‌های پستی ارسال کرد', POD_TEXTDOMAIN );
					$this->supports              = array(
						'shipping-zones',
						'instance-settings',
					);
					$this->instance_form_fields = array(
						'enabled' => array(
							'title' 		=> __( 'Enable/Disable', POD_TEXTDOMAIN ),
							'type' 			=> 'checkbox',
							'label' 		=> __( 'Enable this shipping method', POD_TEXTDOMAIN ),
							'default' 		=> 'yes',
						),
						'title' => array(
							'title' 		=> __( 'Method Title', POD_TEXTDOMAIN ),
							'type' 			=> 'text',
							'description' 	=> __( 'This controls the title which the user sees during checkout.', POD_TEXTDOMAIN ),
							'default'		=> __( 'Podro', POD_TEXTDOMAIN ),
							'desc_tip'		=> true
						),
						'price' => array(
							'title' 		=> __( 'هزینه ارسال', POD_TEXTDOMAIN ),
							'type' 			=> 'number',
							'description' 	=> __( 'هزینه دریافتی از کاربر', POD_TEXTDOMAIN ),
							'default'		=> __( '1000', POD_TEXTDOMAIN ),
							'desc_tip'		=> true
						)
					);
					$this->enabled              = $this->get_option( 'enabled' );
					$this->title                = $this->get_option( 'title' );

					add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
				}

				public function calculate_shipping( $package = array() ) {
					$this->add_rate( array(
						'id'    => $this->id . $this->instance_id,
						'label' => $this->title,
						'cost'  => $this->get_option( 'price' ),
					) );
				}
			}
		}
	}

	add_action( 'woocommerce_shipping_init', 'podro_shipping_method_init' );

	function add_podro_shipping_method( $methods ) {
		$methods['podro_method'] = 'WC_Shipping_Podro';
		return $methods;
	}

	add_filter( 'woocommerce_shipping_methods', 'add_podro_shipping_method' );
}
