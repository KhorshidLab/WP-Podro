<?php
use WP_PODRO\Engine\Setup;

$credentials_status = get_option('podro_plugin_status');
$credentials = get_option('podro_plugin_credentials', true);

$store_name = get_option('podro_store_name', '');
$store_city = get_option('podro_store_city', '');
$store_address = get_option('podro_store_address', '');

?>


<div class="wrap pod-wrap">

	<div class="pdo-wrapper">
		<div class="pdo-card">
			<h1><?php esc_html_e('تنظیمات عمومی پادرو', 'podro-wp') ?></h1>
			<h3><?php esc_html_e('پیکربندی اتصال به پادرو پین', 'podro-wp') ?></h3>

			<?php if(Setup::is_plugin_setup_done()){ ?>
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row"><label>وضعیت اتصال</label></th>
							<td>
								اتصال به پادروپین با حساب کاربری 
								&nbsp;<b>« <?php echo isset($credentials['email']) ? esc_html($credentials['email']) : '' ?> »</b>&nbsp;
								برقرار است.
							</td>
						</tr>
						<tr>
							<th scope="row"><label></label></th>
							<td>
								<a class="get-api-key" href="<?php  echo admin_url('/admin.php?page=podro-wp-settings&action=resetpassword') ?>">تغییر حساب کاربری</a>
								<p>
									<span class="dashicons dashicons-info"></span>
									توجه: با کلیک برروی لینک، اتصال قطع می‌شود و بایستی مجدد اطلاعات حساب کاربری را وارد کنید.
								</p>
							</td>
						</tr>
					</tbody>
				</table>
				<p><b></b> </p>
				<p>  </p>
				
			<?php }else{ ?>
			
			<form class="wp_podro-config-form" method="post" action="<?php echo esc_url(admin_url('/admin.php?page=' . PODRO_SETTINGS_PAGE_SLUG)); ?>">
				<table class="form-table" id="pdo-login-form">
					<tbody>
						<tr>
							<th scope="row"><label for="pdo_email">ایمیل</label></th>
							<td><input type="email" name="pdo_email" id="pdo_email" class="regular-text ltr" value="<?php echo isset($credentials['email']) ? esc_html($credentials['email']) : '' ?>" required></td>
						</tr>
						<tr>
							<th scope="row"><label for="pdo_password">کلمه عبور</label></th>
							<td><input type="password" name="pdo_password" id="pdo_password" class="regular-text ltr" autocomplete="off" required></td>
						</tr>
						<tr>
							<th scope="row"></th>
							<td>
								<a class="get-api-key" href="https://pin.podro.com/signup?source=plugin" target="_blank" rel="noopener noreferrer"><?php esc_html_e('درخواست فعال‌سازی', 'podro-wp'); ?></a>
							</td>
						</tr>
					</tbody>
				</table>

				<p class="submit">
					<button type="submit" class="button button-primary" name="config_podro_api_key" value="1"><?php esc_html_e("ذخیره اطلاعات", 'podro-wp') ?></button>
				</p>
				<?php } ?>
			</form>


				<hr />

			<form class="wp_podro-config-form" method="post" action="<?php echo esc_url(admin_url('/admin.php?page=' . PODRO_SETTINGS_PAGE_SLUG)); ?>">

				<h3><?php esc_html_e('تنظیمات فروشگاه', 'podro-wp') ?></h3>

				<table class="form-table" id="pdo-other-settings">
					<tbody>
						<tr>
							<th scope="row"><label for="podro_store_name">نام فروشگاه</label></th>
							<td><input type="text" name="podro_store_name" id="podro_store_name" class="regular-text" value="<?php echo esc_attr($store_name ?? '')  ?>" required></td>
						</tr>
						<tr>
							<th scope="row">
								<label for="podro_store_city">شهر (مبدا)</label>
							</th>
							<td>
								<?php
									$provinces = \WP_PODRO\Engine\WooSetting::get_provinces();
									echo "<select aria-label='شهر' class='wc-enhanced-select' id='podro_store_city' name='podro_store_city' style='width: 25em;' required>";
									echo "<option value='' selected disabled hidden>لطفا شهر فروشگاه را انتخاب کنید.</option>";
									foreach ($provinces as $province) {
										echo "<optgroup label='" . esc_attr($province['name']) . "'>";
										foreach ($province['cities'] as $key => $city)
											if (get_option('podro_store_city') == $key)
												echo "<option selected value='" . esc_attr($key) . "'>" . esc_attr($city) . "</option>";
											else
												echo "<option value='" . esc_attr($key) . "'>" . esc_attr($city) . "</option>";
										echo "</optgroup>";
									}
									echo "</select>"
								?>
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="podro_store_address">آدرس فروشگاه</label>
							</th>
							<td class="pdo-box">
								<textarea name="podro_store_address" id="podro_store_address" class="regular_text" required><?php echo esc_attr($store_address ?? '')  ?></textarea>
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="podro_only_functionality">فقط نمایش شهرهای پادرو</label>
							</th>
							<td>
								<input
									type="checkbox"
									name="podro_only_functionality"
									value="yes"
									id="podro_only_functionality" <?php echo ('yes' == get_option('podro_only_functionality', 'no')) ? 'checked="checked"' : '' ?> >
								هنگامی که فقط پادرو بعنوان روش حمل و نقل فعال بود، تنها شهرهای تحت پوشش پادرو نمایش داده شود.
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="podro_auto_update">به‌روزرسانی خودکار</label>
							</th>
							<td>
								<input type="checkbox" name="podro_auto_update" value="yes" id="podro_auto_update" <?php echo ('yes' == get_option('podro_auto_update', 'no')) ? 'checked="checked"' : '' ?> >
								زمانی که به‌روزرسانی جدیدی برای افزونه در دسترس بود، به صورت خودکار به‌روزرسانی را انجام شود.
							</td>
						</tr>
					</tbody>
				</table>

				<p class="submit">
					<button type="submit" class="button button-primary" name="config_podro_store_info" value="1"><?php esc_html_e("ذخیره تنظیمات", 'podro-wp') ?></button>
				</p>

			</form>
		</div>

	</div>
	<?php require_once(PODRO_PLUGIN_ROOT . 'admin/views/components/footer.php'); ?>
</div>
