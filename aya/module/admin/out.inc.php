<?php
defined('IN_AYA') or exit('Access Denied');

set_cookie('auth','');

amsg(l('成功退出'),'s',AYA_ADMIN_URL.'?action=login');
