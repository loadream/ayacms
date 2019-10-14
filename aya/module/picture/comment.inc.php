<?php
defined('IN_AYA') or exit('Access Denied');
require AYA_ROOT.'module/'.$c_module.'/common.inc.php';

if(!$item=$db->get_one("SELECT * FROM ".PF."{$c_table} WHERE itemid='{$itemid}'"))
	amsg('404');

if(empty($c_comment)) amsg(l('评论已关闭'),'i');

	$wheres=array ();
	$wheres[]="comment.channelid='".$channelid."'";
	$c_comment==2 && $wheres[]="comment.itemid_by='".$itemid."'";
	$where=empty($wheres)?'1':implode(' && ',$wheres);

	$wheres2=array ();
	$wheres2[]="channelid='".$channelid."'";
	$c_comment==2 && $wheres2[]="itemid_by='".$itemid."'";
	$where2=empty($wheres2)?'1':implode(' && ',$wheres2);

	$order='comment.posttime desc';

	$sum=$db->count(PF.'comment',$where2);
	$pages=pages(url($c_path,'comment.php','page=(*)'),$page,$sum,20);

	$items=array ();
	if($sum>0){
		$rs=$db->query("SELECT *,comment.itemid as itemid FROM ".PF."comment as comment left join ".PF."member as member on comment.author=member.name  WHERE $where order by $order LIMIT {$offset},20");
		$i=0;
		while($r=$db->fetch_array($rs)){
			$r['posttime']=date('Y-m-d H:i',$r['posttime']);
			$r['lou']=$sum-20*($page-1)-$i++;
			$items[$r['itemid']]=$r;

		}

		$db->free_result($rs);
	}

	extract($item,EXTR_SKIP);
	apply('seo_title',$title);
	apply('seo_keywords',$keywords);
	apply('seo_description',$note);
	
	apply('pathnav',array (
	$title,
	url($c_path,'show.php',$sign?('sign='.$sign):('itemid='.$itemid))
	));
	
	apply('pathnav',array (
	l('评论')
	));
	
	include template($action,$c_module,$c_dirname);