<?php
defined('IN_AYA') or exit('Access Denied');

$o=new apage();
$o->table='apage_'.$channelid;
$o->channel_clean();

$sql="DROP TABLE `".PF."apage_".$channelid."`";
if(!$db->query($sql)) return l('数据表删除失败');

return true;