<?php
defined('IN_AYA') or exit('Access Denied');

if(!$item=$db->get_one("SELECT * FROM ".PF."link WHERE itemid=$itemid"))
	amsg(l('信息不存在'),'w');

$item['titles']=explode('|',$item['titles']);
$item['contents']=explode('|',$item['contents']);
$item['openlinks']=explode('|',$item['openlinks']);
$item['urls']=explode('|',$item['urls']);

if(IN_POST){
	extract($posts,EXTR_SKIP);
	$note=(string)$note;
	if(strlen($note)<1)
		amsg(l('请填写备注'),'w','$("#note").focus();');
	
	$titles=$contents=$openlinks=$urls=$notes=array (
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'' 
	);
	for($i=0;$i<20;$i++){
		
		if(${'title_'.$i}){
			$urls[$i]=move_upload(${'url_'.$i});
			$titles[$i]=(string)${'title_'.$i};
			$contents[$i]=(string)${'content_'.$i};
			$openlinks[$i]=(string)${'openlink_'.$i};
		}
	}
	if($pics==array (
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			''
	))
		amsg(l('至少上传一个'),'w');
	
	for($i=0;$i<20;$i++){
		if($item['urls'][$i]&&$item['urls'][$i]!=$urls[$i])
			upload_del($item['urls'][$i]);
	}
	
	$p=array (
			'urls'=>implode('|',$urls),
			'titles'=>implode('|',$titles),
			'contents'=>implode('|',$contents),
			'openlinks'=>implode('|',$openlinks),
			'note'=>$note 
	);
	
	$sql=sql_update($p);
	if($db->query("UPDATE {$db->pre}link SET {$sql} WHERE itemid={$itemid}"))
		amsg(l('更新成功'),'s');
	else
		amsg(l('失败'),'w');
}

htmls($item);
extract($item,EXTR_SKIP);

include template($action,'admin');
