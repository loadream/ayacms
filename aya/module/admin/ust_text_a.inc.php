<?php
defined('IN_AYA') or exit('Access Denied');

if(IN_POST){
	extract($posts,EXTR_SKIP);
	$note=(string)$note;
	$url=(string)$url;
	$pic=(string)$pic;
	if(strlen($note)<1)
		amsg(l('请填写备注'),'w','$("#note").focus();');
	
	$pic=move_upload($pic);
	
	$p=array (
			'url'=>$url,
			'title'=>(string)$title,
			'content'=>(string)$content,
			'note'=>$note,
			'pic'=>$pic,
			'posttime'=>TIME 
	);
	
	$sql=sql_insert($p);
	if(!$db->query("insert into ".PF."text $sql")){
		amsg(l('无法写入数据库'),'w');
	}
	
	amsg(l('新建成功'),'s',AYA_ADMIN_URL.'?action=ust_text');
}

include template($action,'admin');
