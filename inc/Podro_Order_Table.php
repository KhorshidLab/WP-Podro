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
            'id'          => 'شناسه سفارش',
			'tracking_id' => 'شناسه پیگیری',
            'provider'    => 'پروایدر',
            'order_status' => 'وضعیت',
            'pickup_in'    => 'تاریخ جمع آوری',
            'pickup_to'    => 'ساعت جمع آوری',
            'order'      => 'سفارش',
			'pdf'			=> 'بارنامه',
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


	private function table_data(){

		$orders = (new Orders())->get_all_orders()['data'];


		$data = [];
		foreach ($orders as $order){


			$detail = (new Orders())->get_order($order['id']);

			if ( $order['status'] == 'لغو شده') {
				$cancel_order = 'از پیش لغو شده';
			} else {
				$cancel_order = '<a class="pod-cancel-order" data-order_id="' . $order['id'] . '">لغو ارسال</a>';
			}

			$data[] = array(
				'id'          => $order['order_id'],
				'tracking_id'          => $detail['order_detail']['tracking_id'] ?? '',
				'provider'       => $order['provider_code'],
				'order_status' => '<mark class="order-status status-processing"><span>'. $order['status'] .'</span></mark>',
				'pickup_in'        => $order['pickup_time'],
				'pickup_to'    => ' از ' .$order['from_time']  . ' تا ' . $order['to_time'],
				'order'      => '<a href="'. get_edit_post_link( $order['parcels'][0]['id'] ) .'">#'. $order['parcels'][0]['id'] . ' '  .'</a>',
				'pdf'			=> '<a class="get_order_pdf" data-order_id="' . $order['id'] . '">دانلود بارنامه</a>',
				'cancel'			=> $cancel_order
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
			case 'tracking_id':
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
            $orderby = sanitize_text_field($_GET['orderby']);
        }

        // If order is set use this as the order
        if(!empty($_GET['order']))
        {
            $order = sanitize_text_field($_GET['order']);
        }


        $result = strcmp( $a[$orderby], $b[$orderby] );

        if($order === 'asc')
        {
            return $result;
        }

        return -$result;
    }
}
