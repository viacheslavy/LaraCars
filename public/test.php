<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

function getURL($url){
	$ch = curl_init($url);
	//curl_setopt($ch, CURLOPT_VERBOSE, true);
	//curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
	//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	//curl_setopt($ch, CURLOPT_SSLVERSION, 3);
	/*curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	//curl_setopt($ch, CURLOPT_HEADER, 0);
	//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	//curl_setopt($ch, CURLOPT_URL, $url);
	//curl_setopt($ch, CURLOPT_VERBOSE, 1);
	//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	//curl_setopt ($ch, CURLOPT_CAINFO, dirname(__FILE__)."/cacert.pem"); 
	//curl_setopt($ch, CURLOPT_SSLVERSION, 3);*/
	#echo dirname(__FILE__)."/cacert.pem";exit;
	curl_exec($ch);
	$error = 'Curl error: ' . curl_error($ch);
	curl_close($ch);
	//if($tmp != false){
	//	return $tmp;
	//}
	return $error;
}



echo getURL("https://www.fastandretro.com/fe_assets/img/xhome-slide-1.png.pagespeed.ic.grhsvF5nI8.webp");
