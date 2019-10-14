<?php
chdir(dirname(__FILE__));
$action=basename(__FILE__,'.php');
require 'config.inc.php';
require '../aya/common.inc.php';
require AYA_ROOT.'module/'.$c_module.'/'.$action.'.inc.php';