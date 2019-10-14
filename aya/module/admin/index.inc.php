<?php
defined('IN_AYA') or exit('Access Denied');

$cfile='omsg.php';
$msg=cache_read($cfile);

include template($action,'admin');