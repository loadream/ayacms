<?php
defined('IN_AYA') or exit('Access Denied');

$lang=(string)$_GET['lang'];
if($lang)
	in_array($lang,$LANG) or amsg('404,'.l('禁止访问'));
else
	$lang=AYA_LANG;

$channelid=(int)$_GET['channelid'];

isset($CHANNELS[$channelid]) or amsg(l('频道不存在'));
extract($CHANNELS[$channelid],EXTR_SKIP);

$language==$lang or amsg(l('参数错误'),'w');

empty($LEVEL[$lang][$channelid]) or amsg(l('请先删除子栏目'),'w');

// 模型内数据处理
is_file($file=AYA_ROOT.'module/'.$module.'/admin/channel_del.inc.php') or amsg(l('模型组件缺失'),'w');
$return=include $file;

if($return!==true){
	amsg($return,'w');
}

// 删除目录
$dir=ROOT.$CHANNELS[$channelid]['dirname'];
trim($CHANNELS[$channelid]['dirname'],'/\\ ')=='' && amsg(l('参数错误'),'w');

if(!dir_delete($dir))
	amsg(l('目录删除失败'),'w');
	
	// 删除表
$db->query("DELETE FROM {$db->pre}channel WHERE channelid='$channelid'");

// 删除可能存在的分类
$db->query("delete from ".PF."class where channelid='$channelid'");

amsg(l('删除成功'),'s',AYA_ADMIN_URL.'?action=ust_chan&lang='.$lang);

