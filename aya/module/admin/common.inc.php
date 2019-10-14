<?php
defined('IN_AYA') or exit('Access Denied');

$action=(string)$_GET['action'];
$channelid=(int)$_GET['channelid'];

empty($action)&&$action='index';

check_name($action) or amsg('404');

// 是否会员
if($USER['itemid']<1&&$action!='login'){
	amsg(l('请先登录(%s秒后跳转..)',3),'i',AYA_ADMIN_URL.'?action=login');
}

if(IN_MODULE){
	isset($CHANNELS[$channelid]) or amsg('404');
	
	$CHANNEL=cache_read('channel-'.$channelid.'.php');
	extract($CHANNEL,EXTR_PREFIX_ALL,'c');
	$FD=cache_read('field-'.$c_table.'.php');
	$CS=cache_read('class-'.$channelid.'.php');
	
	// 强制页数
	$c_pagesize=20;
	
	$file=AYA_ROOT.'module/'.$c_module.'/admin/'.$action.'.inc.php';
	$pca=AYA_ADMIN_URL.'?channelid='.$channelid.'&action='.$action.'&in_module=1';
}else{
	
	$file=AYA_ROOT.'module/admin/'.$action.'.inc.php';
	$pca=AYA_ADMIN_URL.'?action='.$action;
}

is_file($file) or amsg('404');

// 初始化部分常用变量
$page=intval($_GET['page']);
$page<1&&$page=1;
$offset=($page-1)*$c_pagesize;

$itemid=intval($_GET['itemid']);

require $file;

