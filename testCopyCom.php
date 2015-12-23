<?

$ch = curl_init();

$baseurl = "https://api.copy.com/oauth/request?";

$timestamp =  time();

$nonce = "7D5C098EAA5088E04CAE1C4CAAF95699.".$timestamp;

$params = "oauth_callback=ood&oauth_consumer_key=FnQFwRZnBHZt1DmcHAaeVotL2Us5p5VV&oauth_nonce=.$nonce.&oauth_signature_method=HMAC-SHA1&oauth_timestamp=.$timestamp.&oauth_version=1.0";

$signature = hash_hmac("sha1","GET&".$baseurl."&".$params,"Gp8TClvnY9wRmYPMntk5mk0Khdx4JH3ZbT3WiCrJBUUFLJqM&");


$url = $baseurl.$params."&oauth_signature=".$signature;

//"https://api.copy.com/oauth/request"
// set some cURL options
$ret = curl_setopt($ch, CURLOPT_URL,            $url);
$ret = curl_setopt($ch, CURLOPT_HEADER,         1);
$ret = curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
$ret = curl_setopt($ch, CURLOPT_TIMEOUT,        30);
$ret = curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$ret = curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

// execute
$ret = curl_exec($ch);

if (empty($ret)) {
    // some kind of an error happened
    die(curl_error($ch));
    curl_close($ch); // close cURL handler
} else {
    $info = curl_getinfo($ch);
    curl_close($ch); // close cURL handler

    if (empty($info['http_code'])) {
            die("No HTTP code was returned");
    } else {
        // load the HTTP codes
        //$http_codes = parse_ini_file("path/to/the/ini/file/I/pasted/above");

        // echo results
        echo "The server responded: <br />";
        echo $info['http_code'] . " " . $http_codes[$info['http_code']];
    }

}


?>