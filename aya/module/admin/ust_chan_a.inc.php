<?php
defined('IN_AYA') or exit('Access Denied');

$lang=(string)$_GET['lang'];
if($lang)
	in_array($lang,$LANG) or amsg('404,'.l('禁止访问'));
else
	$lang=AYA_LANG;

if(IN_POST){
	extract($posts);
	
	empty($name)&&amsg(l('请正确填写栏目名称'),'w','$("#name").focus();');
	empty($dirname)&&amsg(l('请正确填写URL标识'),'w','$("#dirname").focus();');
	
	check_name($dirname) or amsg(l('请正确填写URL标识'),'w','$("#dirname").focus();');
	
	is_dir(ROOT.$dirname)&&amsg(l('URL标识已存在'),'w');
	
	check_name($module) or amsg('404,'.l('非法参数'));
	is_file($file=AYA_ROOT.'module/'.$module.'/admin/channel_add.inc.php') or amsg(l('模型组件缺失'),'w');
	
	// 获取可用id;
	for($channelid=1;isset($CHANNELS[$channelid]);$channelid++)
		;
		// 建目录$dirname
	$channel_path=ROOT.$dirname.'/';
	dir_create($channel_path) or amsg(l('无法创建目录'),'d');
	is_write($channel_path) or amsg(l('目录不可写'),'d');
	
	$p=array (
			'channelid'=>$channelid,
			'name'=>$name,
			'module'=>$module,
			'path'=>$dirname.'/',
			'language'=>$lang,
			'isblank'=>$isblank?1:0,
			'hide_pc'=>$hide_pc?1:0,
			'hide_tc'=>$hide_tc?1:0,
			'hide_wx'=>$hide_wx?1:0,
			'dirname'=>$dirname,
			'parentid'=>$parentid,
			'keywords'=>$keywords,
			'description'=>$description,
			'comment'=>0,
			'config'=>'' 
	);
	
	// 目录生成文件
	$error='';
	$d=file_flist(AYA_ROOT.'module/'.$module.'/');
	
	foreach($d as $k=>$f){
		
		$_f=basename($f);
		if($_f=='config.inc.php')
			continue;
		
		if(substr($_f,-8)=='.inc.php'){
			
			$con="<?php
chdir(dirname(__FILE__));
\$action=basename(__FILE__,'.php');
require 'config.inc.php';
require '../aya/common.inc.php';
require AYA_ROOT.'module/'.\$c_module.'/'.\$action.'.inc.php';";
			
			$_n=preg_replace('/\.inc\.php$/','.php',$_f);
			if(!file_put($channel_path.$_n,$con)){
				$error=l('目录无法写入文件');
				break;
			}
		}
	}
	
	if(!$error){
		$con="<?php
	\$channelid=$channelid;
	";
		if(!file_put($channel_path.'config.inc.php',$con)){
			$error=l('目录无法写入文件');
		}
	}
	
	if($error){
		dir_delete($channel_path);
		amsg($error,'w');
	}
	
	$return=include $file;
	
	if($return!==true){
		dir_delete($channel_path);
		amsg($return,'w');
	}else{
		$sql=sql_insert($p);
		
		if(!$db->query("insert into ".PF."channel $sql")){
			dir_delete($channel_path);
			amsg(l('无法写入数据库'),'w');
		}
	}
	
	amsg(l('新建成功'),'s',AYA_ADMIN_URL.'?action=ust_chan&lang='.$lang);
}

$mods=thesenames(AYA_ROOT.'module/',1,1);

include template($action,'admin');
