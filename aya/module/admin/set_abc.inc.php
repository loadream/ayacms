<?php
defined('IN_AYA') or exit('Access Denied');

$arr=include AYA_ROOT.'config.inc.php';

if(IN_POST){
	extract($posts);	
	$arr['add_a']=(int)$add_a;
	$arr['add_b']=(int)$add_b;
	$arr['add_c']=(int)$add_c;
	
	if(!put_config($arr))
		amsg(l('更新失败'),'w');
	
	amsg(l('提交成功'),'s');
}

htmls($arr);
extract($arr,EXTR_SKIP);
include template($action,'admin');
