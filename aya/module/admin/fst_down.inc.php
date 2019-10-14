<?php
defined('IN_AYA') or exit('Access Denied');

$file=(string)$_GET['file'];
false===check_path($file)&&amsg(l('参数错误'),'w');

$path=ROOT.$file;
if(!is_file($path))
	amsg(l('文件不存在'),'w');

file_down($path);