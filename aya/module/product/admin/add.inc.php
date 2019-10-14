<?php
defined('IN_AYA') or exit('Access Denied');

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
			'tag'=>strtolower((string)$tag),
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
	
	$o=new product();
	$o->table=$c_table;
	$o->channelid=$channelid;
	$o->check($p);
	$o->fields_check($p);
	
	if($insert_id=$o->add($p))
		amsg(l('成功'),'s',AYA_ADMIN_URL.'?action=add&channelid='.$channelid.'&in_module=1');
	else
		amsg(l('失败'),'w');
}
include template($action,$c_module);
