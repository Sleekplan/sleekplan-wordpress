<?php 

    // check user
    if( ! current_user_can( 'manage_options' ) ) wp_die('You are not allowed to edit settings');

    // get data
    $data = sp_get_data();

    // load notices
    require_once( dirname(__FILE__) . '/admin-notice.inc.php' );

    // regsier view
    if( ! isset($data['token']) ) require_once( dirname(__FILE__) . '/admin-auth.inc.php' );

    // admin views
    else 
        if( $_GET['page'] == 'sleekplan-settings' ) 
            // settings view
            require_once( dirname(__FILE__) . '/admin-settings.inc.php' );
        else 
            // dashbaord view
            require_once( dirname(__FILE__) . '/admin-dashboard.inc.php' );

?>