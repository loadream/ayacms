<?php
defined('IN_AYA') or exit('Access Denied');

if(!$item=$db->get_one("SELECT * FROM ".PF."video WHERE itemid=$itemid"))
	amsg(l('信息不存在'),'w');

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
	
	if($url!=$item['url']&&preg_match('/\d{4}\/\d{2}\/[A-Za-z0-9\.]+/isU',$item['url'])){
		file_del(AYA_ROOT.'upload/'.$item['url']);
	}
	
	$p=array (
			'url'=>$url,
			'title'=>(string)$title,
			'content'=>(string)$content,
			'note'=>$note 
	);
	
	$sql=sql_update($p);
	if($db->query("UPDATE {$db->pre}video SET {$sql} WHERE itemid={$itemid}"))
		amsg(l('更新成功'),'s');
	else
		amsg(l('失败'),'w');
}

$_=$item;
extract(htmls($_),EXTR_SKIP);

include template($action,'admin');
