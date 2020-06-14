<?php

// if uninstall.php is not called by WordPress, die
if ( ! defined('WP_UNINSTALL_PLUGIN') ) {
    die;
}

// delete data
delete_option( 'sleekplan_data' );