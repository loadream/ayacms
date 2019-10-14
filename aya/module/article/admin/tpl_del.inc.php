<?php
defined('IN_AYA') or exit('Access Denied');

$name=(string)$_GET['name'];
$dir=(string)$_GET['dir'];

$path=ROOT.ltrim($dir,'/');

$names=thesenames($path);
isset($names[$name]) or amsg(l('模板不存在'),'w');
unset($names[$name]);

if(file_del($path.$name)&&put_thesename($names,$path))
	amsg(l('成功'),'s',AYA_ADMIN_URL.'?action=tpl&channelid='.$channelid.'&in_module=1');
else
	amsg(l('无法删除'),'w');