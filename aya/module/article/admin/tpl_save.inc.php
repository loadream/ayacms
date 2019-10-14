<?php
defined('IN_AYA') or exit('Access Denied');

$name=(string)$_GET['name'];
$dir=(string)$_GET['dir'];
$s=(string)$_GET['s'];

$path=ROOT.$dir;

$topath=ROOT.$c_dirname.'/'.$s.'/';

$names=thesenames($path);
$tonames=thesenames($topath);

check_filename($name) or amsg('404');
is_file($path.$name) or amsg(l('模板不存在'),'w');

$data=file_get($path.$name);
file_put($topath.$name,$data) or amsg(l('无法保存模板'),'w');

$tonames[$name]=(string)$names[$name];
put_thesename($tonames,$topath) or amsg(l('成功,但无法保存备注'));

amsg(l('成功'),'s',AYA_ADMIN_URL.'?action=tpl&channelid='.$channelid.'&in_module=1');
