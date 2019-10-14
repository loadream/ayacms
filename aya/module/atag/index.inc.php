<?php
defined('IN_AYA') or exit('Access Denied');
require AYA_ROOT.'module/'.$c_module.'/common.inc.php';

$items=array ();

$rs=$db->query("SELECT * FROM ".PF."{$c_table}");

while($r=$db->fetch_array($rs)){
	$items[$r['id']]=$r;
}

$db->free_result($rs);

$data=array();
foreach ($items as $item){
	$data[$item['tag']][]=$item['id'];
}

$tags=array();
foreach ($data as $k=>$v){
	$tags[$k]=count($v);
}

arsort($tags);
include template($action,$c_module,$c_dirname);