<?php
defined('IN_AYA') or exit('Access Denied');

if(IN_POST){
	extract($posts,EXTR_SKIP);
	$pagesize=(int)$pagesize;
	$p=array (
			'pagesize'=>$pagesize<1?1:$pagesize,
			'orderby'=>(string)$orderby,
			'comment'=>$comment?2:0,
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
