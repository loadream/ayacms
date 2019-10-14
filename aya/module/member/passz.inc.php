<?php
defined('IN_AYA') or exit('Access Denied');
require AYA_ROOT.'module/'.$c_module.'/common.inc.php';

if($USER['itemid']>0) amsg(l('请先退出'),'w',AYA_URL.$c_path);

$sign=(string)$_GET['sign'];

if(IN_POST){
	session_start();
	extract($posts,EXTR_SKIP);
	
	if($sign){
		// 更改新密码;
		$str=decrypt($sign);
		$u=explode(' ',$str);
		
		$name=$u[0];
		$time=$u[1];
		$email=$u[2];
		
		(TIME-$time)>600&&amsg(l('操作超时'),'w');
		if(!$u=$db->get_one("SELECT * FROM {$db->pre}member WHERE name='".addslashes($name)."'"))
			amsg(l('用户不存在'),'w');
		if($email!=$u['email'])
			amsg(l('参数错误'),'w');
		
		$o=new member();
		$o->table='member';
		
		if(!$o->is_password($password))
			amsg($o->msg,'$("#'.$o->htmlid.'").focus();','w');
		
		$p=array (
				'password'=>$password 
		);
		$o->edit($p,$u);
		
		set_cookie('auth','');
		amsg(l('设置成功'),'s',AYA_URL.$c_path.'login.php');
	}
	
	$name=(string)$name;
	strlen($name) or amsg(l('请输入用户名'),'w','$("#name").focus();');
	
	if(!$u=$db->get_one("SELECT * FROM {$db->pre}member WHERE name='".addslashes($name)."'"))
		amsg(l('用户不存在'),'w','$("#name").focus();');
	
	strlen($u['email']) or amsg(l('email信息缺失'),'d');
	
	$sign=encrypt($u['name'].' '.TIME.' '.$u['email']);
	$url=AYA_URL.$c_path.'passz.php?sign='.$sign;
	
	$name=$name;
	$email=$u['email'];
	$title=$CFG['title'].' '.l('密码找回');
	$body=l('请在10分钟内点击以下链接完成操作');
	$body.=': <a herf="'.$url.'">'.html($url).'</a>';
	
	$msg=send_mail($email,$title,$body,$name);
	if($msg!==true){
		amsg($msg,'w');
	}else
		amsg(l('已发送到您的邮箱'),'s');
}
include template($action,$c_module,$c_dirname);