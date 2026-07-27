<?php
/**
 * Plugin Name:       Sleekplan
 * Plugin URI:        https://sleekplan.com/
 * Description:       Embed the Sleekplan feedback widget on your WordPress site, with optional single sign-on for logged-in users.
 * Version:           1.0.0
 * Requires at least: 5.0
 * Tested up to:      7.0
 * Requires PHP:      7.0
 * Author:            Sleekplan
 * Author URI:        https://sleekplan.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       sleekplan
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SLPL_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'SLPL_OPTION', 'sleekplan_settings' );
define( 'SLPL_LEGACY_OPTION', 'sleekplan_data' );

require_once SLPL_PLUGIN_PATH . 'includes/settings.php';
require_once SLPL_PLUGIN_PATH . 'includes/widget.php';

// Default settings — single source of truth for keys and types.
function slpl_default_settings() {
	return array(
		'product_id'      => 0,
		'show_frontend'   => true,
		'show_backend'    => false,
		'sso_enabled'     => false,
		'sso_key'         => '',
		'sso_send_name'   => true,
		'sso_send_id'     => true,
		'sso_send_avatar' => true,
	);
}

// Stored settings merged over defaults; always returns every key.
function slpl_get_settings() {
	$settings = get_option( SLPL_OPTION, array() );

	if ( ! is_array( $settings ) ) {
		$settings = array();
	}

	return wp_parse_args( $settings, slpl_default_settings() );
}

// One-time migration from the pre-1.0 JWT-encoded option. Runs on plugins_loaded
// (not admin_init) so an auto-updated site keeps its widget without anyone
// visiting wp-admin. Cost once migrated: a single cached get_option.
add_action( 'plugins_loaded', 'slpl_maybe_migrate' );

function slpl_maybe_migrate() {
	if ( false !== get_option( SLPL_OPTION, false ) ) {
		return;
	}

	$legacy_jwt = get_option( SLPL_LEGACY_OPTION );

	if ( ! $legacy_jwt || ! is_string( $legacy_jwt ) ) {
		return;
	}

	$legacy = slpl_legacy_decode( $legacy_jwt, md5( get_bloginfo( 'url' ) ) );

	if ( is_array( $legacy ) && ! empty( $legacy['product'] ) ) {
		$settings                = slpl_default_settings();
		$settings['product_id']  = absint( $legacy['product'] );
		$settings['sso_key']     = isset( $legacy['sso'] ) ? trim( (string) $legacy['sso'] ) : '';
		$settings['sso_enabled'] = '' !== $settings['sso_key'];

		update_option( SLPL_OPTION, $settings );
	}

	// The legacy blob (incl. the old OAuth token) is useless now — remove it either way.
	delete_option( SLPL_LEGACY_OPTION );
}

// Verify+decode the old HS256 JWT option. Returns the payload array, or null on
// any failure (tampered value, changed site URL, malformed string).
function slpl_legacy_decode( $jwt, $secret ) {
	$parts = explode( '.', $jwt );

	if ( 3 !== count( $parts ) ) {
		return null;
	}

	$expected = slpl_base64url_encode( hash_hmac( 'sha256', $parts[0] . '.' . $parts[1], $secret, true ) );

	if ( ! hash_equals( $expected, rtrim( $parts[2], '=' ) ) ) {
		return null;
	}

	$payload = json_decode( base64_decode( strtr( $parts[1], '-_', '+/' ) ), true );

	return is_array( $payload ) ? $payload : null;
}
