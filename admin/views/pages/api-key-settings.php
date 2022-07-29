<?php
$credentials_status = get_option( 'podro_plugin_status' );
$credentials = get_option( 'podro_plugin_credentials', true );

var_dump($credentials);
?>


<div class="wrap">

	<h1><?php echo esc_html_e( 'Podro General Settings', POD_TEXTDOMAIN ) ?></h1>
	<div class="pdo-wrapper">
		<div class="pdo-card">
			<h3><?php echo esc_html_e( 'Configure Podro API', POD_TEXTDOMAIN ) ?></h3>
			<form class="wp_podro-config-form" method="post" action="<?php echo esc_url(admin_url( '/admin.php?page=wp_podro' )); ?>">
				<div class="pdo-box">
					<label for="pdo_email">Email</label>
					<input type="email" name="pdo_email" id="pdo_email" value="<?php echo isset($credentials['email']) ? $credentials['email'] : '' ?>">
				</div>
				<div class="pdo-box">
					<label for="pdo_password">password</label>
					<input type="password" name="pdo_password" id="pdo_password" autocomplete="off">
				</div>
				<div class="pdo-box">
					<a class="get-api-key" href="https://pin.podro.com/login" target="_blank" rel="noopener noreferrer"><?php echo esc_html_e('Get API Key', POD_TEXTDOMAIN); ?></a>
				</div>
				<button type="submit" class="button button-primary" name="config_podro_api_key" value="1"><?php echo esc_html_e( "Save", POD_TEXTDOMAIN ) ?></button>
			</form>
		</div>
	</div>
    <?php require_once( POD_PLUGIN_ROOT . 'admin/views/components/footer.php' ); ?>
</div>
