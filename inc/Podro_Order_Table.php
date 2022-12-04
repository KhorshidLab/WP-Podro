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
		$currentPage = $this->get_pagenum();
        $data = $this->table_data($currentPage);

		$items = $data['items'];

		$totalItems = $data['total_items'];

		if ( $totalItems < 1 ) {
			$this->items = array();
			return;
		}
        //usort( $data, array( &$this, 'sort_data' ) );

        $perPage = 10;



        $this->set_pagination_args( array(
            'total_items' => $totalItems,
            'per_page'    => $perPage
        ) );

        //$items = array_slice($items,(($currentPage-1)*$perPage),$perPage);

        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $items;
    }

    /**
     * Override the parent columns method. Defines the columns to use in your listing table
     *
     * @return Array
     */
    public function get_columns()
    {
        $columns = array(
            'id'          	=> 'شناسه سفارش',
			'tracking_id' 	=> 'شناسه پیگیری',
            'provider'    	=> 'پروایدر',
            'order_status' 	=> 'وضعیت',
            'created_at' 	=> 'تاریخ ایجاد',
			'pickup_in'    	=> 'تاریخ جمع آوری',
            'pickup_to'    	=> 'ساعت جمع آوری',
            'order'      	=> 'سفارش',
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


	private function table_data($current_page=1){

		$result = (new Orders())->get_all_orders($current_page);
		$orders = $result['data'];
		$meta = $result['meta'];
		$jalali_date = new SDate();

		$data = [];
		foreach ($orders as $order){

			if ( $order['status'] == 'لغو شده') {
				$cancel_order = 'از پیش لغو شده';
			} else {
				$cancel_order = '<a class="pod-cancel-order" data-order_id="' . $order['id'] . '">لغو ارسال</a>';
			}

			$created_at = new \DateTime( date('Y-m-d' , $order['created_at']), new \DateTimeZone( wp_timezone_string() ) );

			$data['items'][] = array(
				'id'          	=> esc_html($order['order_id']),
				'tracking_id'   => esc_html($order['tracking_id'] ?? ''),
				'provider'      => esc_html($order['provider_code']),
				'order_status' 	=> '<mark class="order-status status-processing"><span>'. esc_html($order['status']) .'</span></mark>',
				'created_at'	=>esc_html( $jalali_date->gregorian_to_jalali($created_at->format('Y-m-d'))),
				'pickup_in'     => esc_html($order['pickup_time']),
				'pickup_to'    	=> ' از ' .esc_html($order['from_time'])  . ' تا ' . esc_html($order['to_time']),
				'order'      	=> '<a href="'. esc_url(get_edit_post_link( $order['parcels'][0]['id'] )) .'">#'. esc_html($order['parcels'][0]['id']) . ' '  .'</a>',
				'pdf'			=> '<a class="get_order_pdf" data-order_id="' . esc_attr($order['id']) . '">دانلود بارنامه</a>',
				'cancel'		=> $cancel_order,

			);

		}
		$data['total_items'] = $meta['total'];
//		$keys = array_column($data, 'pick_in_original_date');
//
//		array_multisort($keys, SORT_DESC, $data);
		//array_reverse($data);

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
            case 'created_at':
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
