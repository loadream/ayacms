<?php
defined('IN_AYA') or exit('Access Denied');

function https_request($url,$data = null){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	if (!empty($data)){
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	}
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($curl);
	curl_close($curl);
	return $output;
}
function get_remote_file($url,$outtime=2){
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT,$outtime);
	$content = curl_exec($ch);
	
	if($content===false) return false;
	$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	return $statusCode == 200?$content:false;	
}
function get_pathinfo($path){
	$arr=array ();
	$d=dir(ROOT.$path);
	while(false!==($entry=$d->read())){
		if($entry=='.'||$entry=='..')
			continue;
		$arr[]=get_fileinfo($path.($path?'/':'').$entry);
	}
	$d->close();
	
	$a=array ();
	foreach($arr as $k=>$v){
		if($v['filetype']=='dir'){
			$a[]=$v;
			unset($arr[$k]);
		}
	}
	sort($a);
	sort($arr);
	return array_merge($a,$arr);
}
function get_fileinfo($file){
	global $OPENTYPE;
	
	$path=ROOT.$file;
	
	$ext=pathinfo($path,PATHINFO_EXTENSION);
	$filetype=filetype($path);
	
	if($filetype=='dir'){
		$url='?action=fst&file='.$file;
	}else if(in_array(strtolower($ext),$OPENTYPE)){
		$url='?action=fst_open&file='.$file;
	}else
		$url='';
	
	return array (
			'file'=>$file,
			'basename'=>basename($path),
			'filetype'=>$filetype,
			'filesize'=>filesize($path),
			'mtime'=>date("Y-m-d H:i",filemtime($path)),
			'r'=>(is_readable($path)?"r":""),
			'w'=>(is_writable($path)?"w":""),
			'extension'=>$ext,
			'url'=>$url 
	);
}
function check_path($file){
	$arr=array ();
	$path=trim($file,'/\\');
	
	while($path&&$path!='.'){
		$info=pathinfo($path);
		$path=$info['dirname'];
		$name=$info['basename'];
		if(strlen($name)>0)
			$arr[]=$name;
	}
	krsort($arr);
	$str=implode('/',$arr);
	return $str===$file;
}
function put_thesename($arr,$dir,$add=false){
	$file=$dir.'these.name.php';
	
	if($add){
		if(is_file($file))
			$_=include $file;
		else
			$_=array ();
		$arr=array_merge($_+$arr);
	}
	
	ob_start();
	var_export($arr);
	$string=ob_get_contents();
	ob_end_clean();
	
	$string='<?php defined(\'IN_AYA\') or exit(\'Access Denied\');
			return '.$string.';
					';
	
	return file_put($file,$string);
}

function tag_add($channelid,$p,$itemid){
	global $db;
	$arr=explode(',',$p['tag']);
	$arr=array_map('trim',$arr);
	$arr=array_unique($arr);
	
	foreach($arr as $v){
		if(strlen($v)<1)
			continue;
		$a=array (
				'tag'=>$v,
				'channelid'=>$channelid,
				'itemid'=>$itemid,
				'sign'=>$p['sign'],
				'title'=>$p['title'],
				'posttime'=>TIME 
		);
		$sql=sql_insert($a);
		$db->query("insert into ".PF."tag ".$sql);
	}
	return true;
}
function tag_edit($channelid,$p,$itemid){
	global $db;
	$arr=explode(',',$p['tag']);
	$arr=array_map('trim',$arr);
	$arr=array_unique($arr);
	// 删除
	$wheres=array ();
	$wheres[]="channelid='".addslashes($channelid)."'";
	$wheres[]="itemid='".addslashes($itemid)."'";
	$where=empty($wheres)?'1':implode(' && ',$wheres);
	$rs=$db->query("SELECT * FROM ".PF."tag WHERE ".$where);
	
	$sval=array ();
	while($r=$db->fetch_array($rs)){
		
		if(!in_array($r['tag'],$arr)){
			$db->query("delete from ".PF."tag where id='".$r['id']."'");
		}else{
			$id=array_search($r['tag'],$arr);
			unset($arr[$id]);
		}
	}
	// 新建
	foreach($arr as $v){
		if(strlen($v)<1)
			continue;
		$a=array (
				'tag'=>$v,
				'channelid'=>$channelid,
				'itemid'=>$itemid,
				'sign'=>$p['sign'],
				'title'=>$p['title'],
				'posttime'=>TIME 
		);
		$sql=sql_insert($a);
		$db->query("insert into ".PF."tag ".$sql);
	}
	return true;
}
function tag_del($channelid,$itemid=false){
	global $db;
	if($itemid===false){
		$db->query("delete from ".PF."tag where channelid='".$channelid."'");
	}else{
		$db->query("delete from ".PF."tag where channelid='".$channelid."' && itemid='".$itemid."'");
	}
	return true;
}
function search_add($channelid,$p,$itemid){
	global $db;
	
	$a=array (
			'channelid'=>$channelid,
			'itemid'=>$itemid,
			'sign'=>$p['sign'],
			'title'=>$p['title'],
			'posttime'=>TIME 
	);
	$sql=sql_insert($a);
	$db->query("insert into ".PF."search ".$sql);
	
	return true;
}
function search_edit($channelid,$p,$itemid){
	global $db;
	$a=array (
			'sign'=>$p['sign'],
			'title'=>$p['title'] 
	);
	$sql=sql_update($a);
	$db->query("update ".PF."search set ".$sql." where channelid='".$channelid."' && itemid='".$itemid."'");
	return true;
}
function search_del($channelid,$itemid=false){
	global $db;
	if($itemid===false){
		$db->query("delete from ".PF."search where channelid='".$channelid."'");
	}else{
		$db->query("delete from ".PF."search where channelid='".$channelid."' && itemid='".$itemid."'");
	}
	return true;
}
function add_iframe(){
	$arr=array (
			'12',
			'6:6',
			'8:4',
			'4:8',
			'3:9',
			'9:3',
			'2:10',
			'10:2',
			'1:11',
			'11:1',
			'2:6:4',
			'2:4:4',
			'2:8:2',
			'4:4:4',
			'3:6:3',
			'3:3:6',
			'6:3:3',
			'2:8:2',
			'2:2:8',
			'8:2:2',
			'3:3:3:3',
			'2:2:2:2:2:2',
			'1:1:1:1:1:1:1:1:1:1:1:1' 
	);
	$html='';
	foreach($arr as $k=>$v){
		$bval='';
		$a=explode(':',$v);
		foreach($a as $_v){
			$bval.='<div class="col-md-'.$_v.'">col_md_'.$_v.'</div>\n';
		}
		
		$bval=str_replace('"','\\"','<!-- '.$v.' -->\n<div class="row">\n'.$bval.'</div>\n');
		if($k>0&&$k%6==0)
			$html.='</div><div class="row"><div class="mt-5"></div>';
		$html.='<div class="col-md-2"><button class="frame_button btn btn-sm" type="button" onclick="add_clip(\''.html($bval).'\')">'.$v.'</button></div>';
	}
	$html='<div class="row">'.$html.'</div>';
	return $html;
}
function add_diy($client){
	global $CFG;
	$arr=thesenames(AYA_ROOT.'template/'.$client.'/diy/');
	$html='';
	$i=0;
	foreach($arr as $k=>$v){
		$func=basename($k,".php");
		$a=explode('|',$v);
		
		if(empty($a[0])) $a[0]=$func;
		
		
		$bval='<!-- '.$a[0].';';

		$a1=explode('&', $a[1]);
		$a2=explode(';', $a[2]);
		
		if($a1 && $a2){
		foreach($a1 as $key=>$val){
			$_a1=explode('=', $val);
			$bval.=' '.$_a1[0].':'.$a2[$key].';';
		}
		}
		
		
		
		$bval.=' -->\n{diy \''.$func.'\',\''.($a[1]).'\'}\n';
		
		$bval=str_replace('"','\\"',$bval);
		$bval=str_replace('\'','\\\'',$bval);
		
		if($i>0&&$i%6==0)
			$html.='</div><div class="row"><div class="mt-5"></div>';
		$i++;
		$html.='<div class="col-md-2"><button class="frame_button btn btn-sm" type="button" onclick="add_clip(\''.html($bval).'\')">'.$a[0].'</button></div>';
	}
	$html='<div class="row">'.$html.'</div>';
	;
	return $html;
}
function add_field(){
	global $FD;
	if(!isset($FD) or !is_array($FD))
		return l('无可用项目');
	
	$html='';
	$i=0;
	foreach($FD as $k=>$v){
		$arr=thesenames(AYA_ROOT.'table/'.$v['html'].'/');
		$keys=array_keys($arr);
		$pars=implode(',',array_map('filename',$keys));
		
		$bval='<!-- '.html($v['title']).';第二参数为模板名,可为空,或选择'.$pars.' -->\n{field("'.$k.'","")}\n';
		$bval2='<!-- '.html($v['title']).'-编辑;第二参数为模板名,可为空,或选择'.$pars.' -->\n{field_edit("'.$k.'","")}\n';
		
		$bval=str_replace('"','\\"',$bval);
		$bval=str_replace('\'','\\\'',$bval);
		
		$bval2=str_replace('"','\\"',$bval2);
		$bval2=str_replace('\'','\\\'',$bval2);
		
		
		if($i>0&&$i%3==0){
			$html.='</div><div class="row"><div class="mt-5"></div>';
			
		}
		$i++;
		$html.='<div class="col-md-2"><button class="frame_button btn btn-sm" type="button" onclick="add_clip(\''.html($bval).'\')">'.html($v['title']).'</button></div>';
		$html.='<div class="col-md-2"><button class="frame_button btn btn-sm" type="button" onclick="add_clip(\''.html($bval2).'\')">'.html($v['title']).'-编辑</button></div>';
	}
	if(!$html)
		return l('无可用项目');
	return '<div class="row">'.$html.'</div>';
}

