<?php
defined('IN_AYA') or exit('Access Denied');

if(IN_POST){
	extract($posts,EXTR_SKIP);
	$note=(string)$note;
	$url=(string)$url;
	$up=(string)$up;
	if(strlen($note)<1)
		amsg(l('请填写备注'),'w','$("#note").focus();');
	
	$up=move_upload($up);
	if(strlen($up)>0)
		$url=$up;
	
	if(strlen($url)<1)
		amsg(l('请填写视频地址或上传文件'),'w','$("#url").focus();');
	
	$p=array (
			'url'=>$url,
			'title'=>(string)$title,
			'content'=>(string)$content,
			'note'=>$note,
			'posttime'=>TIME 
	);
	
	$sql=sql_insert($p);
	if(!$db->query("insert into ".PF."video $sql")){
		amsg(l('无法写入数据库'),'w');
	}
	
	amsg(l('新建成功'),'s',AYA_ADMIN_URL.'?action=ust_video');
}

include template($action,'admin');
