<?php
defined('IN_AYA') or exit('Access Denied');


$wheres=array ();
$where=empty($wheres)?'1':implode(' && ',$wheres);
$order='ORDER by posttime desc';

$sum=$db->count(PF.$c_table,$where);
$pages=pages(AYA_ADMIN_URL.'?action=index&channelid='.$channelid.'&page=(*)&in_module=1',$page,$sum,20);

$items=array ();
if($sum>0){
	$rs=$db->query("SELECT * FROM ".PF.$c_table." WHERE {$where} {$order} LIMIT {$offset},20");
	while($r=$db->fetch_array($rs)){
		$itemid=$r['itemid'];
		$r['url']=AYA_ADMIN_URL.'?action=edit&channelid='.$channelid.'&in_module=1&itemid='.$itemid;
		$r['posttime']=date('Y-m-d H:i',$r['posttime']);
		$items[$itemid]=$r;
	}
	
	$db->free_result($rs);
}

htmls($items);
include template($action,$c_module);
