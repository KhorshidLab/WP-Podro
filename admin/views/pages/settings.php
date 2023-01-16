<?php
$credentials_status = get_option( 'podro_plugin_status' );
$credentials = get_option( 'podro_plugin_credentials', true );
?>


<div class="wrap pod-wrap">

	<div class="pdo-wrapper">
		<div class="pdo-card">
			<h1><?php  esc_html_e( 'تنظیمات عمومی پادرو', 'podro-wp' ) ?></h1>
			<h3><?php if ( isset($credentials['email']) ) _e('تغییر '); ?><?php  esc_html_e( 'پیکربندی اتصال به پادرو پین', 'podro-wp' ) ?></h3>
			<form class="wp_podro-config-form" method="post" action="<?php echo esc_url(admin_url( '/admin.php?page=' . PODRO_SLUG )); ?>">
				<div class="pdo-box">
					<label for="pdo_email">ایمیل</label>
					<input type="email" name="pdo_email" id="pdo_email" value="<?php echo isset($credentials['email']) ? esc_attr($credentials['email']) : '' ?>">
				</div>
				<div class="pdo-box">
					<label for="pdo_password">کلمه عبور</label>
					<input type="password" name="pdo_password" id="pdo_password" autocomplete="off" value="<?php echo isset($credentials['email']) ? '**************' : '' ?>">
				</div>
				<div class="pdo-box">
					<a class="get-api-key" href="https://pin.podro.com/signup?source=plugin" target="_blank" rel="noopener noreferrer"><?php  esc_html_e('درخواست فعال‌سازی', 'podro-wp'); ?></a>
				</div>
				<button type="submit" class="button button-primary" name="config_podro_api_key" value="1"><?php  esc_html_e( "ذخیره", 'podro-wp' ) ?></button>
			</form>
		</div>
	</div>
    <?php require_once( PODRO_PLUGIN_ROOT . 'admin/views/components/footer.php' ); ?>
</div>
