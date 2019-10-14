<?php
defined('IN_AYA') or exit('Access Denied');

$lang=(string)$_GET['lang'];
if($lang)
	in_array($lang,$LANG) or amsg('404,'.l('禁止访问'));
else
	$lang=AYA_LANG;

$channelid=(int)$_GET['channelid'];
isset($CHANNELS[$channelid]) or amsg('403,'.l('参数错误'));

$items=$CHANNELS[$channelid];

if(IN_POST){
	extract($posts);
	
	empty($name)&&amsg(l('请正确填写栏目名称'),'w','$("#name").focus();');
	empty($dirname)&&amsg(l('请正确填写URL标识'),'w','$("#dirname").focus();');
	
	check_name($dirname) or amsg(l('请正确填写URL标识'),'w','$("#dirname").focus();');
	
	if($parentid>0&&$parentid==$items['channelid'])
		amsg(l('参数错误'),'w','$("#parentid").focus();');
	if($channelid!=$items['channelid']&&!empty($LEVEL[$lang][$channelid]))
		amsg(l('参数错误'),'w','$("#parentid").focus();');
	
	$p=array (
			'name'=>$name,
			'path'=>$dirname.'/',
			'isblank'=>$isblank?1:0,
			'hide_pc'=>$hide_pc?1:0,
			'hide_tc'=>$hide_tc?1:0,
			'hide_wx'=>$hide_wx?1:0,
			'dirname'=>$dirname,
			'parentid'=>$parentid,
			'keywords'=>$keywords,
			'description'=>$description 
	);
	
	is_file($file=AYA_ROOT.'module/'.$items['module'].'/admin/channel_edit.inc.php') or amsg(l('模型组件缺失'),'w');
	
	// 建目录$dirname
	$channel_path=ROOT.$dirname.'/';
	if($dirname!=$items['dirname']){
		
		is_dir($channel_path)&&amsg(l('URL标识已存在'),'w');
		
		rename(ROOT.$items['dirname'],$channel_path) or amsg(l('无法更改目录名'),'d');
	}
	
	$return=include $file;
	if($return!==true){
		amsg($return,'w');
	}
	
	$sql=sql_update($p);
	if(!$db->query("UPDATE {$db->pre}channel SET {$sql} WHERE channelid={$channelid}")){
		$error=l('无法更新数据库');
	}
	
	amsg(l('更新成功'),'s',AYA_ADMIN_URL.'?action=ust_chan&lang='.$lang);
}

$mods=thesenames(AYA_ROOT.'module/',1,1);

htmls($items);
extract($items,EXTR_SKIP);
include template($action,'admin');
