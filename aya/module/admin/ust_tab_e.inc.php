<?php
defined('IN_AYA') or exit('Access Denied');

$name=(string)$_GET['name'];
$fname=(string)$_GET['fname'];

isset($ADDFIELD[$name]) or amsg('404');
check_filename($fname) or amsg('404');

$path=AYA_ROOT.'table/'.$name.'/';

$file=$path.$fname;
is_file($file) or amsg('404');

$names=thesenames($path);

if(IN_POST){
	extract($posts);
	check_filename($filename) or amsg(l('请正确填写文件名'),'w','$("#filename").focus();');
	
	$filename.='.php';
	
	file_put($file,$code);
	
	if($filename!=$fname){
		rename($path.$fname,$path.$filename);
		unset($names[$fname]);
	}
	
	$names[$filename]=$note;
	if(put_thesename($names,$path))
		amsg(l('保存成功'),'s',AYA_ADMIN_URL.'?action=ust_tab&name='.$name);
	else
		amsg(l('无法写入'),'w');
}

$code=file_get($file);
$filename=filename($fname);
$note=$names[$fname];

include template($action,'admin');
