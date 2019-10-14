<?php
defined('IN_AYA') or exit('Access Denied');

$name=(string)$_GET['name'];
$dir=(string)$_GET['dir'];
$path=ROOT.ltrim($dir,'/');
$client=(string)$_GET['client'];

$names=thesenames($path);
check_filename($name) or amsg('404');
is_file($path.$name) or amsg(l('模板不存在'),'w');

if(IN_POST){
	extract($posts);
	
	file_put($path.$name,(string)$content) or amsg(l('无法保存模板'),'w');
	$names[$name]=(string)$note;
	put_thesename($names,$path) or amsg(l('无法保存备注'));
	
	amsg(l('保存成功'),'s');
}

$content=file_get($path.$name);
$note=$names[$name];
include template($action,'article');