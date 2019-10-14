<?php
defined('IN_AYA') or exit('Access Denied');

$item=$db->get_one("SELECT * FROM {$db->pre}epage WHERE channelid={$channelid}");

$o=new epage();
$o->channel_clean($item);

return true;
