<?php
defined('IN_AYA') or exit('Access Denied');
$FD=cache_read('field-'.$c_table.'.php');
$CS=cache_read('class-'.$channelid.'.php');

$PV=strlen($c_pv)>0?unserialize($c_pv):array ();

if(!empty($PV['in'])&&is_array($PV['in'])&&!isset($PV['in'][$USER['groupid']]))
	amsg(l('权限不足,禁止进入'),'d');
	
	// 初始化部分常用变量
$page=intval($_GET['page']);
$page<1&&$page=1;
$offset=($page-1)*$c_pagesize;

$itemid=intval($_GET['itemid']);
$sign=(string)$_GET['sign'];

$o=(string)$_GET['o'];


