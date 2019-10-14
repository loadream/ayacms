<?php
defined('IN_AYA') or exit('Access Denied');

$re=$db->query('show table status');
$tabs=array ();
while($row=$db->fetch_array($re)){
	$tabs[]=$row;
}

if(IN_POST){
	session_start();
	extract($posts);
	
	// 初次提交;
	$ids=is_array($ids)?$ids:array ();
	$size=intval($size);
	
	empty($ids)&&amsg(l('至少选择一个'),'w');
	
	$size<1&&amsg(l('分卷文件不能小于%sM',1),'w','$("#size").focus();');
	$dir=date("ymd_His_",TIME).random();
	
	$_SESSION['ids']=$ids;
	$_SESSION['dir']=$dir;
	$_SESSION['size']=$size;
	
	$url=$pca.'&sumfile=1&rid=0&c_tabid=0';
	amsg('一','i',"aya_get('".$url."');");
}

if(IN_AJAX){
	session_start();
	
	$ids=$_SESSION['ids'];
	$dir=$_SESSION['dir'];
	$size=(int)$_SESSION['size'];
	
	$sumfile=$_GET['sumfile'];
	$rid=$_GET['rid'];
	$c_tabid=(int)$_GET['c_tabid'];
	
	$bakdir=AYA_ROOT.'backup/'.$dir.'/';
	if(!dir_create($bakdir))
		amsg(l('无法创建存储目录').$bakdir,'d');
	file_put($bakdir.'index.html','0');
	$filesize=$size*1024*1024;
	$bak='';
	if($c_tabid==0&&$sumfile==1){
		$bak='-- '.html($CFG['title']).' 系统数据备份 '."\n";
		$bak.='-- 生成日期:'.date('Y/m/d H:i',TIME)."\n";
		$bak.='-- ----------------------------------------'."\n";
		$bak.='-- 警告!修改本文件的任何部分,将有可能导致恢复失败!'."\n";
		$bak.='-- ----------------------------------------'."\n\n";
		$bak.="DROP TABLE IF EXISTS `".$tabs[$ids[$c_tabid]]['Name']."`;\n\n";
		$result=$db->query("SHOW CREATE TABLE `".$tabs[$ids[$c_tabid]]['Name'].'`');
		$row=$db->fetch_row($result);
		$bak.=$row[1].";\n\n";
	}
	
	do{
		
		$result=$db->query("select * from `".$tabs[$ids[$c_tabid]]['Name'].'`');
		$listnum=$db->num_fields($result);
		$rownum=$db->num_rows($result);
		while($rid<$rownum){
			$db->data_seek($result,$rid);
			$row=$db->fetch_row($result);
			$bak.='INSERT INTO '.$tabs[$ids[$c_tabid]]['Name'].' VALUES(';
			$arr=array ();
			for($i=0;$i<$listnum;$i++){
				$arr[]="'".mysql_escape_string($row[$i])."'";
			}
			$bak.=implode(',',$arr).");\n\n";
			$rid++;
			if(strlen($bak)>=$filesize){
				file_put($bakdir.$sumfile++.'.php',$bak);
				
				$url=$pca.'&sumfile='.$sumfile.'&rid='.$rid.'&c_tabid='.$c_tabid;
				amsg('一','i',"aya_get('".$url."');");
			}
		}
		if(!isset($ids[++$c_tabid])){
			
			$size=(($sumfile-1)*$filesize+strlen($bak))/(1024*1024);
			
			file_put($bakdir.$sumfile.'.php',$bak);
			put_thesename(array (
					$dir=>'完成于 '.date('Y-m-d H:i:s').', '.$sumfile.'个分卷 约'.ceil($size).'M' 
			),AYA_ROOT.'backup/',1);
			amsg(l('成功备份'),'s',AYA_ADMIN_URL.'?action=ust_sql');
		}
		$bak.="DROP TABLE IF EXISTS `".$tabs[$ids[$c_tabid]]['Name']."`;\n\n";
		$result=$db->query("SHOW CREATE TABLE `".$tabs[$ids[$c_tabid]]['Name']."`");
		$row=$db->fetch_row($result);
		$bak.=$row[1].";\n\n";
		$rid=0;
	}while(true);
}

include template($action,'admin');
