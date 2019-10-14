<?php
defined('IN_AYA') or exit('Access Denied');
require AYA_ROOT.'module/'.$c_module.'/common.inc.php';

$items=array ();

if(strlen($q)){
	$wheres=array ();
	$wheres[]='title like \'%'.addslashes($q).'%\'';
	
	$where=empty($wheres)?'1':implode(' && ',$wheres);
	
	$order='posttime desc';
	
	$sum=$db->count(PF.$c_table,$where);
	$pages=pages(AYA_URL.$c_path.'?page=(*)&q='.urlencode($q),$page,$sum,$c_pagesize);
	
	if($sum>0){
		
		$rs=$db->query("SELECT * FROM ".PF."{$c_table} WHERE {$where} ");
		
		while($r=$db->fetch_array($rs)){
			$r['url']=AYA_URL.$CHANNELS[$r['channelid']]['path'].'show.php?itemid='.$r['itemid'];
			$r['posttime']=date('Y-m-d H:i:s',$r['posttime']);
			$r['by']=$CHANNELS[$r['channelid']]['name'];
			$r['byurl']=AYA_URL.$CHANNELS[$r['channelid']]['path'];
			
			$items[]=$r;
		}
		
		$db->free_result($rs);
	}
}

htmls($items);
include template($action,$c_module,$c_dirname);