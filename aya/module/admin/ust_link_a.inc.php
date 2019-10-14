<?php
defined('IN_AYA') or exit('Access Denied');

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
	
	$p=array (
			'urls'=>implode('|',$urls),
			'titles'=>implode('|',$titles),
			'contents'=>implode('|',$contents),
			'openlinks'=>implode('|',$openlinks),
			'note'=>$note,
			'posttime'=>TIME 
	);
	
	$sql=sql_insert($p);
	if(!$db->query("insert into ".PF."link $sql")){
		amsg(l('无法写入数据库'),'w');
	}
	
	amsg(l('新建成功'),'s',AYA_ADMIN_URL.'?action=ust_link');
}

include template($action,'admin');
