<?php 
/** *****************
 * API 
 ***************** */

// make api request
function slpl_call_api( $method = 'GET', $enpoint = '/', $data = false, $add_args = [] ) {

    // build url
    $baseurl = SLPL_SLEEKPLAN_API;
    $token   = slpl_get_data()['token'];
    $url     = $baseurl . $enpoint . (($token) ? '?access_token=' . $token : '');
    $args    = $add_args;

    // method
    switch ($method){
        // post
        case "POST":
            $args['method'] = 'POST';
            if ($data) {
                $args['headers']        = array_merge($args['headers'], array('Content-Type' => 'application/json; charset=utf-8'));
                $args['body']           = json_encode($data);
                $args['data_format']    = 'body';
            }
            break;
        // put
        case "PUT":
            $args['method'] = 'PUT';
            if ($data) {
                $args['headers']        = array_merge($args['headers'], array('Content-Type' => 'application/json; charset=utf-8'));
                $args['body']           = json_encode($data);
                $args['data_format']    = 'body';
            }		 					
            break;
        // delete
        case "DELETE":
            $args['method'] = 'DELETE';		 					
            break;
        // get
        default:
            $args['method'] = 'GET';
            if ($data)
                $url = sprintf("%s&%s", $url, http_build_query($data));
    }

    // make request
    $response   = wp_remote_request( $url, $args );
    $body       = wp_remote_retrieve_body($response);

    // to array
    $array_result = json_decode( $body, true );

    // needs token refresh
    if( $array_result['status'] == 'error' && $response['response']['code'] == '403' ) {}

    // return result as array
    return $array_result;

}
?>