<?php
defined('IN_AYA') or exit('Access Denied');

$arr=include AYA_ROOT.'config.inc.php';

if(IN_POST){
	extract($posts);
	
	is_array($langs) or amsg(l('至少选择一个'),'w');
	
	$arr['lang']=implode(',',$langs);
	
	if(!put_config($arr))
		amsg(l('更新失败'),'w');
	
	amsg(l('提交成功'),'s');
}

htmls($arr);
extract($arr,EXTR_SKIP);
include template($action,'admin');
