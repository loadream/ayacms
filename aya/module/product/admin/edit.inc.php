<?php
defined('IN_AYA') or exit('Access Denied');

$o=new product();
$o->table=$c_table;
$o->channelid=$channelid;

if(!$item=$o->get_one('itemid',$itemid))
	amsg(l('信息不存在'),'w');
if(IN_POST){
	
	extract($posts,EXTR_SKIP);
	$posttime=(string)$posttime;
	
	$p=array (
			'title'=>(string)$title,
			'color'=>(string)$color,
			'subtitle'=>(string)$subtitle,
			'content'=>(string)$content,
			'note'=>(string)$note,
			'keyword'=>(string)$keyword,
			'tag'=>(string)$tag,
			'sign'=>(string)$sign,
			'posttime'=>strlen($posttime)?strtotime($posttime):TIME,
			'hits'=>(int)$hits,
			'original'=>(int)$original,
			'level'=>(int)$level,
			'thumb'=>(string)$thumb,
			'price'=>(int)$price,
			'cs'=>is_array($cs)?(','.implode(',',$cs).','):'',
			'pics'=>is_array($pics)?$pics:array()
	);
	
	$o->check($p);
	$o->fields_check($p);
	if($o->edit($p,$item))
		amsg(l('成功'),'s',AYA_ADMIN_URL.'?action='.$action.'&channelid='.$channelid.'&in_module=1&itemid='.$itemid);
	else
		amsg(l('失败'),'w');
}
$item['cs']=explode(',',$item['cs']);
$_=$item;
extract(htmls($_),EXTR_SKIP);

include template($action,$c_module);
