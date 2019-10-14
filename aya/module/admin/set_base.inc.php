<?php
defined('IN_AYA') or exit('Access Denied');

$arr=include AYA_ROOT.'config.inc.php';

if(IN_POST){
	extract($posts);
	substr($url,0,7)=='http://' or amsg(l('必须以http://开始'),'w','$("#url").focus();');
	rtrim($url,'/')==$url&&amsg(l('必须以/结束'),'w','$("#url").focus();');
	empty($title)&&amsg(l('请填写网站名称'),'w','$("#title").focus();');
	empty($email)&&amsg(l('请填写管理邮箱'),'w','$("#email").focus();');
	
	$arr['url']=$url;
	$arr['title']=$title;
	$arr['keywords']=$keywords;
	$arr['description']=$description;
	$arr['email']=$email;
	
	if(!put_config($arr))
		amsg(l('更新失败'),'w');
	
	amsg(l('提交成功'),'s');
}

htmls($arr);
extract($arr,EXTR_SKIP);
include template($action,'admin');
