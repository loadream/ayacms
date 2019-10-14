<?php
defined('IN_AYA') or exit('Access Denied');

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
	
	$sql=sql_insert($p);
	if(!$db->query("insert into ".PF."poll $sql")){
		amsg(l('无法写入数据库'),'w');
	}
	
	amsg(l('新建成功'),'s',AYA_ADMIN_URL.'?action=ust_poll');
}

include template($action,'admin');
