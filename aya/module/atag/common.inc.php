<?php
defined('IN_AYA') or exit('Access Denied');
$FD=cache_read('field-'.$c_table.'.php');

$page=intval($_GET['page']);
$page<1&&$page=1;
$offset=($page-1)*$c_pagesize;

$tag=(string)$_GET['tag'];
$id=(string)$_GET['id'];
