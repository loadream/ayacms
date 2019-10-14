<?php
defined('IN_AYA') or exit('Access Denied');

$file=(string)$_GET['file'];
false===check_path($file)&&amsg(l('参数错误'),'w');

$path=ROOT.$file;

if(!file_exists($path))
	amsg(l('文件或目录不存在'),'w');

if(IN_POST){
$newname=(string)$posts['newname'];
strlen($newname) or amsg(l('请填写文件名'),'w');

$newfile=ltrim(dirname($file).'/'.$newname,'/.');
false===check_path($newfile)&&amsg(l('命名错误'),'w');

$newpath=ROOT.$newfile;

if(file_exists($newpath))
	amsg(l('文件或目录已存在'),'w');

if(@rename($path,$newpath))
	amsg(l('更名成功'),'s','location=get_location_href();');
else amsg(l('失败'),'w');

}
include template($action,'admin');
