<?php
defined('IN_AYA') or exit('Access Denied');

if(!$item=$db->get_one("SELECT * FROM ".PF."text WHERE itemid=$itemid"))
	amsg(l('信息不存在'),'w');

if(IN_POST){
	
	extract($posts,EXTR_SKIP);
	
	$note=(string)$note;
	$url=(string)$url;
	$pic=(string)$pic;
	if(strlen($note)<1)
		amsg(l('请填写备注'),'w','$("#note").focus();');
	
	$pic=move_upload($pic);
	
	if($pic!=$item['pic']){
		upload_del($item['pic']);
	}
	
	$p=array (
			'url'=>$url,
			'title'=>(string)$title,
			'content'=>(string)$content,
			'pic'=>$pic,
			'note'=>$note 
	);
	
	$sql=sql_update($p);
	if($db->query("UPDATE {$db->pre}text SET {$sql} WHERE itemid={$itemid}"))
		amsg(l('更新成功'),'s');
	else
		amsg(l('失败'),'w');
}

$_=$item;
extract(htmls($_),EXTR_SKIP);
include template($action,'admin');
