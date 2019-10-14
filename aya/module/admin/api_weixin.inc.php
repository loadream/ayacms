<?php
defined('IN_AYA') or exit('Access Denied');
$cfg=include AYA_ROOT.'api/weixin/config.inc.php';
$arr=$cfg;

if(IN_POST){
	extract($posts);	
	$arr['appid']=(string)$appid;
	$arr['appsecret']=(string)$appsecret;
	$arr['url']=(string)$url;
	$arr['token']=(string)$token;
	
	if(!put_config($arr,AYA_ROOT.'api/weixin/'))
		amsg(l('更新失败'),'w');
	
	amsg(l('提交成功'),'s','f');
}

htmls($arr);
extract($arr,EXTR_SKIP);
include template($action,'admin');
