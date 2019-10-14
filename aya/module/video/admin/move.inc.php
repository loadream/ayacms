<?php
defined('IN_AYA') or exit('Access Denied');

$ids=(string)$_GET['ids'];
$arr=explode(',',$ids);

if(IN_POST){
	extract($posts,EXTR_SKIP);
	$to_channelid=(int)$to_channelid;
	if($CHANNELS[$to_channelid]['module']!=$c_module) amsg(l('参数错误'));
	
	$o=new article();
	$o->table=$c_table;
	$o->channelid=$channelid;
	
	foreach ($arr as $itemid){		
		$o->move($itemid,$to_channelid);
	}
	
		amsg(l('已移动'),'s','location=location.href;');
}

include template($action,$c_module);
