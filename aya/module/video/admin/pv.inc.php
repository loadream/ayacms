<?php
defined('IN_AYA') or exit('Access Denied');

$pv=strlen($c_pv)>0?unserialize($c_pv):array ();

if(IN_POST){
	// extract($posts,EXTR_SKIP);
	$pv=$posts['pv'];
	
	$p=array (
			'pv'=>empty($pv)?'':serialize($pv) 
	);
	
	$sql=sql_update($p);
	if($db->query("UPDATE {$db->pre}channel SET {$sql} WHERE channelid={$channelid}"))
		amsg(l('更新成功'),'s');
	else
		amsg(l('失败'),'w');
}

include template($action,$c_module);