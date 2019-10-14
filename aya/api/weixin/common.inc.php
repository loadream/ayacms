<?php
$cfg=include 'config.inc.php';
// 来路判断
if(!checkSignature())
	exit();
function checkSignature(){
	global $cfg;
	
	$signature=$_GET["signature"];
	$timestamp=$_GET["timestamp"];
	$nonce=$_GET["nonce"];
	
	$token=$cfg['token'];
	$tmpArr=array (
			$token,
			$timestamp,
			$nonce 
	);
	sort($tmpArr,SORT_STRING);
	$tmpStr=implode($tmpArr);
	$tmpStr=sha1($tmpStr);
	
	return $tmpStr==$signature;
}
function https_request($url,$data=null){
	$curl=curl_init();
	curl_setopt($curl,CURLOPT_URL,$url);
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
	curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);
	if(!empty($data)){
		curl_setopt($curl,CURLOPT_POST,1);
		curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
	}
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	$output=curl_exec($curl);
	curl_close($curl);
	return $output;
}
function get_access_token(){
	global $cfg;
	$get_url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$cfg['appid'].'&secret='.$cfg['appsecret'];
	$get_return=file_get_contents($get_url);
	$get_return=(array)json_decode($get_return);
	if(!isset($get_return['access_token'])){
		return false;
	}
	return $get_return['access_token'];
}
function get_msg(){
	$postStr=$GLOBALS["HTTP_RAW_POST_DATA"];
	// 获取POST数据                           
	// 用SimpleXML解析POST过来的XML数据
	return simplexml_load_string($postStr,'SimpleXMLElement',LIBXML_NOCDATA);
	
}