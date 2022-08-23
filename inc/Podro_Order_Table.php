<?php
namespace WP_PODRO\Engine;

use WP_PODRO\Engine\API\V1\Orders;

require_once( ABSPATH . '/wp-admin/includes/class-wp-list-table.php');

class Podro_Order_Table extends \WP_List_Table {
    /**
     * Prepare the items for the table to process
     *
     * @return Void
     */
    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();

        $data = $this->table_data();
		$totalItems = count((array)$data);

		if ( $totalItems < 1 ) {
			$this->items = array();
			return;
		}
        usort( $data, array( &$this, 'sort_data' ) );

        $perPage = 10;
        $currentPage = $this->get_pagenum();


        $this->set_pagination_args( array(
            'total_items' => $totalItems,
            'per_page'    => $perPage
        ) );

        $data = array_slice($data,(($currentPage-1)*$perPage),$perPage);

        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
    }

    /**
     * Override the parent columns method. Defines the columns to use in your listing table
     *
     * @return Array
     */
    public function get_columns()
    {
        $columns = array(
            'id'          => 'شناسه',
            'provider'    => 'پروایدر',
            'order_status' => 'وضعیت',
            'pickup_in'    => 'پیکاپ در',
            'pickup_to'    => 'پیکاپ تا',
            'order'      => 'سفارش',
			'pdf'			=> 'PDF',
			'cancel'		=> 'لغو',
        );

        return $columns;
    }

    /**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns()
    {
        return array();
    }

    /**
     * Define the sortable columns
     *
     * @return Array
     */
    public function get_sortable_columns()
    {
        return array();
    }

    /**
     * Get the table data
     *
     * @return Array
     */
    private function table_data()
    {
		$data = array();
        $args = array(
			'post_type' => 'shop_order',
			'meta_query' => array(
				array(
					'key' => 'pod_order_id',
					'compare' => 'EXISTS'
				)
			),
			'posts_per_page' => -1,
			'post_status' => 'any',
		);
		$orders = get_posts($args);
		foreach ( $orders as $order ) {
			$order_id = $order->ID;
			$pod_order_id = get_post_meta( $order_id, 'pod_order_id', true );
			$details = (new Orders)->get_order($pod_order_id);
			$data[] = array(
				'id'          => $details['order_detail']['tracking_id'] ?? '',
				'provider'       => $details['provider_code'],
				'order_status' => '<mark class="order-status status-processing"><span>'. $details['status'] .'</span></mark>',
				'pickup_in'        => $details['pickup_time'],
				'pickup_to'    => $details['pickup_to_time'],
				'order'      => '<a href="'. get_edit_post_link( $order_id ) .'">'. $order->post_title .'</a>',
				'pdf'			=> '<a class="get_order_pdf" data-order_id="' . $details['id'] . '">دریافت بارنامه</a>',
				'cancel'			=> '<a class="pod-cancel-order" data-order_id="' . $details['id'] . '">لغو ارسال</a>'
			);
		}

        return $data;
    }

    /**
     * Define what data to show on each column of the table
     *
     * @param  Array $item        Data
     * @param  String $column_name - Current column name
     *
     * @return Mixed
     */
    public function column_default( $item, $column_name )
    {
        switch( $column_name ) {
            case 'id':
            case 'provider':
            case 'order_status':
            case 'pickup_in':
            case 'pickup_to':
            case 'order':
			case 'pdf':
			case 'cancel':
                return $item[ $column_name ];

            default:
                return print_r( $item, true ) ;
        }
    }

    /**
     * Allows you to sort the data by the variables set in the $_GET
     *
     * @return Mixed
     */
    private function sort_data( $a, $b )
    {
        // Set defaults
        $orderby = 'provider';
        $order = 'asc';

        // If orderby is set, use this as the sort column
        if(!empty($_GET['orderby']))
        {
            $orderby = $_GET['orderby'];
        }

        // If order is set use this as the order
        if(!empty($_GET['order']))
        {
            $order = $_GET['order'];
        }


        $result = strcmp( $a[$orderby], $b[$orderby] );

        if($order === 'asc')
        {
            return $result;
        }

        return -$result;
    }
}
