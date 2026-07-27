<?php
// Runs standalone when the plugin is deleted — plugin files are NOT loaded here,
// so option names are literals, not the SLPL_* constants.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option( 'sleekplan_settings' );
delete_option( 'sleekplan_data' );
