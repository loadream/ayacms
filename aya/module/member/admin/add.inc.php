<?php
defined('IN_AYA') or exit('Access Denied');

if(IN_POST){
	extract($posts,EXTR_SKIP);
	
	$p=array (
			'name'=>(string)$name,
			'groupid'=>(int)$groupid,
			'password'=>(string)$password,
			'password2'=>(string)$password2,
			'sex'=>(int)$sex,
			'email'=>(string)$email,
			'regtime'=>TIME 
	);
	
	$o=new member();
	$o->table=$c_table;
	$o->channelid=$channelid;
	$o->check($p);
	$o->fields_check($p);
	
	if($o->add($p))
		amsg(l('成功'),'s');
	else
		amsg(l('失败'),'w');
}
include template($action,$c_module);
	
