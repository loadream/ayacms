<?php
defined('IN_AYA') or exit('Access Denied');


if(IN_POST){
	extract($posts,EXTR_SKIP);
	$password=(string)$password;
	if(strlen($password)<1)
		amsg(l('请填写密码'),'w','$("#password").focus();');
	
	$o=new member();
	$o->table='member';
	
	if(!$o->is_password($password))
		amsg($o->msg,'w','$("#'.$o->htmlid.'").focus();');
	
	$p=array (
			'password'=>$password
	);
	
	if($o->edit($p,$USER))
		amsg(l('成功'),'s');
	else
		amsg(l('失败'),'w');
}

include template($action,'admin');
