<?php
defined('IN_AYA') or exit('Access Denied');

$itemid=(int)$_GET['itemid'];

$o=new epage();
$o->table=$c_table;
$o->channelid=$channelid;

if(!$item=$o->get_one('channelid',$channelid))
	amsg(l('信息不存在'),'w');

if(IN_POST){
	extract($posts,EXTR_SKIP);
	$p=array (
			'itemid'=>$item['itemid'],
			'title'=>(string)$title,
			'content'=>(string)$content 
	);
	
	$o->check($p);
	$o->fields_check($p);
	
	if($o->edit($p))
		amsg(l('成功'),'s');
	else
		amsg(l('失败'),'w');
}
$_=$item;
extract(htmls($_),EXTR_SKIP);

include template($action,$c_module);
