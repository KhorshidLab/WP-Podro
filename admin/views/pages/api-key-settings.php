<?php
$credentials_status = get_option( 'podro_plugin_status' );
$credentials = get_option( 'podro_plugin_credentials', true );

?>


<div class="wrap pod-wrap">

	<div class="pdo-wrapper">
		<div class="pdo-card">
			<h1><?php  esc_html_e( 'تنظیمات عمومی پادرو', 'podro-wp' ) ?></h1>
			<h3><?php  esc_html_e( 'پیکربندی اتصال به پادرو پین', 'podro-wp' ) ?></h3>
			<form class="wp_podro-config-form" method="post" action="<?php echo esc_url(admin_url( '/admin.php?page=' . PODRO_SLUG )); ?>">
				<div class="pdo-box">
					<label for="pdo_email">ایمیل</label>
					<input type="email" name="pdo_email" id="pdo_email" value="<?php echo isset($credentials['email']) ? esc_html($credentials['email']) : '' ?>">
				</div>
				<div class="pdo-box">
					<label for="pdo_password">کلمه عبور</label>
					<input type="password" name="pdo_password" id="pdo_password" autocomplete="off">
				</div>
				<h3><?php  esc_html_e( 'تنظیمات فروشگاه', 'podro-wp' ) ?></h3>
				<div class="pdo-box">

					<label for="podro_store_location">شهر</label>
					<?php
					$provinces = \WP_PODRO\Engine\WooSetting::get_provinces();
					echo "<select aria-label='شهر' class='wc-enhanced-select' id='podro_store_location' name='podro_store_location' style='width:325px;' >";
					foreach($provinces as $province){
						echo "<optgroup label='".esc_attr($province['name'])."'>";
						foreach ($province['cities'] as $key=>$city)
							if(get_option('woocommerce_store_city') == $key)
								echo "<option selected value='". esc_attr($key)."'>".esc_attr($city)."</option>";
							else
								echo "<option value='". esc_attr($key)."'>".esc_attr($city)."</option>";
						echo "</optgroup>";

					}
					echo "</select>"
					?>
				<script>
					jQuery(document).ready(function(){
						jQuery('#hello').select2();
					});
				</script>
				</div>
				<div class="pdo-box">
					<a class="get-api-key" href="https://podro.com/plugin-pin/" target="_blank" rel="noopener noreferrer"><?php  esc_html_e('دریافت کلید API', 'podro-wp'); ?></a>
				</div>
				<button type="submit" class="button button-primary" name="config_podro_api_key" value="1"><?php  esc_html_e( "ذخیره", 'podro-wp' ) ?></button>
			</form>
		</div>

	</div>
    <?php require_once( PODRO_PLUGIN_ROOT . 'admin/views/components/footer.php' ); ?>
</div>
