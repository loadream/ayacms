<?php
defined('IN_AYA') or exit('Access Denied');

$arr=include AYA_ROOT.'config.inc.php';

$_tpls=thesenames(AYA_ROOT.'template/',1);

if(IN_POST){
	extract($posts);
	
	empty($timezone)&&amsg(l('请填写时区'),'w','$("#timezone").focus();');
	empty($cookie_pre)&&amsg(l('请填写cookie前缀'),'w','$("#cookie_pre").focus();');
	empty($aya_key)&&amsg(l('请填写网站秘钥'),'w','$("#aya_key").focus();');
	
	$arr['template_pc']=$template_pc;
	$arr['template_tc']=$template_tc;
	$arr['template_wx']=$template_wx;
	$arr['reggroup']=$reggroup;
	$arr['timezone']=$timezone;
	$arr['cookie_pre']=$cookie_pre;
	$arr['aya_key']=$aya_key;
	$arr['rewrite']=empty($rewrite)?0:1;
	$arr['kregword']=trim($kregword,',');
	
	if(!put_config($arr))
		amsg(l('更新失败'),'w');
	amsg(l('提交成功'),'s',AYA_ADMIN_URL.'?action=set_other');
}

htmls($arr);
extract($arr,EXTR_SKIP);

include template($action,'admin');
