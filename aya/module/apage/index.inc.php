<?php
defined('IN_AYA') or exit('Access Denied');
require AYA_ROOT.'module/'.$c_module.'/common.inc.php';

if(!$item=$db->get_one("SELECT * FROM ".PF."{$c_table} WHERE itemid='1'"))
	amsg('404');

$_=$item;
extract(htmls($_),EXTR_SKIP);

apply('seo_title',$item['title']);
apply('seo_keywords',$item['keywords']);
apply('seo_description',$item['note']);

apply('pathnav',array (
		$title 
));
include template($action,$c_module,$c_dirname);
