<?php
defined('IN_AYA') or exit('Access Denied');

$os=@explode(" ",php_uname());
$info=array();
$info[0]=date("Y-n-j H:i:s");
$info[1]=$os[0].'/'.PHP_OS;
$info[2]=$_SERVER['SERVER_SOFTWARE'];
$info[3]=PHP_VERSION;
$info[4]=php_sapi_name();
$info[5]=mysql_get_server_info();
$info[6]=round((@disk_free_space(".")/(1024*1024)),2);
$info[7]=getPHPini("memory_limit");
$info[8]=getPHPini("post_max_size");
$info[9]=getPHPini("upload_max_filesize");
$info[10]=getPHPini("max_execution_time");

include template($action,'admin');

function getPHPini($varName){
	switch($res=get_cfg_var($varName)){
		case 0:
			return 'NO';
			break;
		case 1:
			return 'YES';
			break;
		default:
			return $res;
			break;
	}
}