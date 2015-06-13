<?php
/*
Plugin Name: GA-Measurement-Protocol
Plugin URI: https://github.com/powerthazan/YOURS-GA-MP-Tracking
Description: Tracks clicks using Google Analytics Measurement Protocol.
Version: 1.1
Author: Powerthazan
Author URI: https://www.twitter.com/powerthazan
License: Creative Commons Attribution 3.0 Unported: https://creativecommons.org/licenses/by/3.0/
*/

yourls_add_action( 'pre_redirect', 'power_ga_mp' );
yourls_add_filter('shunt_update_clicks', 'power_ga_mp_trackCurrent');

function power_ga_mp_trackCurrent($unused) {
    global $keyword;
    power_ga_mp($keyword, yourls_get_keyword_title($keyword), $_SERVER['HTTP_REFERER']);
    return $unused;
}

// Handle the retrieval of the GA Measurment Protocol via curl instead of file_get_contents
function file_get_contents_curl($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    // Don't bother checking the peer. This may imply a MIM can happen though...
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    curl_close($ch);
    return $response;
}

// Handle the parsing of the _ga cookie or setting it to a unique identifier
  function power_ga_mp_gaParseCookie() {
  if (isset($_COOKIE['_ga'])) {
    list($version,$domainDepth, $cid1, $cid2) = split('[\.]', $_COOKIE["_ga"],4);
    $contents = array('version' => $version, 'domainDepth' => $domainDepth, 'cid' => $cid1.'.'.$cid2);
    $cid = $contents['cid'];
  }
  else $cid = power_ga_mp_UUID();
  return $cid;
}
  
    function power_ga_mp_UUID() {
    $uuid = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
    $uuid = substr($uuid, 0, 8 ) .'-'.
    substr($uuid, 8, 4) .'-'.
    substr($uuid, 12, 4) .'-'.
    substr($uuid, 16, 4) .'-'.
    substr($uuid, 20);
    return $uuid;
}

  
// Our custom function that will be triggered when the event occurs
function power_ga_mp($keyword, $title = '(unknown)', $referer = '') { 

    $version = 1;
    $z = rand(100000000000,999999999999); // Cache Buster  to ensure browsers and proxies don't cache hits
    $power_ga_mp_GAID = 'UA-33563207-5';
   
  $data = array(
            'v' => $version,
            'tid' => $power_ga_mp_GAID,
            'cid' => power_ga_mp_gaParseCookie(),
            'uip' => $_SERVER['REMOTE_ADDR'],
            'z' => $z,
            't' => 'pageview',
            'dh' => $_SERVER['SERVER_NAME'],
            'dp' => $keyword,
            'dt' => $title,
            'dr' => $referer,
        );


 if($data) {
        $getString = 'https://ssl.google-analytics.com/collect';
        $getString .= '?payload_data&';
        $getString .= http_build_query($data);
        $result = file_get_contents_curl($getString);
        return $result;
	
    }
    return false;
}

