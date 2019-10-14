<?php
defined('IN_AYA') or exit('Access Denied');
require AYA_ROOT.'module/'.$c_module.'/common.inc.php';

$cs=(string)$_GET['cs'];

$wheres=array ();

if($CS&&strlen($cs)>0){
	$arr=explode(',',$cs);
	foreach($arr as $k=>$v){
		if(strlen($v)<1)
			continue;
		$wheres[]="cs like '%,".addslashes($v).",%'";
	}
}

$where=empty($wheres)?'1':implode(' && ',$wheres);

if(in_array($o,array (
		'hits',
		'level',
		'posttime' 
))){
	$order=$o.' desc';
}elseif($c_orderby){
	$order=$c_orderby;
}else
	$order='original desc,posttime desc';

$sum=$db->count(PF.$c_table,$where);
$pages=pages(url($c_path,'','page=(*)'.(empty($o)?'':('&o='.$o)).(empty($cs)?'':('&cs='.$cs))),$page,$sum,$c_pagesize);

$items=array ();
if($sum>0){
	
	$rs=$db->query("SELECT * FROM ".PF."{$c_table} WHERE {$where} order by {$order} LIMIT {$offset},{$c_pagesize}");
	
	while($r=$db->fetch_array($rs)){
		$itemid=$r['itemid'];
		$r['new']=is_new($r['posttime']);
		$r['thumb']=$r['thumb']?AYA_URL.'aya/upload/'.$r['thumb']:'';
		$r['url']=url($c_path,'show.php',$r['sign']?('sign='.$r['sign']):('itemid='.$itemid));
		
		$r['posttime']=date('Y-m-d H:i',$r['posttime']);
		
		$_=$r['tag']?explode(',',$r['tag']):array ();
		foreach($_ as $k=>$v){
			$_[$k]=array (
					'name'=>$v,
					'url'=>AYA_URL.'tag/?tag='.urlencode($v) 
			);
		}
		$r['tag']=$_;
		$r['stat']=array (
				'',
				$r['level']>0?'':'icon-star-empty',
				$r['level']>1?'':'icon-star-empty',
				$r['level']>2?'':'icon-star-empty',
				$r['level']>3?'':'icon-star-empty',
				$r['level']>4?'':'icon-star-empty' 
		);
		
		$items[$itemid]=$r;
	}
	
	$db->free_result($rs);
}

htmls($items);
include template($action,$c_module,$c_dirname);