<?php
defined('IN_AYA') or exit('Access Denied');

$wheres=array ();
$wheres[]="comment.channelid='".$channelid."'";
$where=empty($wheres)?'1':implode(' && ',$wheres);

$wheres2=array ();
$wheres2[]="channelid='".$channelid."'";
$where2=empty($wheres2)?'1':implode(' && ',$wheres2);

$order='comment.posttime desc';

$sum=$db->count(PF.'comment',$where2);
$pages=pages(AYA_ADMIN_URL.'?action=comment&channelid='.$channelid.'&in_module=1&page=(*)',$page,$sum,20);

$items=array ();
if($sum>0){
	$rs=$db->query("SELECT comment.*,T.title as title FROM ".PF."comment as comment left join ".PF."member as member on comment.author=member.name left join ".PF.$c_table." as T on comment.itemid_by=T.itemid WHERE $where order by $order LIMIT {$offset},20");
	$i=0;
	while($r=$db->fetch_array($rs)){
		$r['posttime']=date('Y-m-d H:i',$r['posttime']);
		$r['lou']=$sum-20*($page-1)-$i++;
		$items[$r['itemid']]=$r;
	}

	$db->free_result($rs);
}

htmls($items);
include template($action,'article');