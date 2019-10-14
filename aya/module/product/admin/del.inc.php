<?php
defined('IN_AYA') or exit('Access Denied');

$itemids=array ();
$o=new product();
$o->table=$c_table;
$o->channelid=$channelid;

if(!IN_POST){
	$itemid=(int)$_GET['itemid'];
	if(!$item=$o->get_one('itemid',$itemid))
		amsg(l('信息不存在'),'w');
	
	$itemids[]=$itemid;
}else{
	
	$ids=$posts['ids'];
	if(!is_array($ids) or empty($ids))
		amsg(l('至少选择一项'),'w');
	$itemids=$ids;
}
foreach($itemids as $id){
	$o->del((int)$id);
}

amsg(l('已删除'),'s',AYA_ADMIN_URL.'?action=index&channelid='.$channelid.'&in_module=1');

