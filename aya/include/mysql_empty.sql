-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 06 月 30 日 06:07
-- 服务器版本: 5.1.41
-- PHP 版本: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `aya3`
--

-- --------------------------------------------------------

--
-- 表的结构 `aya3_book`
--

DROP TABLE IF EXISTS `aya3_book`;
CREATE TABLE IF NOT EXISTS `aya3_book` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `posttime` int(10) NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel` varchar(20) NOT NULL,
  PRIMARY KEY (`itemid`),
  KEY `posttime` (`posttime`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aya3_channel`
--

DROP TABLE IF EXISTS `aya3_channel`;
CREATE TABLE IF NOT EXISTS `aya3_channel` (
  `channelid` smallint(8) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(20) NOT NULL DEFAULT '',
  `path` varchar(255) NOT NULL DEFAULT '',
  `language` varchar(10) NOT NULL DEFAULT '',
  `listorder` smallint(4) unsigned NOT NULL DEFAULT '0',
  `isblank` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `dirname` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `hide_pc` tinyint(1) NOT NULL DEFAULT '0',
  `hide_tc` tinyint(1) NOT NULL DEFAULT '0',
  `hide_wx` tinyint(1) NOT NULL DEFAULT '0',
  `parentid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `pagesize` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `table` varchar(50) NOT NULL DEFAULT '',
  `orderby` varchar(250) NOT NULL DEFAULT '',
  `pv` text NOT NULL,
  `config` varchar(255) NOT NULL DEFAULT '',
  `comment` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`channelid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aya3_class`
--

DROP TABLE IF EXISTS `aya3_class`;
CREATE TABLE IF NOT EXISTS `aya3_class` (
  `itemid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` smallint(6) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `listorder` smallint(4) unsigned NOT NULL DEFAULT '0',
  `channelid` smallint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aya3_comment`
--

DROP TABLE IF EXISTS `aya3_comment`;
CREATE TABLE IF NOT EXISTS `aya3_comment` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `author` varchar(20) NOT NULL DEFAULT '0',
  `posttime` int(10) NOT NULL DEFAULT '0',
  `content` longtext NOT NULL,
  `channelid` mediumint(8) NOT NULL DEFAULT '0',
  `itemid_by` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`itemid`),
  KEY `posttime` (`posttime`),
  KEY `itemid_by` (`itemid_by`),
  KEY `channelid` (`channelid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aya3_field`
--

DROP TABLE IF EXISTS `aya3_field`;
CREATE TABLE IF NOT EXISTS `aya3_field` (
  `itemid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tb` varchar(30) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT '',
  `html` varchar(30) NOT NULL DEFAULT '',
  `default_value` text NOT NULL,
  `option_value` text NOT NULL,
  `width` smallint(4) unsigned NOT NULL DEFAULT '0',
  `height` smallint(4) unsigned NOT NULL DEFAULT '0',
  `input_limit` tinyint(1) NOT NULL DEFAULT '0',
  `addition` varchar(255) NOT NULL DEFAULT '',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `front` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `listorder` smallint(4) unsigned NOT NULL DEFAULT '0',
  `vmin` int(10) unsigned NOT NULL DEFAULT '0',
  `vmax` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aya3_link`
--

DROP TABLE IF EXISTS `aya3_link`;
CREATE TABLE IF NOT EXISTS `aya3_link` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `titles` text NOT NULL,
  `contents` text NOT NULL,
  `posttime` int(10) NOT NULL DEFAULT '0',
  `openlinks` text NOT NULL,
  `urls` text NOT NULL,
  `note` varchar(255) NOT NULL,
  PRIMARY KEY (`itemid`),
  KEY `posttime` (`posttime`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aya3_member`
--

DROP TABLE IF EXISTS `aya3_member`;
CREATE TABLE IF NOT EXISTS `aya3_member` (
  `itemid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `regtime` int(10) NOT NULL DEFAULT '0',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `groupid` tinyint(2) NOT NULL DEFAULT '1',
  `email` varchar(255) NOT NULL,
  `post_sum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `last_post` int(10) NOT NULL DEFAULT '0',
  `aya_a` int(10) NOT NULL DEFAULT '0',
  `aya_b` int(10) NOT NULL DEFAULT '0',
  `aya_c` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aya3_epage`
--

DROP TABLE IF EXISTS `aya3_epage`;
CREATE TABLE IF NOT EXISTS `aya3_epage` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `channelid` mediumint(8) NOT NULL,
  PRIMARY KEY (`itemid`),
  UNIQUE KEY `channelid` (`channelid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aya3_pic`
--

DROP TABLE IF EXISTS `aya3_pic`;
CREATE TABLE IF NOT EXISTS `aya3_pic` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `titles` text NOT NULL,
  `contents` text NOT NULL,
  `posttime` int(10) NOT NULL DEFAULT '0',
  `openlinks` text NOT NULL,
  `urls` text NOT NULL,
  `note` varchar(255) NOT NULL,
  PRIMARY KEY (`itemid`),
  KEY `posttime` (`posttime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aya3_poll`
--

DROP TABLE IF EXISTS `aya3_poll`;
CREATE TABLE IF NOT EXISTS `aya3_poll` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `posttime` int(10) NOT NULL DEFAULT '0',
  `note` varchar(255) NOT NULL,
  `polls` varchar(255) NOT NULL,
  `items` text NOT NULL,
  `content` text NOT NULL,
  `ty` tinyint(2) NOT NULL DEFAULT '0',
  `jy` varchar(50) NOT NULL,
  PRIMARY KEY (`itemid`),
  KEY `posttime` (`posttime`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aya3_search`
--

DROP TABLE IF EXISTS `aya3_search`;
CREATE TABLE IF NOT EXISTS `aya3_search` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channelid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `itemid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `posttime` int(10) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `sign` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_time` (`posttime`),
  KEY `pid` (`itemid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aya3_tag`
--

DROP TABLE IF EXISTS `aya3_tag`;
CREATE TABLE IF NOT EXISTS `aya3_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(20) NOT NULL,
  `channelid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `itemid` mediumint(8) NOT NULL DEFAULT '0',
  `sign` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `posttime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tag` (`tag`),
  KEY `post_time` (`posttime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aya3_text`
--

DROP TABLE IF EXISTS `aya3_text`;
CREATE TABLE IF NOT EXISTS `aya3_text` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `posttime` int(10) NOT NULL DEFAULT '0',
  `note` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`itemid`),
  KEY `posttime` (`posttime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `aya3_video`
--

DROP TABLE IF EXISTS `aya3_video`;
CREATE TABLE IF NOT EXISTS `aya3_video` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `posttime` int(10) NOT NULL DEFAULT '0',
  `note` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`itemid`),
  KEY `posttime` (`posttime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
