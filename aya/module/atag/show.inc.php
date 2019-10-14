<?php
defined('IN_AYA') or exit('Access Denied');
require AYA_ROOT.'module/'.$c_module.'/common.inc.php';

$items=array ();

$where="tag='".addslashes($tag)."'";
$order='posttime desc';

$sum=$db->count(PF.$c_table,$where);

$pages=pages(url($c_path,'show.php','page=(*)&tag='.urlencode($tag)),$page,$sum,$c_pagesize);

if($sum>0){
	
	$rs=$db->query("SELECT * FROM ".PF."{$c_table} WHERE {$where} order by {$order} LIMIT {$offset},{$c_pagesize}");
	
	while($r=$db->fetch_array($rs)){
		$itemid=$r['itemid'];
		$r['url']=url($CHANNELS[$r['channelid']]['path'],'show.php','itemid='.$itemid.'&sign='.$r['sign']);
		$r['posttime']=date('Y-m-d H:i:s',$r['posttime']);
		$r['by']=$CHANNELS[$r['channelid']]['name'];
		$r['byurl']=AYA_URL.$CHANNELS[$r['channelid']]['path'];

		
		$items[$itemid]=$r;
	}
	
	$db->free_result($rs);
}

htmls($items);
apply('pathnav', array($tag));
include template($action,$c_module,$c_dirname);