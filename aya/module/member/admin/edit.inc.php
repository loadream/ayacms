<?php
defined('IN_AYA') or exit('Access Denied');

$itemid=(int)$_GET['itemid'];

$o=new member();
$o->table=$c_table;
$o->channelid=$channelid;

if(!$item=$o->get_one('itemid',$itemid))
	amsg(l('信息不存在'),'w');

if(IN_POST){
	extract($posts,EXTR_SKIP);
	
	$p=array (
			'groupid'=>(int)$groupid,
			'password'=>(string)$password,
			'password2'=>(string)$password2,
			'sex'=>(int)$sex,
			'email'=>(string)$email 
	);
	
	$o->edit_check($p,$item);
	$o->fields_check($p);
	
	if($o->edit($p,$item))
		amsg(l('成功'),'s');
	else
		amsg(l('失败'),'w');
}
$_=$item;
extract(htmls($_),EXTR_SKIP);

include template($action,$c_module);
