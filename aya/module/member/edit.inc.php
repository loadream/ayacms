<?php
defined('IN_AYA') or exit('Access Denied');
require AYA_ROOT.'module/'.$c_module.'/common.inc.php';

$USER['itemid']<1 && amsg('301,'.l('请先登陆(%s秒后自动跳转..)',3),'w',AYA_URL.$c_path.'login.php');

$item=$USER;

if(IN_POST){
	extract($posts,EXTR_SKIP);
	$p=array(
			'sex'=>$sex?1:0,		
	);
	
	$o=new member;
	$o->table='member';

	$o->fields_check($p);
	$o->edit($p,$item);
	amsg(l('修改成功'),'s',AYA_URL.$c_path);
}

$_=$item;
extract(htmls($_),EXTR_SKIP);

include template($action,$c_module,$c_dirname);