<?php
defined('IN_AYA') or exit('Access Denied');

$file=(string)$_GET['file'];
false===check_path($file)&&amsg(l('参数错误'),'w');

if(!is_file(ROOT.$file))
	amsg(l('文件不存在'),'w');

$info=get_fileinfo($file);


if(!$info['r'])
	amsg(l('权限不足'),'w');
	
	// 'php','txt','html','htm','js','gif','png','jpg','jpeg'


switch(strtolower($info['extension'])){
	case 'php':
	case 'txt':
	case 'html':
	case 'htm':
	case 'css':
	case 'js':
		
		if(IN_POST){
			if(!$info['w'])
				amsg(l('权限不足'),'w');
			
			if(file_put(ROOT.$file, (string)$posts['content']))
				amsg(l('已保存'),'s');
			else 
				amsg(l('失败'),'w');
			
		}
		
		$content=file_get(ROOT.$file);
		
		break;
	
	case 'gif':
	case 'png':
	case 'jpg':
	case 'jpeg':
		
		$html='<img src="'.$file.'" />';
		
		break;
	
	default:
}

$nav_dir=dirname($file);
$nav_filename=$info['basename'];

include template($action,'admin');
