<?php
defined('IN_AYA') or exit('Access Denied');

$cfg=include AYA_ROOT.'api/weixin/config.inc.php';

$menu=$cfg['menu'];

htmls($menu);
include template($action,'admin');
