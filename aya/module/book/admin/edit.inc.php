<?php
defined('IN_AYA') or exit('Access Denied');

$itemid=(int)$_GET['itemid'];

$o=new book();
$o->table=$c_table;
$o->channelid=$channelid;

if(!$item=$o->get_one('itemid',$itemid))
	amsg(l('信息不存在'),'w');

if(IN_POST){
	extract($posts,EXTR_SKIP);
	$p=array (
			'title'=>(string)$title,
			'content'=>(string)$content,
			'name'=>(string)$name,
			'email'=>(string)$email,
			'tel'=>(string)$tel 
	);
	
	$o->check($p);
	$o->fields_check($p);
	
	if($o->edit($p,$item))
		amsg(l('成功'),'s');
	else
		amsg(l('失败'),'w');
}
$_=$item;
extract(htmls($_),EXTR_SKIP);

include template($action,$c_module);
