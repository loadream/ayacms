<?php
defined('IN_AYA') or exit('Access Denied');

$o=new article();
$o->table=$c_table;
$o->channelid=$channelid;

if(!$item=$db->get_one("SELECT * FROM {$db->pre}comment WHERE itemid='$itemid'"))
	amsg(l('信息不存在'),'w');

if(IN_POST){
	
	extract($posts,EXTR_SKIP);
	$posttime=(string)$posttime;
	
	
	$p=array (
			'author'=>(string)$author,
			'content'=>(string)$content,
			'posttime'=>strlen($posttime)?strtotime($posttime):TIME,
	);
	
	if($o->comment_edit($p,$item))
		amsg(l('成功'),'s',AYA_ADMIN_URL.'?action='.$action.'&channelid='.$channelid.'&in_module=1&itemid='.$itemid);
	else
		amsg(l('失败'),'w');
}


$_=$item;
extract(htmls($_),EXTR_SKIP);

include template($action,'article');
