<?php
defined('IN_AYA') or exit('Access Denied');

$name=(string)$_GET['name'];

isset($ADDFIELD[$name]) or amsg('404');
$path=AYA_ROOT.'table/'.$name.'/';

$names=thesenames($path);

if(IN_POST){
	extract($posts);
	
	check_filename($filename) or amsg(l('请正确填写文件名'),'w','$("#filename").focus();');
	
	$file=$path.$filename.'.php';
	is_file($file)&&amsg(l('文件名已存在'),'w','$("#filename").focus();');
	
	file_put($file,$code);
	
	$names[$filename]=$note;
	
	if(put_thesename($names,$path))
		amsg(l('新建成功'),'s',AYA_ADMIN_URL.'?action=ust_tab&name='.$name);
	else
		amsg(l('无法写入'),'w');
}

$fname=(string)$_GET['fname'];

if($fname){
	check_filename($fname) or amsg('404');
	$file=AYA_ROOT.'table/'.$name.'/'.$fname;
}else
	$file=AYA_ROOT.'table/'.$name.'/index.php';

$code=file_get($file);
$note='';
include template($action,'admin');
