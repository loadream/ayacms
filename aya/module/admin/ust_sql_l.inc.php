<?php
defined('IN_AYA') or exit('Access Denied');

$id=(string)$_GET['id'];

if(strlen($id)<1 or preg_match('/[\\\.\/]/is',$id)){
	amsg(l('参数错误'),'w');
}
is_dir($path=AYA_ROOT.'backup/'.$id) or amsg(l('备份不存在'),'w');

is_file($file=AYA_ROOT.'backup/'.$id.'/1.php') or amsg('备份不存在','w');

require_once (AYA_ROOT.'include/pclzip.class.php');

$tmpzip=AYA_ROOT.'upload/~tmp/backup_'.$id.'.zip';

$archive=new PclZip($tmpzip);

$archive->create($file,PCLZIP_OPT_REMOVE_PATH,dirname($path));

for($i=2;;$i++){
	if(!is_file($file=AYA_ROOT.'backup/'.$id.'/'.$i.'.php'))
		break;
	$archive->add($file,PCLZIP_OPT_REMOVE_PATH,dirname($path));
}

file_down($tmpzip);