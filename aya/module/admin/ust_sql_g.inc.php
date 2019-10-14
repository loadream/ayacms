<?php
defined('IN_AYA') or exit('Access Denied');

$baks=thesenames(AYA_ROOT.'backup/',1);

if(IN_POST){
	session_start();
	extract($posts);
	
	// 初次提交;
	$tabs=is_array($tabs)?$tabs:array ();
	$size=intval($size);
	
	empty($tabs)&&amsg(l('至少选择一个'),'w');
	$size<1&&amsg(l('分卷文件不能小于%sM','1'),'w','$("#size").focus();');
	$dir=date("Ymd_".TIME,TIME);
	
	$_SESSION['tabs']=$tabs;
	$_SESSION['dir']=$dir;
	$_SESSION['size']=$size;
	
	$url=$pca.'&sumfile=1&rid=0&c_tabid=0';
	amsg('一','i',"aya_get('".$url."');");
}

if(IN_AJAX){
	session_start();
	
	$tabs=$_SESSION['tabs'];
	$dir=$_SESSION['dir'];
	$size=(int)$_SESSION['size'];
	
	$sumfile=$_GET['sumfile'];
	$rid=$_GET['rid'];
	$c_tabid=(int)$_GET['c_tabid'];
	
	$bakdir=AYA_ROOT.'backup/'.$dir.'/';
	if(!dir_create($bakdir))
		amsg(l('无法创建存储目录!').$bakdir,'d');
	file_put($bakdir.'index.html','0');
	$filesize=$size*1024*1024;
	$bak='';
	if($c_tabid==0&&$sumfile==1){
		$bak='-- '.html($CFG['title']).' 系统数据备份 '."\n";
		$bak.='-- 生成日期:'.date('Y/m/d H:i',TIME)."\n";
		$bak.='-- ----------------------------------------'."\n";
		$bak.='-- 警告!修改本文件的任何部分,将有可能导致恢复失败!'."\n";
		$bak.='-- ----------------------------------------'."\n\n";
		$bak.="DROP TABLE IF EXISTS `".$tabs[$c_tabid]['Name']."`;\n\n";
		$result=$db->query("SHOW CREATE TABLE `".$tabs[$c_tabid]['Name'].'`');
		$row=$db->fetch_row($result);
		$bak.=$row[1].";\n\n";
	}
	
	do{
		
		$result=$db->query("select * from `".$tabs[$c_tabid]['Name'].'`');
		$listnum=$db->num_fields($result);
		$rownum=$db->num_rows($result);
		while($rid<$rownum){
			$db->data_seek($result,$rid);
			$row=$db->fetch_row($result);
			$bak.='INSERT INTO '.$tabs[$c_tabid]['Name'].' VALUES(';
			$arr=array ();
			for($i=0;$i<$listnum;$i++){
				$arr[]="'".mysql_escape_string($row[$i])."'";
			}
			$bak.=implode(',',$arr).");\n\n";
			$rid++;
			if(strlen($bak)>=$filesize){
				write_file($bakdir.$sumfile++.'.php',$bak);
				
				$url=$pca.'?sumfile='.$sumfile.'&rid='.$rid.'&c_tabid='.$c_tabid;
				amsg('一',"aya_get('".$url."');",'i');
			}
		}
		if(!isset($tabs[++$c_tabid])){
			file_put($bakdir.$sumfile.'.php',$bak);
			amsg(l('成功备份'),'s',AYA_ADMIN_URL.'?action=ust_sql_g');
		}
		$bak.="DROP TABLE IF EXISTS `".$tabs[$c_tabid]['Name']."`;\n\n";
		$result=$db->query("SHOW CREATE TABLE `".$tabs[$c_tabid]['Name']."`");
		$row=$db->fetch_row($result);
		$bak.=$row[1].";\n\n";
		$rid=0;
	}while(true);
}

include template($action,'admin');
