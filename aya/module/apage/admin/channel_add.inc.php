<?php
defined('IN_AYA') or exit('Access Denied');

$sql="
CREATE TABLE IF NOT EXISTS `".PF."apage_".$channelid."` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `content` longtext NOT NULL,
  `title` varchar(100) NOT NULL,
PRIMARY KEY (`itemid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

if(!$db->query($sql))
	return '表创建失败';

	$sql=sql_insert(array('itemid'=>1));
	if(!$db->query("insert into ".PF.'apage_'.$channelid.' '.$sql)) return '行创建失败';
	
$p['table']='apage_'.$channelid;
return true;
