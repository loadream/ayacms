<?php
defined('IN_AYA') or exit('Access Denied');

$arr=include AYA_ROOT.'config.inc.php';

if(IN_POST){
	extract($posts);
	
	$aanew=(int)$aanew;
	$aahot=(int)$aahot;
	
	empty($aanew)&&amsg(l('请填写时限'),'w','$("#aaanew").focus();');
	empty($aahot)&&amsg(l('请填写查看数'),'w','$("#aahot").focus();');
	
	$arr['aayouhao']=$aayouhao?1:0;
	$arr['aanew']=$aanew;
	$arr['aahot']=$aahot;
	$arr['aacolor']=input2arr($aacolor);
	
	if(!put_config($arr))
		amsg(l('更新失败'),'w');
	
	amsg(l('提交成功'),'s');
}

$arr['aacolor']=arr2input($arr['aacolor']);

htmls($arr);
extract($arr,EXTR_SKIP);
include template($action,'admin');
