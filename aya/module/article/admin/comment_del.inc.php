<?php
defined('IN_AYA') or exit('Access Denied');

$itemids=array ();
$o=new article();
$o->table=$c_table;
$o->channelid=$channelid;

if(isset($_GET['author'])){
	$author=(string)$_GET['author'];
	
	$rs=$db->query("SELECT itemid FROM {$db->pre}comment WHERE author='".addslashes($author)."'");
	
	while($r=$db->fetch_array($rs)){
		comment_del($r['itemid']);
	}
	
	amsg(l('已删除'),'s',AYA_ADMIN_URL.'?action=comment&channelid='.$channelid.'&in_module=1');
	
}

if(!IN_POST){
	$itemid=(int)$_GET['itemid'];
	if(!$item=$db->get_one("SELECT * FROM {$db->pre}comment WHERE itemid='$itemid'"))
		amsg(l('信息不存在'),'w');
	
	$itemids[]=$itemid;
}else{
	
	$ids=$posts['ids'];
	if(!is_array($ids) or empty($ids))
		amsg(l('至少选择一项'),'w');
	$itemids=$ids;
}
foreach($itemids as $id){
	comment_del((int)$id);
}

amsg(l('已删除'),'s',AYA_ADMIN_URL.'?action=comment&channelid='.$channelid.'&in_module=1');
