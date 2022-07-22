<?php
namespace WP_PODRO\Engine;

class MetaBox {
	public function add_meta_boxes () {

		if ( get_post_type() == 'shop_order' && isset( $_GET[ 'post' ] ) ) {
			$order_id = $_GET[ 'post' ];
			$order = \wc_get_order($order_id);

			if ( !$order->has_shipping_method('podro_method') ) {
				return;
			}

			add_meta_box(
				'woocommerce-order-podro',
				__( 'Podro', POD_TEXTDOMAIN ),
				array($this, 'order_my_custom'),
				'shop_order',
				'side',
				'default'
			);
		}
	}

	public function order_my_custom() {
    	echo '<h1>Sample meta box</h1>';
	}
}
