<?php
defined('IN_AYA') or exit('Access Denied');

$in_sub=isset($_GET['in_sub']);

if(!$item=$db->get_one("SELECT * FROM ".PF."class WHERE itemid={$itemid}"))
	
	amsg(l('信息不存在'),'w');

if(IN_POST){
	extract($posts,EXTR_SKIP);
	$name=(string)$name;
	
	strlen($name) or amsg(l('请填写名称'),'w','$("#name").focus();');
	$p=array (
			'name'=>$name 
	);
	
	$sql=sql_update($p);
	
	if(!$db->query("UPDATE ".PF."class SET ".$sql." WHERE itemid='{$itemid}'")){
		amsg('失败','w');
	}else
		amsg(l('已修改'),'s',AYA_ADMIN_URL.'?action=class&channelid='.$channelid.'&in_module=1');
}

$_=$item;
extract(htmls($_),EXTR_SKIP);

include template($action,'article');
