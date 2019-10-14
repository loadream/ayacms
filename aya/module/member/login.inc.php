<?php
defined('IN_AYA') or exit('Access Denied');
require AYA_ROOT.'module/'.$c_module.'/common.inc.php';

$USER['itemid']>0&&amsg(l('您已经登陆'));

if(IN_POST){
	session_start();
	extract($posts,EXTR_SKIP);
	
	$name=(string)$name;
	$password=(string)$password;
	$checkcode=(string)$checkcode;
	
	if(strlen($name)<1)
		amsg(l('请填写用户名'),'w','$("#name").focus();');
	if(strlen($checkcode)<1)
		amsg(l('请填写验证码'),'w','$("#checkcode").focus();');
	if(strtolower($checkcode)!=$_SESSION['checkcode'])
		amsg(l('验证码不符'),'w','checkcode();');
	
	$o=new member();
	$o->table='member';
	
	$r=$o->get_one('name',$name);
	if(empty($r))
		amsg(l('用户不存在'),'w','$("#name").focus();');
	
	if(!$o->is_password($password))
		amsg($o->msg,'w','$("#'.$o->htmlid.'").focus();');
	
	if($r['password']!=md5(md5($password))){
		$_SESSION['code']=random();
		amsg(l('密码错误'),'w','checkcode();');
	}
	
	$o->login($r);
	
	amsg(l('登录成功'),'s',AYA_URL.$c_path);
}

include template($action,$c_module,$c_dirname);