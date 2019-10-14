<?php
defined('IN_AYA') or exit('Access Denied');
require AYA_ROOT.'module/'.$c_module.'/common.inc.php';
$USER['itemid']<1 && amsg('301,'.l('请先登陆(%s秒后自动跳转..)',3),'w',AYA_URL.$c_path.'login.php');

$u=$USER;

if(IN_POST){
	session_start();
	extract($posts,EXTR_SKIP);


	$checkcode=(string)$checkcode;
	$spassword=(string)$spassword;
	$password=(string)$password;
	$password2=(string)$password2;
	
	
	if(strlen($spassword)<1) amsg(l('请输入原密码'),'w','$("#spassword").focus();');
	if(strtolower($checkcode)!=$_SESSION['checkcode']){
		$_SESSION['checkcode']=random();
	amsg(l('验证码不符'),'w','checkcode();');
	}
	$u['password']==md5(md5($spassword)) or amsg(l('原密码不正确'),'w','$("#spassword").focus();');
	
	$o=new member();
	$o->table='member';
	
	if(!$o->is_password($password))
		amsg($o->msg,'$("#'.$o->htmlid.'").focus();','w');
	if($password!=$password2)
		amsg(l('两次密码不相同'),'w','$("#password2").focus();');
	
	$p=array(
			'password'=>$password
	);
	$o->edit($p,$u);
	set_cookie('auth','');
	amsg(l('修改成功'),'s',AYA_URL.$c_path.'login.php');
}

htmls($u);
extract($u, EXTR_SKIP);
include template($action,$c_module,$c_dirname);