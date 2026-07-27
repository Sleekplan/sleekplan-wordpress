<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_head', 'slpl_print_widget_frontend', 99 );
add_action( 'admin_head', 'slpl_print_widget_backend', 99 );

function slpl_print_widget_frontend() {
	$settings = slpl_get_settings();

	if ( $settings['show_frontend'] ) {
		slpl_print_widget_snippet( $settings );
	}
}

// Backend placement is deliberately not capability-gated: when enabled, every
// logged-in user who can reach wp-admin sees the widget.
function slpl_print_widget_backend() {
	$settings = slpl_get_settings();

	if ( $settings['show_backend'] ) {
		slpl_print_widget_snippet( $settings );
	}
}

function slpl_print_widget_snippet( $settings ) {
	if ( empty( $settings['product_id'] ) ) {
		return;
	}

	$sso_token = slpl_sso_token( $settings );

	echo '<script type="text/javascript">' . "\n";
	echo 'window.$sleek=[];window.SLEEK_PRODUCT_ID=' . (int) $settings['product_id'] . ';' . "\n";

	// The listener must be registered before the SDK loads so it cannot miss sleek:init.
	if ( '' !== $sso_token ) {
		echo 'window.document.addEventListener(\'sleek:init\',function(){$sleek.setUser({token:' . wp_json_encode( $sso_token ) . '});},false);' . "\n";
	}

	echo '(function(){var d=document,s=d.createElement("script");s.src="https://client.sleekplan.com/sdk/e.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();' . "\n";
	echo '</script>' . "\n";
}

// SSO token for the current user, or '' when SSO does not apply.
function slpl_sso_token( $settings ) {
	if ( ! $settings['sso_enabled'] || '' === $settings['sso_key'] || ! is_user_logged_in() ) {
		return '';
	}

	$user = wp_get_current_user();

	// Email is the required identifier; display_name is used instead of
	// user_login so login names never leak to the widget.
	$payload = array( 'mail' => $user->user_email );

	if ( $settings['sso_send_id'] ) {
		$payload['id'] = (int) $user->ID;
	}

	if ( $settings['sso_send_name'] ) {
		$payload['name'] = $user->display_name;
	}

	if ( $settings['sso_send_avatar'] ) {
		$img = get_avatar_url( $user->ID );

		if ( $img ) {
			$payload['img'] = $img;
		}
	}

	return slpl_jwt_encode( $payload, $settings['sso_key'] );
}

// Minimal HS256 JWT encoder (encode-only).
function slpl_jwt_encode( array $payload, $key ) {
	$header = slpl_base64url_encode( wp_json_encode( array( 'typ' => 'JWT', 'alg' => 'HS256' ) ) );
	$body   = slpl_base64url_encode( wp_json_encode( $payload ) );
	$sig    = slpl_base64url_encode( hash_hmac( 'sha256', $header . '.' . $body, $key, true ) );

	return $header . '.' . $body . '.' . $sig;
}

function slpl_base64url_encode( $data ) {
	return rtrim( strtr( base64_encode( $data ), '+/', '-_' ), '=' );
}
