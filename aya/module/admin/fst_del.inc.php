<?php
defined('IN_AYA') or exit('Access Denied');

$file=(string)$_GET['file'];
false===check_path($file)&&amsg(l('参数错误'),'w');

$path=ROOT.$file;

if(!file_exists($path))
	amsg(l('文件或目录不存在'),'w');

if(is_dir($path)){
	$func='dir_delete';
}else{
	$func='file_del';
}

if($func($path))
	amsg(l('已删除'),'s','location=get_location_href();');
else
	amsg(l('失败'),'w');

