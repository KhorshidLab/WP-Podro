<?php
use WP_PODRO\Engine\Location;
$delivery_options = [
	[
		"provider_name" => "لینک اکسپرس",
		"provider_code" => "link",
		"provider_logo" => POD_PLUGIN_ROOT_URL . "assets/images/linkLogo.png",
		"service_type" => "regular",
		"service_type_label" => "عادی"
	],
	[
		"provider_name" => "پیشروپست",
		"provider_code" => "pishropost",
		"provider_logo" => POD_PLUGIN_ROOT_URL . "assets/images/pishropostLogo.png",
		"service_type" => "regular",
		"service_type_label" => "عادی"
	],
	[
		"provider_name" => "شرکت ملی پست (پیشتاز)",
		"provider_code" => "post",
		"provider_logo" => POD_PLUGIN_ROOT_URL . "assets/images/postLogo.png",
		"service_type" => "regular",
		"service_type_label" => "عادی"
	],
	[
		"provider_name" => "ماهکس",
		"provider_code" => "mahex",
		"provider_logo" => POD_PLUGIN_ROOT_URL . "assets/images/mahexLogo.png",
		"service_type" => "regular",
		"service_type_label" => "عادی"
	]
];

?>


<div class="wrap">

	<h1><?php echo esc_html_e( 'تنظیمات عمومی پادرو', POD_TEXTDOMAIN ) ?></h1>
	<div class="pdo-wrapper">
		<div class="pdo-card">
			<h3><?php echo esc_html_e( 'Configure Podro API', POD_TEXTDOMAIN ) ?></h3>
			<form class="wp_podro-config-form" method="post" action="<?php echo esc_url(admin_url( '/admin.php?page=wp_podro' )); ?>">
				<h3>روش‌های ارسال</h3>
				<div class="delivery_options">
					<?php foreach ($delivery_options as $option) { ?>
						<div class="delivery_option">
							<label for="pdo_delivery_option_<?php echo $option['provider_code'] ?>">
								<img src="<?php echo $option['provider_logo'] ?>" alt="<?php echo $option['provider_name'] ?>">
								<h5><?php echo $option['provider_name'] ?></h5>
							</label>
							<input type="checkbox" name="pdo_delivery_option" id="pdo_delivery_option_<?php echo $option['provider_code'] ?>" value="<?php echo $option['provider_code'] ?>" <?php echo get_option('pdo_delivery_option') == $option['provider_code'] ? 'checked' : '' ?>>
						</div>
					<?php } ?>
				</div>

				<h3>آدرس‌های فروشگاه</h3>
				<div class="store_addresses">
					<fieldset class="store_address" data-address_id="0">
						<div>
							<label for="store_address_label[0]">نام فروشگاه</label>
							<input type="text" name="store_address_label[0]" id="store_address_label[0]">
						</div>
						<div>
							<label for="store_address_province[0]">استان</label>
							<select name="store_address_province[0]" id="store_address_province[0]">
								<option value="">انتخاب استان</option>
								<?php foreach (Location::get_provinces() as $province) { ?>
									<option value="<?php echo $province['code'] ?>"><?php echo $province['name'] ?></option>
								<?php } ?>
							</select>
						</div>
					</fieldset>
				</div>


				<button type="submit" class="button button-primary" name="save_podro_settings" value="1"><?php echo esc_html_e( "Save", POD_TEXTDOMAIN ) ?></button>
			</form>
		</div>
	</div>
    <?php require_once( POD_PLUGIN_ROOT . 'admin/views/components/footer.php' ); ?>
</div>
