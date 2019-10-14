<?php
defined('IN_AYA') or exit('Access Denied');
$cfg=include AYA_ROOT.'api/weixin/config.inc.php';


$get_url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$cfg['appid'].'&secret='.$cfg['appsecret'];
$get_return=file_get_contents($get_url);
$get_return=(array)json_decode($get_return);
if(!isset($get_return['access_token'])){
	amsg('获取access_token失败！','d');
}

$post_url='https://api.weixin.qq.com/cgi-bin/menu/delete?access_token='.$get_return['access_token'];
$result=https_request($post_url,null);
$result=(array)json_decode($result);
if(!isset($result['errmsg'])){
	amsg('结果未知','i');
}else if($result['errmsg']=='ok'){
	amsg('成功删除','s');
}else{
		amsg('错误代号:'.$result['errcode']);
}

