<?php 

/** *****************
 * Actions
 ***************** */

add_action( 'admin_post_slpl_auth_form_response', 'slpl_auth_form');
add_action( 'admin_post_slpl_settings_form_response', 'slpl_settings_form');
add_action( 'admin_post_slpl_website_form_response', 'slpl_website_form');
add_action( 'admin_post_slpl_logout_form_response', 'slpl_logout_form');
add_action( 'wp_head', 'slpl_load_script', 99999 );
add_action( 'wp_footer', 'slpl_load_sso', 99999 );
add_action( 'admin_enqueue_scripts', 'slpl_custom_admin_scripts' );

/** *****************
 * Form submit functions
 ***************** */

// submit authentication form
function slpl_auth_form() {
		
	if( isset( $_POST['slpl_auth_nonce'] ) && wp_verify_nonce( $_POST['slpl_auth_nonce'], 'slpl_auth_nonce') ) {

		// register
		if( $_POST['type'] == 'register' ) {

			// get sanitized data
			$user_product 	= sanitize_text_field( $_POST['user_product'] );
			$user_mail 		= sanitize_email( $_POST['user_mail'] );
			$user_name 		= sanitize_text_field( $_POST['user_name'] );
			$user_pass 		= $_POST['user_pass'];

			// check if we miss some data
			if( ! $user_product || ! $user_mail || ! $user_name || ! $user_pass ) {

				// add the notice
				wp_redirect( SLPL_PLUGIN_FILE . '&notice=error&message=' . urlencode( 'Please fill out all data' ) );

				// stop here
				exit;

			}

			// call api
			$auth_data = slpl_call_api( 'POST', 'user/create', [
				'user_product' 	=> $user_product,
				'user_mail' 	=> $user_mail,
				'user_name' 	=> $user_name,
				'user_pass' 	=> $user_pass,
			] );

			// check for error
			if( $auth_data['status'] == 'error' ) {

				// add the notice
				wp_redirect( SLPL_PLUGIN_FILE . '&notice=error&message=' . urlencode( $auth_data['data']['message'] ) );

				// stop here
				exit;

			}

			// setup account
			slpl_update_data( [
				'user_id' => $auth_data['data']['user_data']['ID'], 
			] );

			// load oauth
			slpl_oauth( $auth_data['data']['token'] );

			// set SSO key
			slpl_set_sso_key( $auth_data['data']['product_id'] );

			// set product
			slpl_set_product( $auth_data['data']['product_id'] );

		}

		// sign in
		if( $_POST['type'] == 'signin' ) {

			// get sanitized data
			$user_mail 		= sanitize_email( $_POST['user_mail'] );
			$user_pass 		= $_POST['user_pass'];

			// check if we miss some data
			if( ! $user_mail || ! $user_pass ) {

				// add the notice
				wp_redirect( SLPL_PLUGIN_FILE . '&notice=error&message=' . urlencode( 'Please fill out all data' ) );

				// stop here
				exit;

			}

			// call api
			$auth_data = slpl_call_api( 'POST', 'user/login', [
				'user_mail' 	=> $user_mail,
				'user_pass' 	=> $user_pass,
			] );

			// check for error
			if( $auth_data['status'] == 'error' ) {

				// add the notice
				wp_redirect( SLPL_PLUGIN_FILE . '&notice=error&message=' . urlencode( $auth_data['data']['message'] ) );

				// stop here
				exit;

			}

			// setup account
			slpl_update_data( [
				'user_id' => $auth_data['data']['user_data']['ID'], 
			] );

			// load oauth
			slpl_oauth( $auth_data['data']['token'] );

			// set SSO key
			slpl_set_sso_key( $auth_data['data']['product_id'] );

			// set product
			slpl_set_product( $auth_data['data']['product_id'] );

		}

		// add the notice
        wp_redirect( SLPL_PLUGIN_FILE . '&notice=success&message=' . urlencode('Successfully authenticated') );
        
        // stop here
        exit;
        
	} else {

        // on error
		wp_die( __( 'Invalid nonce specified' ), __( 'Error' ), array(
					'response' 	=> 403,
					'back_link' => SLPL_PLUGIN_FILE,
        ) );
            
	}
}

// submit settings form
function slpl_settings_form() {

	if( isset( $_POST['slpl_settings_nonce'] ) && wp_verify_nonce( $_POST['slpl_settings_nonce'], 'slpl_settings_nonce') ) {
		
		// product data
		$product_data = slpl_data_load_settings()['data'];

		// prepare widget settings
		$post_settings_widget = [
			'position' 			=> [
									'widget' => (( isset( $_POST['setting']['widget']['position']['widget'] ) && in_array($_POST['setting']['widget']['position']['widget'], ['left', 'right']) ) ? sanitize_text_field($_POST['setting']['widget']['position']['widget']) : 'left' ),
									'button' => (( isset( $_POST['setting']['widget']['position']['button'] ) && in_array($_POST['setting']['widget']['position']['button'], ['top', 'middle', 'bottom']) ) ? sanitize_text_field($_POST['setting']['widget']['position']['button']) : 'bottom' ),
								],
			'theme' 			=> (( in_array($_POST['setting']['widget']['theme'], ['light', 'dark'] ) ) ? sanitize_text_field($_POST['setting']['widget']['theme']) : 'light' ),
            'brand_color' 		=> sanitize_hex_color($_POST['setting']['widget']['brand_color']),
            'branding' 			=> rest_sanitize_boolean($_POST['setting']['widget']['branding']),
            'enable_button' 	=> rest_sanitize_boolean($_POST['setting']['widget']['enable_button']),
            'enable_changelog' 	=> rest_sanitize_boolean($_POST['setting']['widget']['enable_changelog']),
			'enable_submit' 	=> rest_sanitize_boolean($_POST['setting']['widget']['enable_submit']),
			'popup_feedback'	=> [
									'active' 	=> rest_sanitize_boolean($_POST['setting']['widget']['popup_feedback']['active']),
									'message' 	=> sanitize_text_field($_POST['setting']['widget']['popup_feedback']['message']),
									'm' 		=> intval($_POST['setting']['widget']['popup_feedback']['m']),
									'h' 		=> intval($_POST['setting']['widget']['popup_feedback']['h']),
									'd' 		=> intval($_POST['setting']['widget']['popup_feedback']['d']),
								],
			'popup_satisfaction'=> [
									'active' 	=> rest_sanitize_boolean($_POST['setting']['widget']['popup_satisfaction']['active']),
									'message' 	=> sanitize_text_field($_POST['setting']['widget']['popup_satisfaction']['message']),
									'm' 		=> intval($_POST['setting']['widget']['popup_satisfaction']['m']),
									'h' 		=> intval($_POST['setting']['widget']['popup_satisfaction']['h']),
									'd' 		=> intval($_POST['setting']['widget']['popup_satisfaction']['d']),
								],
			'text'				=> [
									'title' 				=> sanitize_text_field($_POST['setting']['widget']['text']['title']),
									'description' 			=> sanitize_text_field($_POST['setting']['widget']['text']['description']),
									'satisfaction_title' 	=> sanitize_text_field($_POST['setting']['widget']['text']['satisfaction_title']),
									'satisfaction_voted' 	=> sanitize_text_field($_POST['setting']['widget']['text']['satisfaction_voted']),
									'login_title' 			=> sanitize_text_field($_POST['setting']['widget']['text']['login_title']),
									'login_description' 	=> sanitize_text_field($_POST['setting']['widget']['text']['login_description']),
									'login_title_con' 		=> sanitize_text_field($_POST['setting']['widget']['text']['login_title_con']),
									'login_description_con' => sanitize_text_field($_POST['setting']['widget']['text']['login_description_con']),
			],
		];

		// prepare general settings
		$post_settings_general = [
			'anonymous' 		=> rest_sanitize_boolean($_POST['setting']['general']['anonymous']),
			'confirm_signup' 	=> rest_sanitize_boolean($_POST['setting']['general']['confirm_signup']),
		];

		$post_settings = [
			'widget' 	=> $post_settings_widget,
			'general' 	=> $post_settings_general,
		];

		// merge settings here
		$product_data['product_settings'] = array_merge( $product_data['product_settings'], $post_settings );
		
		// get data
		$data = slpl_get_data();

		// send settings via api
		$auth_data = slpl_call_api( 'PUT', 'product/' . $data['product'], $product_data );

		// set SSO
		slpl_update_data( ['sso' => $_POST['sso'] ] );

		// check for error
		if( $auth_data['status'] == 'error' ) {

			// add the notice
			wp_redirect( SLPL_PLUGIN_SETTINGS . '&notice=error&message=' . urlencode( $auth_data['data']['message'] ) );

			// stop here
			exit;

		}
		
		// add the notice
		wp_redirect( SLPL_PLUGIN_SETTINGS . '&notice=success&message=' . urlencode('Settings updated') );

	}

}

// submit website selector
function slpl_website_form() {

	if( isset( $_POST['slpl_website_nonce'] ) && wp_verify_nonce( $_POST['slpl_website_nonce'], 'slpl_website_nonce') ) {
		
		// set SSO key
		slpl_set_sso_key( intval( $_POST['selected_website'] ) );

		// update active website
		slpl_set_product( intval( $_POST['selected_website'] ) );

		// add the notice
        wp_redirect( SLPL_PLUGIN_SETTINGS . '&notice=success&message=' . urlencode('Active website successfully updated') );
        
        // stop here
        exit;

	}

}

// submit logout
function slpl_logout_form() {

	if( isset( $_POST['slpl_logout_nonce'] ) && wp_verify_nonce( $_POST['slpl_logout_nonce'], 'slpl_logout_nonce') ) {
		
		// remove active product
		slpl_set_product();

		// delete local data
		delete_option('sleekplan_data');

		// add the notice
        wp_redirect( SLPL_PLUGIN_FILE . '&notice=success&message=' . urlencode('Successfully logged out') );
        
        // stop here
        exit;

	}

}

// set integration status
function slpl_set_product( $product_id = false ) {

	// get current data
	$current_data = slpl_get_data();

	// if we have an active product
	if( isset( $current_data['product'] ) && ! empty( $current_data['product'] ) ) {
		// deactivate integration
		$product_data = slpl_call_api( 'DELETE', 'product/' . $current_data['product'] . '/integration/wordpress' );
	}

	// if we have no product id to set
	if( $product_id === false )
		return true;

	// activate integration for new product
	slpl_call_api( 'POST', 'product/' . $product_id . '/integration/wordpress' );

	// set product
	slpl_update_data( [ 'product' => $product_id ] );

}

// get single-sign-on key
function slpl_set_sso_key( $product_id ) {

	// load user websites
	$product_data = slpl_call_api( 'GET', 'product/' . $product_id, [
		'admin' => 'true'
	]);
	
	// set SSO
	slpl_update_data( ['sso' => $product_data['data']['product_private']['sso_key'] ] );

}

// get oauth token
function slpl_oauth( $access_token ) {

	// get oauth key
	$oauth_key = slpl_call_api( 'POST', 'oauth/key?access_token=' . $access_token, [ 'service' => 'wordpress' ] );

	// get access token
	$oauth_token = slpl_call_api( 'POST', 'oauth/token', [ 'code' => $oauth_key['data']['key'] ], ['headers' => ['Authorization' => 'Basic ' . base64_encode( SLPL_CLIENTP . ':' . SLPL_CLIENTS )]] );

	// setup account
	slpl_update_data( [ 'token' => $oauth_token['data']['token'] ] );

}


/** *****************
 * Load data functions
 ***************** */

// load websites
function slpl_data_load_websites() {

	// get data
	$data = slpl_get_data();

	// load user websites
	$user_websites = slpl_call_api( 'GET', 'user/' . $data['user_id'] . '/product' );
	
	// return websites
	return $user_websites['data'];

}

// load settings
function slpl_data_load_settings() {

	// get data
	$data = slpl_get_data();

	// load user websites
	$product_data = slpl_call_api( 'GET', 'product/' . $data['product'], ['settings' => 'true'] );
	
	// return websites
	return [
		'data' 		=> $product_data['data'],
		'settings' 	=> $product_data['data']['product_settings'],
		'sso'		=> slpl_get_data()['sso']
	];

}

// load stats
function slpl_data_load_stats() {

	// get data
	$data 	= slpl_get_data();
	$stats 	= [];

	// load general stats
	$stats['product'] 		= slpl_call_api( 'GET', 'product/' . $data['product'] )['data'];
	$stats['general'] 		= slpl_call_api( 'GET', 'product/' . $data['product'] . '/stats/general' )['data'];
	$stats['satisfaction'] 	= slpl_call_api( 'GET', 'product/' . $data['product'] . '/satisfaction' )['data'];
	$stats['feedback'] 		= slpl_call_api( 'GET', 'feedback/' . $data['product'] . '/items', [
		'type' 		=> 'all',
		'sort' 		=> 'trend',
		'filter' 	=> 'all',
		'page' 		=> 0
	] )['data'];
	
	// prepare types
	$stats['types'] = [];
    foreach( $stats['general']['type']['color'] as $key => $value ) {
        $stats['types'][$stats['general']['type']['label'][$key]] = $stats['general']['type']['color'][$key];
    }

	// return websites
	return $stats;

}

// load plan
function slpl_data_load_subscription() {

	// get data
	$data 	= slpl_get_data();

	// load plan
	$plan	= slpl_call_api( 'GET', 'subscription/product/' . $data['product'] )['data'];
	
	// returned
	return [
		'subscribed' => ( ($plan['plan'] === 'free') ? false : true ),
		'quota'		 => $plan['quota'],
		'usage'		 => $plan['usage']
	];

}


/** *****************
 * Helper functions
 ***************** */

// update data
function slpl_update_data( $data ) {

	// load jwt classes
	require_once dirname(__FILE__) . '/jwt/BeforeValidException.php';
	require_once dirname(__FILE__) . '/jwt/ExpiredException.php';
	require_once dirname(__FILE__) . '/jwt/SignatureInvalidException.php';
	require_once dirname(__FILE__) . '/jwt/JWT.php';

	// get current data
	$current_data 	= slpl_get_data();
	// merge new data
	$new_data 	 	= array_merge( (($current_data) ? $current_data : []), $data );

	try {
		// get JSON Web Token
		$jwt = \Firebase\JWT\JWT::encode( $new_data, SLPL_JWT, 'HS256' );
	} catch (Exception $e) {}

	// save into database
	update_option('sleekplan_data', $jwt);

}

// get data
function slpl_get_data() {

	// load jwt classes
	require_once dirname(__FILE__) . '/jwt/BeforeValidException.php';
	require_once dirname(__FILE__) . '/jwt/ExpiredException.php';
	require_once dirname(__FILE__) . '/jwt/SignatureInvalidException.php';
	require_once dirname(__FILE__) . '/jwt/JWT.php';

	// get current data
	$jwt = get_option('sleekplan_data');

	// check if we have data
	if( ! $jwt )
		return $jwt;

	try {
		// get JSON Web Token
		$options = \Firebase\JWT\JWT::decode( $jwt, SLPL_JWT, array('HS256') );
	} catch (Exception $e) {
		// on signature verification failure
		if( $e->getMessage() == 'Signature verification failed' )
			delete_option( 'sleekplan_data' );
	}

	// return data
	return (array)$options;

}


/** *****************
 * Script functions
 ***************** */

// load sleekplan script
function slpl_load_script() {

	// get product id
	$data = slpl_get_data();
	
	// return false in case we have no product id
	if( ! isset( $data['product'] ) ) return false;

	// add JavaScript SDK
	echo '<script type="text/javascript">
		window.$sleek=[];
		window.SLEEK_PRODUCT_ID=' . $data['product'] . ';
		(function(){d=document;s=d.createElement("script");s.src="https://client.sleekplan.com/sdk/e.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();
		</script>';

}

// load sleekplan SSO
function slpl_load_sso() {

	// load jwt classes
	require_once dirname(__FILE__) . '/jwt/BeforeValidException.php';
	require_once dirname(__FILE__) . '/jwt/ExpiredException.php';
	require_once dirname(__FILE__) . '/jwt/SignatureInvalidException.php';
	require_once dirname(__FILE__) . '/jwt/JWT.php';

	// get product id
	$data = slpl_get_data();
	
	// return false in case we have no product id
	if( 
		! isset( $data['product'] ) || 
		! isset( $data['sso'] ) || 
		! is_user_logged_in() ) return false;

	// get current user
	$current_user = wp_get_current_user();

	$userData = [
		'mail' 	=> $current_user->user_email,
		'id' 	=> $current_user->ID,
		'name' 	=> $current_user->user_login,
		'img' 	=> get_avatar_url( $current_user->ID ),
	];

	// get JSON Web Token
	$jwt = \Firebase\JWT\JWT::encode( $userData, $data['sso_token'], 'HS256' );

	// print javascript
	?>
		<script>
		$sleek.sso = function( callback ) {
			// return the generated token to the widget
			callback( {token: '<?php echo $jwt; ?>'} );
		};
		</script>
	<?php

}

// load custom scripts
function slpl_custom_admin_scripts(){

	// load style
	wp_enqueue_style( 'sp-style', plugins_url( 'assets/css/style.css', SLPL_BASE ) );

	// load script for settings
    if( isset($_GET['page']) && $_GET['page'] == 'sleekplan-settings' ) { 
		// custom js
		wp_enqueue_script( 'sp-settings-script', plugins_url( 'assets/js/settings.js', SLPL_BASE ) );
	}

	// load script for dashbaord
	if( isset($_GET['page']) && $_GET['page'] == 'sleekplan' ) { 
		// custom js
		wp_enqueue_script( 'sp-dashboard-script', plugins_url( 'assets/js/dashboard.js', SLPL_BASE ) );
		// plugin: chart.js
		wp_enqueue_style( 'sp-plugin-chart-css', plugins_url( 'assets/css/chart.min.css', SLPL_BASE ) );
		wp_enqueue_script( 'sp-plugin-chart-script', plugins_url( 'assets/js/chart.min.js', SLPL_BASE ) );
	}

}