<?php
defined('IN_AYA') or exit('Access Denied');

$in_sub=isset($_GET['in_sub']);

if(IN_POST){
	extract($posts,EXTR_SKIP);
	$name=(string)$name;
	strlen($name) or amsg(l('请填写名称'),'w','$("#name").focus();');
	
	$arr=explode(',', $name);
	
	foreach ($arr as $name){
		$name=trim($name);
		if(strlen($name)<1) continue;
	$p=array (
			'name'=>$name,
			'parentid'=>$in_sub?$itemid:0,
			'channelid'=>$channelid 
	);
	
	$sql=sql_insert($p);
	
	$db->query("insert into ".PF.'class '.$sql);
	}
	
	amsg('ok','s',AYA_ADMIN_URL.'?action=class&channelid='.$channelid.'&in_module=1');
}
		
include template($action,'article');
