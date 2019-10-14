<?php
defined('IN_AYA') or exit('Access Denied');
$cfg=include AYA_ROOT.'api/weixin/config.inc.php';
$menu=$cfg['menu'];

$marr=array ();

for($i=0;$i<3;$i++){
	
	$pmenu=$menu[$i][0];
	
	if(strlen($pmenu['name'])<1)
		continue;
	
	if($pmenu['type']=='view'){
		$marr[]=array (
				'type'=>'view',
				'name'=>urlencode($pmenu['name']),
				'url'=>$pmenu['url'] 
		);
	}else if($pmenu['type']!=''){
		$marr[]=array (
				'type'=>'click',
				'name'=>urlencode($pmenu['name']),
				'key'=>$i.'_0' 
		);
	}else {
		
		$sarr=array ();
		for($n=1;$n<6;$n++){
			$smenu=$menu[$i][$n];
			if(strlen($smenu['name'])<1)
				continue;
			
		if($smenu['type']=='view'){
				$sarr[]=array (
						'type'=>'view',
						'name'=>urlencode($smenu['name']),
						'url'=>$smenu['url'] 
				);
			}else if($smenu['type']!=''){
				$sarr[]=array (
						'type'=>'click',
						'name'=>urlencode($smenu['name']),
						'key'=>$i.'_'.$n 
				);
			}
			
		}
		
		$marr[]=array (
				'name'=>urlencode($pmenu['name']),
				'sub_button'=>$sarr 
		);
	}
}

$xjson=urldecode(json_encode(array (
		'button'=>$marr 
)));

$get_url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$cfg['appid'].'&secret='.$cfg['appsecret'];
$get_return=file_get_contents($get_url);
$get_return=(array)json_decode($get_return);
if(!isset($get_return['access_token'])){
	amsg('获取access_token失败！','d');
}

$post_url='https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$get_return['access_token'];
$result=https_request($post_url,$xjson);
$result=(array)json_decode($result);
if(!isset($result['errmsg'])){
	amsg('结果未知','i');
}else if($result['errmsg']=='ok'){
	amsg('成功提交','s');
}else{
		amsg('错误代号:'.$result['errcode']);
}

