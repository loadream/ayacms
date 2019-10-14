<?php
defined('IN_AYA') or exit('Access Denied');

$q=(string)$_GET['q'];
$o=(string)$_GET['o'];
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

if(strlen($q)){
	$wheres[]='title like \'%'.addslashes($q).'%\'';
}
$where=empty($wheres)?'1':implode(' && ',$wheres);

if(in_array($o,array (
		'hits',
		'level',
		'posttime' 
))){
	$order=$o.' desc';
}else
	$order='original desc,posttime desc';

$offset=($page-1)*$c_pagesize;
$sum=$db->count(PF.$c_table,$where);
$pages=pages(AYA_ADMIN_URL.'?action=index&channelid='.$channelid.'&in_module=1&page=(*)&q='.urlencode($q).'&o='.urlencode($o).'&cs='.urlencode($cs),$page,$sum,$c_pagesize);

$items=array ();
if($sum>0){
	$rs=$db->query("SELECT * FROM ".PF."{$c_table} WHERE {$where} ORDER by {$order} LIMIT {$offset},{$c_pagesize}");
	
	while($r=$db->fetch_array($rs)){
		$itemid=$r['itemid'];
		$r['new']=is_new($r['posttime']);
		$r['thumb']=$r['thumb']?AYA_URL.'aya/upload/'.$r['thumb']:'';
		$r['url']=AYA_URL.$c_path.'show.php?itemid='.$itemid;
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
		
		$items[$itemid]=htmls($r);
	}
	
	$db->free_result($rs);
}

htmls($items);
include template($action,$c_module);
