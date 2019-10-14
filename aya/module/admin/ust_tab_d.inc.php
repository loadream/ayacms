<?php
defined('IN_AYA') or exit('Access Denied');

$name=(string)$_GET['name'];
$fname=(string)$_GET['fname'];

isset($ADDFIELD[$name]) or amsg('404');
$path=AYA_ROOT.'table/'.$name.'/';
$names=thesenames($path);

if(IN_POST){
	$arr=$posts['ids'];
	count($arr) or amsg(l('至少选择一项'),'w');
}else
	$arr=array (
			$fname 
	);

foreach($arr as $v){
	if(!check_filename($v))
		continue;
	if(file_del($path.$v)){
		unset($names[$v]);
	}
}

put_thesename($names,$path);
amsg(l('已删除'),'s',AYA_ADMIN_URL.'?action=ust_tab&name='.$name);

