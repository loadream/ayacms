<?php
defined('IN_AYA') or exit('Access Denied');
$FD=cache_read('field-'.$c_table.'.php');
$CS=cache_read('class-'.$channelid.'.php');

$PV=strlen($c_pv)>0?unserialize($c_pv):array ();

if(!empty($PV['in'])&&is_array($PV['in'])&&!isset($PV['in'][$USER['groupid']]))
	amsg(l('权限不足,禁止进入'),'d');
