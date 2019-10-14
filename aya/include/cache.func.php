<?php
defined('IN_AYA') or exit('Access Denied');
function cache_all(){
	cache_channel();
	cache_alllang();
	cache_field();
	cache_class();
}

function cache_alllang(){
	$langs=thesenames(AYA_ROOT.'lang/',0);
	
	$_=array ();
	foreach($langs as $k=>$v){
		$_k=substr($k,0,strpos($k,'.'));
		$_[$_k]=$v;
	}
	cache_write('alllang.php',$_);
}
function cache_channel($channelid=0){
	global $db;
	if($channelid){
		$r=$db->get_one("SELECT * FROM {$db->pre}channel where  channelid='$channelid'");
		cache_write('channel-'.$channelid.'.php',$r);
		
		return true;
	}else{
		$result=$db->query("SELECT * FROM {$db->pre}channel ORDER by listorder desc,channelid asc");
		$rs=array ();
		while($r=$db->fetch_array($result)){
			
			cache_write('channel-'.$r['channelid'].'.php',$r);
			
			$rs[$r['channelid']]=$r;
		}
		cache_write('channel.php',$rs);
		cache_channel_level($rs);
	}
}
function cache_channel_level($channels){
	$arr=array ();
	foreach($channels as $channelid=>$v){
		$arr[$v['language']][$channelid]=$v;
	}

	if(empty($arr))
		return array ();

	foreach($arr as $lang=>$cs){
		$_p=array ();

		foreach($cs as $k=>$v){
			$_p[$v['parentid']][]=$k;
		}
		$arr[$lang]=$_p;
	}

	cache_write('channel_level.php',$arr);
}

function cache_field($tb=''){
	global $db;
	
	if($tb){
		$data=array ();
		$result=$db->query("SELECT * FROM {$db->pre}field WHERE tb='$tb' ORDER BY listorder desc,itemid");
		while($r=$db->fetch_array($result)){
			$data[$r['name']]=$r;
		}
		cache_write('field-'.$tb.'.php',$data);
	}else{
		
		$farr=glob(AYA_ROOT.'cache/field*.php');
		$farr===false&&$farr=array ();
		foreach($farr as $file){
			file_del($file);
		}
		
		$tbs=array ();
		$result=$db->query("SELECT * FROM {$db->pre}field");
		while($r=$db->fetch_array($result)){
			if(isset($tbs[$r['tb']]))
				continue;
			cache_field($r['tb']);
			$tbs[$r['tb']]=$r['tb'];
		}
	}
}
function cache_class(){
	global $db;
	
	$data=array ();
	$result=$db->query("SELECT * FROM {$db->pre}class ORDER BY listorder desc,itemid");
	while($r=$db->fetch_array($result)){
		$data[$r['channelid']][$r['parentid']][$r['itemid']]=$r['name'];
	}
	foreach($data as $k=>$v)
		cache_write('class-'.$k.'.php',$v);
}

?>
