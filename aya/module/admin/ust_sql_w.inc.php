<?php
defined('IN_AYA') or exit('Access Denied');


	$id=(string)$_GET['id'];
	$cid=intval($_GET['cid']);
	$cid=$cid<1?1:$cid;
	
	
	if(strlen($id)<1 or preg_match('/[\\\.\/]/is',$id)){
		amsg(l('参数错误'),'w');
	}
	is_dir(AYA_ROOT.'backup/'.$id) or amsg(l('备份不存在'),'w');

	if(is_file($file=AYA_ROOT.'backup/'.$id.'/'.$cid.'.php')){
		$data=trim(file_get($file));
	
		$sql=explode("\r\n\r\n",$data);
		if(count($sql)<2)
			$sql=explode("\n\n",$data);
		foreach($sql as $query){
			$query=trim($query);
			if(in_array(substr($query,0,10),array('DROP TABLE','CREATE TAB','INSERT INT','SET SQL_MO'))){
				$db->query($query);
			}
		}
		
		$url=$pca.'&id='.$id.'&cid='.++$cid;
		
		amsg(l('下一个'),'i',"aya_get('".$url."');");
	
		}else if($cid==1){
			amsg(l('备份不存在'),'w');
		}else{
			amsg(l('导入成功'),'s',AYA_ADMIN_URL.'?action=ust_sql_g');
		}
	
