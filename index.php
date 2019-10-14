<?php
if(!is_file(dirname(__FILE__).'/aya/config.inc.php')){
	header('Location: install.php');
	exit();
}
if(is_file($file=dirname(__FILE__).'/aya/cache/home-dirname.php')){
	$_dirname=include $file;
}else{
	header('Content-Type: text/html; charset=utf-8');
die('您需要创建一个栏目 <br />You need to create a channel');
}

require $_dirname.'/index.php';
exit();


