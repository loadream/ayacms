<?php
defined('IN_AYA') or exit('Access Denied');

if(IN_POST){
	extract($posts,EXTR_SKIP);
	$p=array (
			'pagesize'=>(int)$pagesize,
			'orderby'=>(string)$orderby,
			'config'=>(string)$config 
	);
	
	$sql=sql_update($p);
	if($db->query("UPDATE {$db->pre}channel SET {$sql} WHERE channelid={$channelid}"))
		amsg(l('更新成功'),'s');
	else
		amsg(l('失败'),'w');
}

$arr=$CHANNEL;
htmls($arr);
extract($arr,EXTR_SKIP);

include template($action,$c_module);
