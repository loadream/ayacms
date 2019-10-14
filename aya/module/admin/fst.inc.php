<?php
defined('IN_AYA') or exit('Access Denied');

$file=(string)$_GET['file'];
false===check_path($file)&&amsg(l('参数错误'),'w');

if(!is_dir(ROOT.$file))
	amsg(l('目录不存在'));

$info=get_pathinfo($file);

$nav_dir=$file;
include template($action,'admin');
