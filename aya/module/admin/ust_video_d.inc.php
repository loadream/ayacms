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
	if(!$r=$db->get_one("SELECT * FROM ".PF."video WHERE itemid=$id"))
		continue;
	
	if(preg_match('/\d{4}\/\d{2}\/[A-Za-z0-9\.]+/isU',$r['url']))
		file_del(AYA_ROOT.'upload/'.$r['url']);
	
	$db->query("DELETE FROM ".PF."video WHERE itemid='$id'");
}
amsg(l('已删除'),'s',AYA_ADMIN_URL.'?action=ust_video');
