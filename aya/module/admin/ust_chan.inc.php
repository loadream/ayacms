<?php
defined('IN_AYA') or exit('Access Denied');

$lang=(string)$_GET['lang'];
if($lang)
	in_array($lang,$LANG) or amsg('404,'.l('禁止访问'));
else
	$lang=AYA_LANG;

$level=$LEVEL[$lang];

include template($action,'admin');
