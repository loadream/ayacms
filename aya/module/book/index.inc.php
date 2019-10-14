<?php
defined('IN_AYA') or exit('Access Denied');
require AYA_ROOT.'module/'.$c_module.'/common.inc.php';

if(IN_POST){
	extract($posts,EXTR_SKIP);
	
	session_start();
	
	$checkcode=(string)$checkcode;
	
	if(strlen($checkcode)<1)
		amsg(l('请输入验证码'),'w','$("#checkcode").focus();');
	
	if(strtolower($checkcode)!=$_SESSION['checkcode']){
		$_SESSION['checkcode']=random();
		amsg(l('验证码不符'),'w','checkcode();');
	}
	
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
	
	if($o->add($p)){
		if(strlen($c_config)>0)
		amsg($c_config,'s',AYA_URL.$c_path);
		else
		amsg(l('感谢您的留言'),'s',AYA_URL.$c_path);
	}else
		amsg(l('留言失败'),'w');
}

include template($action,$c_module,$c_dirname);