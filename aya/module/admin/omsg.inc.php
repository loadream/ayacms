<?php
defined('IN_AYA') or exit('Access Denied');

$cfile='omsg.php';
$msg=cache_read($cfile);

if((TIME-(int)$msg['time'])>3600) $msg=array();
if(empty($msg)){
	$url = 'http://www.ayacms.com/ayacms_msg/?type=admin&by='.AYA_URL;
	$omsg=get_remote_file($url,2);
	empty($omsg) && $omsg='';	
	$msg=array('time'=>TIME,'omsg'=>$omsg);
	cache_write($cfile,$msg);
}
exit;