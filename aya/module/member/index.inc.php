<?php
defined('IN_AYA') or exit('Access Denied');
require AYA_ROOT.'/module/'.$c_module.'/common.inc.php';

$USER['itemid']<1 && amsg('301,'.l('请先登陆(%s秒后自动跳转..)',3),'w',AYA_URL.$c_path.'login.php');

$item=$USER;

$item['regtime']=date('Y-m-d H:i:s',$item['regtime']);
$item['sex']=$item['sex']?l('男'):l('女');

$_=$item;
extract(htmls($_),EXTR_SKIP);

include template($action,$c_module,$c_dirname);