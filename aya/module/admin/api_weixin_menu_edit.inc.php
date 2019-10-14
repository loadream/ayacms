<?php
defined('IN_AYA') or exit('Access Denied');

$cfg=include AYA_ROOT.'api/weixin/config.inc.php';
$x=(int)$_GET['x'];
$y=(int)$_GET['y'];
$menu=(array)$cfg['menu'][$x][$y];



if(IN_POST){
	extract($posts);
	
$arr=&$cfg['menu'];
$arr[$x][$y]=array('name'=>$name,'type'=>$type,'text'=>$text,'link'=>$link,'url'=>$url,'pic_id'=>$pic_id,'article_cid'=>$article_cid,'product_cid'=>$product_cid);

if(!put_config($cfg,AYA_ROOT.'api/weixin/'))
		amsg(l('更新失败'),'w');
	
	amsg(l('提交成功'),'s','location=get_location_href();');
}


htmls($menu);
extract($menu,EXTR_SKIP);
include template($action,'admin');
