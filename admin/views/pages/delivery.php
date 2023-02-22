<?php

use WP_PODRO\Engine\Podro_Order_Table;

$wp_list_table = new Podro_Order_Table();

$pagenum       = $wp_list_table->get_pagenum();

// Handle bulk actions.
$doaction = $wp_list_table->current_action();

$wp_list_table->prepare_items();
?>
<div class="wrap pod-wrap">
<h1 class="wp-heading-inline">سفارشات پادرو</h1>
	<form id="posts-filter" method="post">

	<?php $wp_list_table->views(); ?>

	<?php $wp_list_table->display(); ?>

	<div id="ajax-response"></div>
	<?php find_posts_div(); ?>
	</form>
	<table class="form-table">
		<tbody>
		<tr>
			<th scope="row">
				<label>شماره پشتیبانی: </label>
			</th>
			<td>
				۰۲۱-۹۱۰۳۲۲۲۲ - داخلی ۲۲۲
			</td>
		</tr>
		</tbody>
	</table>
</div>
