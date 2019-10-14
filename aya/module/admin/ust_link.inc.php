<?php
defined('IN_AYA') or exit('Access Denied');

$wheres=array ();
$where=empty($wheres)?'1':implode(' && ',$wheres);
$order='ORDER by posttime desc';

$sum=$db->count(PF."link",$where);
$pages=pages(AYA_ADMIN_URL.'?action=ust_link&page=(*)',$page,$sum,20);

$items=array ();
if($sum>0){
	$rs=$db->query("SELECT * FROM ".PF."link WHERE {$where} {$order} LIMIT {$offset},20");
	while($r=$db->fetch_array($rs)){
		$itemid=$r['itemid'];
		$r['url']=AYA_ADMIN_URL.'?action=ust_link_e&itemid='.$itemid;
		$r['note']=$r['note'];
		$r['posttime']=date('Y-m-d H:i',$r['posttime']);
		
		$items[$itemid]=$r;
	}
	
	$db->free_result($rs);
}

htmls($items);
include template($action,'admin');
