<?php
defined('IN_AYA') or exit('Access Denied');

$sql=sql_insert(array('channelid'=>$channelid));
if(!$db->query("insert into ".PF.'epage '.$sql)) return '表创建失败';


$p['table']='epage';
$p['comment']=0;

return true;
