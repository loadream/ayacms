<?php
defined('IN_AYA') or exit('Access Denied');

if(!$item=$db->get_one("SELECT * FROM ".PF."poll WHERE itemid=$itemid"))
	amsg(l('信息不存在'),'w');

if(IN_POST){
	
	extract($posts,EXTR_SKIP);
	$title=(string)$title;
	$items=(array)$items;
	$polls=(array)$polls;
	
	if(strlen($title)<1)
		amsg(l('请填写标题'),'w','$("#title").focus();');
	
	if($items==array (
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'' 
	))
		amsg(l('至少填写一个选项'),'w');
	$polls=array_map('intval',$polls);
	$polls=array_map('abs',$polls);
	
	$p=array (
			'title'=>$title,
			'note'=>(string)$note,
			'ty'=>(int)$ty,
			'content'=>(string)$content,
			'items'=>implode('|',$items),
			'polls'=>implode('|',$polls),
			'posttime'=>TIME 
	);
	
	$sql=sql_update($p);
	if($db->query("UPDATE {$db->pre}poll SET {$sql} WHERE itemid={$itemid}"))
		amsg(l('更新成功'),'s');
	else
		amsg(l('失败'),'w');
}
$item['items']=explode('|',$item['items']);
$item['polls']=explode('|',$item['polls']);

$_=$item;
extract(htmls($_),EXTR_SKIP);
include template($action,'admin');
