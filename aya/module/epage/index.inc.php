<?php
defined('IN_AYA') or exit('Access Denied');
require AYA_ROOT.'module/'.$c_module.'/common.inc.php';

$o=new epage();
$o->table=$c_table;
$o->channelid=$channelid;

if(!$item=$o->get_one('channelid',$channelid))
	amsg(l('信息不存在'),'w');

include template($action,$c_module,$c_dirname);