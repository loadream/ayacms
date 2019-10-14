<?php
defined('IN_AYA') or exit('Access Denied');

if(IN_POST){
	$ids=$posts['ids'];
	if(!is_array($ids) or empty($ids))
		amsg(l('请选择'),'w');
}else{
	$name=(string)$_GET['name'];
	isset($FD[$name]) or amsg(l('表单不存在'),'w');
	
	$ids[]=$name;
}

$o=new field();
$o->table=$c_table;

foreach($ids as $name){
	$o->name=$name;
	$o->del();
}
amsg(l('已删除'),'s',AYA_ADMIN_URL.'?action=field&channelid='.$channelid.'&in_module=1');
