<?php
defined('IN_AYA') or exit('Access Denied');

if(IN_POST){
	extract($posts);
	$ids=(array)$ids;
}else{
	$id=(string)$_GET['id'];
	if(strlen($id)<1 or preg_match('/[\\\.\/]/is',$id)){
		amsg(l('参数错误'),'w');
	}
	is_dir(AYA_ROOT.'backup/'.$id) or amsg(l('备份不存在'),'w');
	$ids=array (
			$id
	);
}

empty($ids)&&amsg(l('至少选择一个'),'w');

$names=thesenames(AYA_ROOT.'backup/',1);

foreach($ids as $id){
	if(!(strlen($id)<1 or preg_match('/[\\\.\/]/is',$id))){
		dir_delete(AYA_ROOT.'backup/'.$id.'/');
		unset($names[$id]);
	}
}
put_thesename($names,AYA_ROOT.'backup/');

amsg(l('删除成功'),'s',AYA_ADMIN_URL.'?action=ust_sql_g');
