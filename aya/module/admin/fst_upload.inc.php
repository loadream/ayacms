<?php
defined('IN_AYA') or exit('Access Denied');

$file=(string)$_GET['file'];
false===check_path($file)&&amsg(l('参数错误'),'w');

$path=ROOT.$file;
if(!is_dir($path))
	amsg(l('路径不存在'),'w');

$targetFile=$path.'/'.$_FILES['upfile']['name'];

if(move_uploaded_file($_FILES['upfile']['tmp_name'], $targetFile))
	amsg(l('已上传,正在返回'),'s',AYA_ADMIN_URL.'?action=fst&file='.$file);
else amsg(l('失败'),'w');




