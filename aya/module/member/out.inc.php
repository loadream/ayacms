<?php
defined('IN_AYA') or exit('Access Denied');
require AYA_ROOT.'/module/'.$c_module.'/common.inc.php';

set_cookie('auth','');

amsg(l('成功退出'),'s',AYA_URL);
