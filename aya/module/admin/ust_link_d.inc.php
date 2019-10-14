<?php
defined('IN_AYA') or exit('Access Denied');

if(IN_POST){
	$arr=$posts['ids'];
	count($arr) or amsg(l('至少选择一项'),'w');
}else
	$arr=array (
			$itemid 
	);

foreach($arr as $v){
	$id=(int)$v;
	if(!$r=$db->get_one("SELECT * FROM ".PF."link WHERE itemid=$id"))
		continue;
	
	$pics=explode('|',$r['pics']);
	foreach($pics as $pic){
			upload_del($pic);
	}
	
	$db->query("DELETE FROM ".PF."link WHERE itemid='$id'");
}
amsg(l('已删除'),'s',AYA_ADMIN_URL.'?action=ust_link');
