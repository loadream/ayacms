<?php
defined('IN_AYA') or exit('Access Denied');

if(IN_POST){
	extract($posts,EXTR_SKIP);
	
	$p=array (
			'title'=>(string)$title,
			'content'=>(string)$content,
			'name'=>(string)$name,
			'email'=>(string)$email,
			'tel'=>(string)$tel,
			'posttime'=>TIME
	);
	
	
$o=new book();
	$o->table=$c_table;
	$o->channelid=$channelid;
	$o->check($p);
	$o->fields_check($p);
	
	if($o->add($p))
		amsg(l('成功'),'','s');
	else
	amsg(l('失败'),'w');
}
include template($action,$c_module);
	
