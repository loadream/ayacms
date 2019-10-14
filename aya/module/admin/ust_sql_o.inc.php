<?php
defined('IN_AYA') or exit('Access Denied');

$re=$db->query('show table status');
$tabs=array ();
while($row=$db->fetch_array($re)){
	$tabs[]=$row['Name'];
}

foreach($tabs as $tab){
	if(!$db->query('OPTIMIZE TABLE '. $tab)) amsg(l('优化表出现错误').':'.$tab,'d');
}
amsg(l('已完成优化'),'s');