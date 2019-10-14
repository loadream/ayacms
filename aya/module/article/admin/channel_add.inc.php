<?php
defined('IN_AYA') or exit('Access Denied');

$sql="
CREATE TABLE IF NOT EXISTS `".PF."article_".$channelid."` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `author` varchar(20) NOT NULL DEFAULT '',
  `posttime` int(10) NOT NULL DEFAULT '0',
  `content` longtext NOT NULL,
  `title` varchar(100) NOT NULL,
  `hits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `keyword` varchar(100) NOT NULL,
  `cs` varchar(250) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL,
  `subtitle` varchar(100) NOT NULL,
  `note` char(255) NOT NULL,
  `sign` varchar(100) NOT NULL,
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `tag` varchar(100) NOT NULL,
  `color` varchar(12) NOT NULL,
  `original` tinyint(1) NOT NULL DEFAULT '0',
PRIMARY KEY (`itemid`),
KEY `hits` (`hits`),
KEY `sign` (`sign`),
KEY `posttime` (`posttime`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

if(!$db->query($sql))
	return '表创建失败';

$p['table']='article_'.$channelid;
$p['pagesize']=12;
$p['comment']=1;
$p['config']='title';
return true;
