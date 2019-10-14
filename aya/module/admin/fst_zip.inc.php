<?php
defined('IN_AYA') or exit('Access Denied');

$file=(string)$_GET['file'];
false===check_path($file)&&amsg(l('参数错误'),'w');

$file=ROOT.$file;
if(!is_file($file))
	amsg(l('文件不存在'),'w');

$archive=new pclzip($file);
if($archive->extract(PCLZIP_OPT_PATH,basename($path),PCLZIP_OPT_REPLACE_NEWER)==0)
	amsg(l('解压失败'),'w');

amsg(l('成功解压'),'s','location=get_location_href();');