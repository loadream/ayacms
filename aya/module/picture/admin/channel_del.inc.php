<?php
defined('IN_AYA') or exit('Access Denied');

$o=new picture();
$o->table='picture_'.$channelid;
$o->channelid=$channelid;
$o->channel_clean();

$sql="DROP TABLE `".PF."picture_".$channelid."`";
if(!$db->query($sql)) return l('数据表删除失败');


return true;
