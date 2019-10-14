<?php
defined('IN_AYA') or exit('Access Denied');

$arr=include AYA_ROOT.'config.inc.php';

if(IN_POST){
	extract($posts);
	
	$aanew=(int)$aanew;
	$aahot=(int)$aahot;
	
	empty($smtp_host)&&amsg(l('请正确填写'),'w','$("#smtp_host").focus();');
	empty($smtp_port)&&amsg(l('请正确填写'),'w','$("#smtp_port").focus();');
	
	str_is_int($smtp_port) or amsg(l('端口号为数字'),'w','$("#smtp_port").focus();');
	
	empty($smtp_username)&&amsg(l('请正确填写'),'w','$("#smtp_username").focus();');
	empty($smtp_password)&&amsg(l('请正确填写'),'w','$("#smtp_password").focus();');
	empty($smtp_from)&&amsg(l('请正确填写'),'w','$("#smtp_from").focus();');
	
	$arr['smtp_host']=$smtp_host;
	$arr['smtp_port']=$smtp_port;
	$arr['smtp_username']=$smtp_username;
	$arr['smtp_password']=$smtp_password;
	$arr['smtp_from']=$smtp_from;
	if(!put_config($arr))
		amsg(l('更新失败'),'w');
	
	amsg(l('提交成功'),'s');
}

htmls($arr);
extract($arr,EXTR_SKIP);
include template($action,'admin');
