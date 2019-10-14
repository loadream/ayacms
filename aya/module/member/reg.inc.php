<?php
defined('IN_AYA') or exit('Access Denied');
require AYA_ROOT.'module/'.$c_module.'/common.inc.php';

if($USER['itemid']>0)
	amsg(l('请先退出'),'w',AYA_URL.$c_path);

if(IN_POST){
	session_start();
	extract($posts,EXTR_SKIP);
	
	$checkcode=(string)$checkcode;
	$spassword=(string)$spassword;
	$password=(string)$password;
	$password2=(string)$password2;
	
	if(strlen($checkcode)<1)
		amsg(l('请输入验证码'),'w','$("#checkcode").focus();');
	if(strtolower($checkcode)!=$_SESSION['checkcode']){
		$_SESSION['checkcode']=random();
		amsg(l('验证码不符'),'w','checkcode();');
	}
	
	$o=new member();
	$o->table='member';
	
	$p=array (
			'groupid'=>$CFG['reggroup'],
			'aya_a'=>0,
			'aya_b'=>0,
			'aya_c'=>0,
			'sex'=>$sex?1:0,
			'name'=>(string)$name,
			'email'=>(string)$email,
			'password'=>(string)$password,
			'password2'=>(string)$password2,
			'last_post'=>0,
			'regtime'=>TIME 
	);
	
	$o->check($p);
	$o->fields_check($p);
	
	$p['password']=md5(md5($p['password']));
	
	$o->add($p);
	$_SESSION['checkcode']=random();
	
	$user=$o->get_one('name',$p['name']);
	$o->login($user);
	
	amsg(l('注册成功'),'s',AYA_URL.$c_path);
}

include template($action,$c_module,$c_dirname);