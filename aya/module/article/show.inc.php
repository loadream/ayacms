<?php
defined('IN_AYA') or exit('Access Denied');
require AYA_ROOT.'module/'.$c_module.'/common.inc.php';

if(strlen($sign)>0){
	if(!$item=$db->get_one("SELECT * FROM ".PF."{$c_table} WHERE sign='".addslashes($sign)."'"))
		amsg('404');
	$itemid=$item['itemid'];
}else if(!$item=$db->get_one("SELECT * FROM ".PF."{$c_table} WHERE itemid='{$itemid}'"))
	amsg('404');

$item['new']=is_new($item['posttime']);
$item['thumb']=$item['thumb']?AYA_URL.'aya/upload/'.$item['thumb']:'';
$item['hot']=is_hot($item['hits']);
$_=$item['tag']?explode(',',$item['tag']):array ();
foreach($_ as $k=>$v){
	$_[$k]=array (
			'name'=>$v,
			'url'=>url(fm_path('atag'),'','tag='.urlencode($v)) 
	);
}
$item['tag']=$_;

$item['stat']=array (
		'',
		$item['level']>0?'':'icon-star-empty',
		$item['level']>1?'':'icon-star-empty',
		$item['level']>2?'':'icon-star-empty',
		$item['level']>3?'':'icon-star-empty',
		$item['level']>4?'':'icon-star-empty' 
);

// hits+1
$db->query("UPDATE ".PF."{$c_table} SET hits=hits+1 WHERE itemid=$itemid");
// previous
if(!$previous=$db->get_one("SELECT itemid,title,sign FROM ".PF."{$c_table} WHERE itemid<{$itemid} ORDER by itemid desc")){
	$previous['url']='javascript:void(0)';
	$previous['title']=l('没有上一篇');
	$previous['class']='disabled';
}else{
	$previous['url']=url($c_path,'show.php',$previous['sign']?('&sign='.$previous['sign']):('itemid='.$previous['itemid']));
	$previous['title']=html($previous['title']);
}

// next
if(!$next=$db->get_one("SELECT itemid,title,sign FROM ".PF."{$c_table} WHERE itemid>{$itemid} ORDER by itemid asc")){
	$next=array ();
	$next['url']='javascript:void(0)';
	$next['title']=l('没有下一篇');
	$next['class']='disabled';
}else{
	$next['url']=url($c_path,'show.php',$next['sign']?('&sign='.$next['sign']):('itemid='.$next['itemid']));
	$next['title']=html($next['title']);
}
$_=$item;
extract(htmls($_),EXTR_SKIP);

apply('seo_title',$item['title']);
apply('seo_keywords',$item['keywords']);
apply('seo_description',$item['note']);

apply('pathnav',array (
		$item['title'] 
));
include template($action,$c_module,$c_dirname);
