<?php
defined('IN_AYA') or exit('Access Denied');

if(IN_POST){
	$ids=$posts['ids'];
	if(!is_array($ids) or empty($ids))
		amsg(l('请选择'),'w');
}else{
	$ids[]=$itemid;
}

foreach($ids as $id){
	$db->query("delete from ".PF."class where itemid='".$id."'");
	$db->query("delete from ".PF."class where parentid='".$id."'");
}

amsg(l('已删除'),'s',AYA_ADMIN_URL.'?action=class&channelid='.$channelid.'&in_module=1');
