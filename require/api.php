<?php 
/** *****************
 * API 
 ***************** */

// make api request
function slpl_call_api( $method = 'GET', $enpoint = '/', $data = false ) {

    // build url
    $baseurl = SLPL_SLEEKPLAN_API;
    $token   = slpl_get_data()['token'];
    $url     = $baseurl . $enpoint . (($token) ? '?access_token=' . $token : '');
    $api     = [
        'public'    => '59663ddcd3832c00fee50c651b2d586d',
        'private'   => 'ebf54292fe3129a35e044efd8e388a5d'
    ];

    // init curl
    $curl    = curl_init();

    // method
    switch ($method){
        // post
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            break;
        // put
        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));			 					
            break;
        // put
        case "DELETE":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));			 					
            break;
        // get
        default:
            if ($data)
                $url = sprintf("%s&%s", $url, http_build_query($data));
    }

    // options
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
       'Content-Type: application/json',
       'Authorization: Basic '. base64_encode($api['public'] . ':' . $api['private'])
    ));

    // transfer preferences
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    // execute
    $result = curl_exec($curl);
    $info   = curl_getinfo($curl);

    // close
    curl_close( $curl );

    // to array
    $array_result = json_decode( $result, true );

    // needs token refresh
    if( $array_result['status'] == 'error' && $info['http_code'] == '403' ) {}

    // return result as array
    return $array_result;

}
?>