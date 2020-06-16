<?php

// if uninstall.php is not called by WordPress, die
if ( ! defined('WP_UNINSTALL_PLUGIN') ) {
    die;
}

// remove active product
sp_set_product();

// delete data
delete_option( 'sleekplan_data' );