<?php


#
# the gateway
// $url = 'https://reseller.media/api/sandbox'; // sandbox
$url = 'https://reseller.media/api'; // main


#
# params
$params = array(
	'token'   => '4ccb1cd432dcea56fada72f6a6fd8b762d000000', // this is unique for you -- take care of your api token, and dont share it with any body.
	'method'  => 'newline', // currently only "newline" is available
	// 'username'=> 'test'.rand(1000, 9999), // optional
	'service' => 'single-1', // single-[1,3,6,12] , multi-[1,3,6,12]
	// 'mac'     => '00:11:22:33:44:33', // optional
);

#
# output
$res = curl_post($url, $params);
$res = json_decode($res);

#
if( $res->status == 'OK' ){
	// line is generated successfuly
	echo "Your new line: <br><pre>";
	var_dump($res);
	
} else {
	echo $res->msg;
}
#


/*

output sample : 

  ["line_id"]=>
    string(9) "1238834"
  ["line"]=>
    string(83) "http://your-dns.com:8080/get.php?username=james5991&password=e8ca5f11&type=m3u&output=ts"
  ["username"]=>
    string(9) "james5991"
  ["password"]=>
    string(8) "e8ca5f11"
  ["max_connections"]=>
    int(1)
  ["exp_date"]=>
    int(1589638359)
  ["mac"]=>
    string(17) "00:8e:92:11:14:0f"
  ["status"]=>
    string(2) "OK"

*/



# curl request
function curl_post( $url, $params ){

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url );
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$res = curl_exec ($ch);
	curl_close ($ch);

	return $res;

}



