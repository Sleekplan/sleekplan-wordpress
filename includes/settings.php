<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'admin_menu', 'slpl_admin_menu' );
add_action( 'admin_init', 'slpl_register_settings' );

// Top-level "Sleekplan" menu with the Sleekplan logo.
function slpl_admin_menu() {
	add_menu_page(
		__( 'Sleekplan Settings', 'sleekplan' ),
		__( 'Sleekplan', 'sleekplan' ),
		'manage_options',
		'sleekplan',
		'slpl_render_settings_page',
		'data:image/svg+xml;base64,' . base64_encode( '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="480px" height="480px" viewBox="0 0 480 480" version="1.1"><desc/><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="logo" transform="translate(-1.000000, -1.000000)" fill="#00b3a4" fill-rule="nonzero"><path d="M460.9,175 C510.4,340 472,411.4 307,460.9 C142,510.4 70.6,472 21.1,307 C-28.4,142 10,70.6 175,21.1 C340,-28.4 411.4,10 460.9,175 Z M204.681869,115.09121 C178.057475,123.231104 178.057475,123.231104 159.972736,138.89773 C141.887997,154.564355 141.887997,154.564355 134.993772,174.737793 C128.099548,194.911231 128.099548,194.911231 134.977426,216.982648 C143.107477,243.999957 143.107477,243.999957 165.805713,254.476228 C188.149289,264.788807 188.149289,264.788807 220.546727,263.085943 L221.57775,263.028857 L250.118258,261.5814 C264.411603,260.720643 264.411603,260.720643 274.822349,261.826729 C285.233094,262.932815 285.233094,262.932815 291.754804,267.047461 C298.276514,271.162108 298.276514,271.162108 300.783892,279.363372 C303.472964,288.15893 303.472964,288.15893 300.195626,296.569134 C296.918288,304.979338 296.918288,304.979338 288.394129,311.744436 C279.869971,318.509534 279.869971,318.509534 266.795492,322.506804 C253.483295,326.576751 253.483295,326.576751 241.710593,325.692104 C229.937891,324.807456 229.937891,324.807456 221.20859,318.573409 C212.709008,312.503416 212.709008,312.503416 208.148041,300.978235 L207.904379,300.351267 L158.1025,315.57723 C166.727672,341.663353 166.727672,341.663353 184.343362,355.70803 C201.959052,369.752708 201.959052,369.752708 226.53141,372.117812 C251.103768,374.482916 251.103768,374.482916 280.580775,365.470891 C310.2955,356.386187 310.2955,356.386187 328.649375,340.962201 C347.003249,325.538215 347.003249,325.538215 353.238829,305.761098 C359.474408,285.983982 359.474408,285.983982 352.76157,263.602169 C347.991343,248.424569 347.991343,248.424569 338.985721,238.310954 C329.980098,228.197339 329.980098,228.197339 317.580935,222.500421 C305.181772,216.803504 305.181772,216.803504 290.052635,214.930506 C275.505387,213.129547 275.505387,213.129547 259.212467,214.265562 L257.90624,214.361142 L234.437294,215.817692 C225.928666,216.469509 225.928666,216.469509 218.134706,216.058033 C210.340747,215.646556 210.340747,215.646556 203.920101,213.775465 C197.499456,211.904374 197.499456,211.904374 192.978662,207.957799 C188.457869,204.011224 188.457869,204.011224 186.696952,197.401307 C184.29859,189.556619 184.29859,189.556619 186.98504,181.976912 C189.671489,174.397205 189.671489,174.397205 197.276194,168.238134 C204.880899,162.079063 204.880899,162.079063 217.479942,158.227149 C236.021931,152.558294 236.021931,152.558294 249.272791,157.215009 C262.282727,161.787055 262.282727,161.787055 268.132743,175.313533 L268.346955,175.817584 L317.673399,160.736977 C310.666819,139.094815 310.666819,139.094815 294.324129,126.025615 C277.981438,112.956415 277.981438,112.956415 254.881568,109.881188 C231.781698,106.805961 231.781698,106.805961 204.681869,115.09121 Z" id="Combined-Shape"/></g></g></svg>' )
	);
}

function slpl_register_settings() {
	register_setting(
		'sleekplan',
		SLPL_OPTION,
		array(
			'type'              => 'array',
			'sanitize_callback' => 'slpl_sanitize_settings',
		)
	);

	add_settings_section( 'slpl_widget', __( 'Widget', 'sleekplan' ), 'slpl_section_widget_intro', 'sleekplan' );
	add_settings_field( 'slpl_product_id', __( 'Product ID', 'sleekplan' ), 'slpl_field_product_id', 'sleekplan', 'slpl_widget' );
	add_settings_field( 'slpl_placement', __( 'Show widget', 'sleekplan' ), 'slpl_field_placement', 'sleekplan', 'slpl_widget' );

	add_settings_section( 'slpl_sso', __( 'Single Sign-On', 'sleekplan' ), 'slpl_section_sso_intro', 'sleekplan' );
	add_settings_field( 'slpl_sso_enabled', __( 'Enable SSO', 'sleekplan' ), 'slpl_field_sso_enabled', 'sleekplan', 'slpl_sso' );
	add_settings_field( 'slpl_sso_key', __( 'SSO key', 'sleekplan' ), 'slpl_field_sso_key', 'sleekplan', 'slpl_sso' );
	add_settings_field( 'slpl_sso_fields', __( 'User data to include', 'sleekplan' ), 'slpl_field_sso_fields', 'sleekplan', 'slpl_sso' );
}

// Sanitize the whole settings array. Unchecked checkboxes are absent from the input.
function slpl_sanitize_settings( $input ) {
	if ( ! is_array( $input ) ) {
		$input = array();
	}

	$settings = array(
		'product_id'      => isset( $input['product_id'] ) ? absint( $input['product_id'] ) : 0,
		'show_frontend'   => ! empty( $input['show_frontend'] ),
		'show_backend'    => ! empty( $input['show_backend'] ),
		'sso_enabled'     => ! empty( $input['sso_enabled'] ),
		'sso_key'         => isset( $input['sso_key'] ) ? trim( sanitize_text_field( $input['sso_key'] ) ) : '',
		'sso_send_name'   => ! empty( $input['sso_send_name'] ),
		'sso_send_id'     => ! empty( $input['sso_send_id'] ),
		'sso_send_avatar' => ! empty( $input['sso_send_avatar'] ),
	);

	if ( $settings['sso_enabled'] && '' === $settings['sso_key'] ) {
		add_settings_error(
			'sleekplan',
			'slpl_sso_key_missing',
			__( 'SSO is enabled but no SSO key is set — SSO will not run until you add your key.', 'sleekplan' ),
			'warning'
		);
	}

	return $settings;
}

function slpl_render_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Sleekplan', 'sleekplan' ); ?></h1>
		<?php settings_errors(); // Not automatic on custom top-level pages. ?>
		<form action="options.php" method="post">
			<?php
			settings_fields( 'sleekplan' );
			do_settings_sections( 'sleekplan' );
			submit_button();
			?>
		</form>
	</div>
	<?php
}

function slpl_section_widget_intro() {
	echo '<p>' . esc_html__( 'The Sleekplan widget is configured (appearance, texts, modules) in your Sleekplan admin. This plugin only loads it.', 'sleekplan' ) . '</p>';
}

function slpl_field_product_id() {
	$settings = slpl_get_settings();
	?>
	<input type="number" min="0" step="1" class="regular-text"
		name="<?php echo esc_attr( SLPL_OPTION ); ?>[product_id]"
		value="<?php echo esc_attr( $settings['product_id'] ? $settings['product_id'] : '' ); ?>" />
	<p class="description"><?php esc_html_e( 'Your numeric Sleekplan Product ID. You find it in your Sleekplan admin under Settings.', 'sleekplan' ); ?></p>
	<?php
}

function slpl_field_placement() {
	$settings = slpl_get_settings();
	?>
	<fieldset>
		<label>
			<input type="checkbox" value="1"
				name="<?php echo esc_attr( SLPL_OPTION ); ?>[show_frontend]"
				<?php checked( $settings['show_frontend'] ); ?> />
			<?php esc_html_e( 'Show on website (frontend)', 'sleekplan' ); ?>
		</label><br />
		<label>
			<input type="checkbox" value="1"
				name="<?php echo esc_attr( SLPL_OPTION ); ?>[show_backend]"
				<?php checked( $settings['show_backend'] ); ?> />
			<?php esc_html_e( 'Show in WP admin (backend)', 'sleekplan' ); ?>
		</label>
		<p class="description"><?php esc_html_e( 'In the WP admin, the widget is visible to every logged-in user who can access wp-admin.', 'sleekplan' ); ?></p>
	</fieldset>
	<?php
}

function slpl_section_sso_intro() {
	echo '<p>' . esc_html__( 'With single sign-on, logged-in WordPress users are automatically signed in to the widget — no separate Sleekplan login needed.', 'sleekplan' ) . '</p>';
}

function slpl_field_sso_enabled() {
	$settings = slpl_get_settings();
	?>
	<label>
		<input type="checkbox" value="1"
			name="<?php echo esc_attr( SLPL_OPTION ); ?>[sso_enabled]"
			<?php checked( $settings['sso_enabled'] ); ?> />
		<?php esc_html_e( 'Sign logged-in WordPress users in to the widget', 'sleekplan' ); ?>
	</label>
	<?php
}

function slpl_field_sso_key() {
	$settings = slpl_get_settings();
	?>
	<input type="text" class="regular-text code" autocomplete="off"
		name="<?php echo esc_attr( SLPL_OPTION ); ?>[sso_key]"
		value="<?php echo esc_attr( $settings['sso_key'] ); ?>" />
	<p class="description"><?php esc_html_e( 'Copy your SSO key from the Sleekplan admin: Settings → Single Sign-On.', 'sleekplan' ); ?></p>
	<?php
}

function slpl_field_sso_fields() {
	$settings = slpl_get_settings();
	?>
	<fieldset>
		<p><?php esc_html_e( 'Email address — always included (required identifier)', 'sleekplan' ); ?></p>
		<label>
			<input type="checkbox" value="1"
				name="<?php echo esc_attr( SLPL_OPTION ); ?>[sso_send_name]"
				<?php checked( $settings['sso_send_name'] ); ?> />
			<?php esc_html_e( 'Display name', 'sleekplan' ); ?>
		</label><br />
		<label>
			<input type="checkbox" value="1"
				name="<?php echo esc_attr( SLPL_OPTION ); ?>[sso_send_id]"
				<?php checked( $settings['sso_send_id'] ); ?> />
			<?php esc_html_e( 'User ID', 'sleekplan' ); ?>
		</label><br />
		<label>
			<input type="checkbox" value="1"
				name="<?php echo esc_attr( SLPL_OPTION ); ?>[sso_send_avatar]"
				<?php checked( $settings['sso_send_avatar'] ); ?> />
			<?php esc_html_e( 'Avatar image', 'sleekplan' ); ?>
		</label>
	</fieldset>
	<?php
}
