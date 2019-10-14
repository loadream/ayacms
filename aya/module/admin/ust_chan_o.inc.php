<?php
defined('IN_AYA') or exit('Access Denied');

$lang=(string)$_GET['lang'];
if($lang)
	in_array($lang,$LANG) or amsg('404,'.l('禁止访问'));
else
	$lang=AYA_LANG;

$channelid=(int)$_GET['channelid'];
empty($LEVEL[$lang][$channelid]) && amsg(l('其下没有可排序的栏目'),'i');


if(IN_POST){
	extract($posts);
	is_array($ids) or amsg(l('参数错误'),'w');
	empty($ids) && amsg(l('参数错误'),'w');
	
	foreach ($ids as $k=> $id){
		$id=(int)$id;
		$order=count($ids)-(int)$k;
	
	$db->query("UPDATE {$db->pre}channel SET listorder={$order} WHERE channelid={$id}");
}



amsg(l('更新成功'),'s',AYA_ADMIN_URL.'?action=ust_chan&lang='.$lang);
}

include template($action,'admin');