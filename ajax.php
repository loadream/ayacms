<?php
$filename=basename(__FILE__);
require './aya/ajax.inc.php';
$fun=(string)$_GET['fun'];

switch($fun){
	case 'get_note':
		$content=(string)$_GET['content'];
		$note=strip_tags($content);
		
		$str='';
		if(preg_match_all('/(.+?)(。|，|\,|\.|$)/is',$note,$da)){
		foreach($da[0] as $k=>$v){
			if(mb_strlen($str.$v,'utf-8')>150) break;
			$str.=$v;
		}
		
		$cha=mb_substr($str,mb_strlen($str,'utf-8')-1,1,'utf-8');
		
		if(in_array($cha, array('。','.','，',','))){
			$str=mb_substr($str,0,-1,'utf-8');
				}
		$str.='...';
		}else{
			$str=mb_substr($note, 0, 120, 'utf-8');
		}
		
		if(strlen($str)>0){
			$js='$("#note").val("'.html($str).'");';
			amsg(l('已提取摘要'),'s',$js);
		}else
			amsg(l('未获得摘要'),'i');
	case 'get_segment':
		$title=(string)$_GET['title'];
		$content=(string)$_GET['content'];
		$encode='utf-8';
		$data=include AYA_ROOT.'api/segment/index.php';
		
		if(is_array($data) && !empty($data)){
			$str=implode(',',$data);
			
			$js='$("#keyword").val("'.html($str).'");';
			amsg(l('已提取关键字'),'s',$js);
		}else
			amsg(l('未获得关键字'),'i');
	
	case 'diy_upcache':
		upcache();
		amsg(l('缓存已更新'),'s','location=get_location_href();');
	
	case 'send_email':
		$type=(string)$_GET['type'];
		$sign=(string)$_GET['sign'];
		
		if($type=='chanpingdinggou'){
			extract($posts,EXTR_SKIP);
			session_start();
			
			$title=(string)$title;
			$number=(string)$number;
			$name=(string)$name;
			$info=(string)$info;
			$other=(string)$other;
			$checkcode=(string)$checkcode;
			
			if(strlen($checkcode)<1)
				amsg(l('请输入验证码'),'w','$("#dgcheckcode").focus();');
			
			if(strtolower($checkcode)!=$_SESSION['checkcode']){
				$_SESSION['checkcode']=random();
				amsg(l('验证码不符'),'w','dg_checkcode();');
			}
			
			strlens($title,2,100) or amsg(l('标题字数为%s~%s个字',2,100),'w','$("#'.$sign.'title").focus();');
			strlens($name,2,15) or amsg(l('称谓字数为%s~%s个字',2,15),'w','$("#'.$sign.'name").focus();');
			strlens($info,2,100) or amsg(l('联系方式字数为%s~%s个字',2,100),'w','$("#'.$sign.'info").focus();');
			
			$body=$title.','.l('数量').':'.$number.';'.l('用户称谓').':'.$name.';'.l('联系方式').':'.$info.';'.l('其它').':'.$other;
			
			$msg=send_mail($CFG['email'],$title,$body,$name);
			if($msg!==true)
				amsg($msg,'w');
			else{
				$_SESSION['checkcode']=random();
				amsg(l('感谢您的订购'),'s','$("#email_Modal").modal("hide");');
			}
		}elseif($type=='emailsend'){
			extract($posts,EXTR_SKIP);
			session_start();
				
			$title=(string)$title;
			$name=(string)$name;
			$email=(string)$email;
			$content=(string)$content;
			$checkcode=(string)$checkcode;
				
			if(strlen($checkcode)<1)
				amsg(l('请输入验证码'),'w','$("#'.$sign.'content").focus();');
					
				if(strtolower($checkcode)!=$_SESSION['checkcode']){
					$_SESSION['checkcode']=random();
					amsg(l('验证码不符'),'w',$sign.'checkcode();');
				}
				
				strlens($title,2,100) or amsg(l('标题字数为%s~%s个字',2,100),'w','$("#'.$sign.'title").focus();');
				strlens($name,2,15) or amsg(l('称谓字数为%s~%s个字',2,15),'w','$("#'.$sign.'name").focus();');
				preg_match("/^[-a-zA-Z0-9_\.]+\@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,3}$/",$email) or
					amsg(l('EMAIL格式不正确'),'w','$("#'.$sign.'email").focus();');
					
				$body=l('用户名称').':'.$name.';'.l('Email').':'.$email.';'.l('内容').':'.$content;
					
				$msg=send_mail($CFG['email'],$title,$body,$name);
				if($msg!==true)
					amsg($msg,'w');
					else{
						$_SESSION['checkcode']=random();
						amsg(l('感谢您的留言'),'s');
					}
		}
		
		break;
	case 'diyitem_edit':
		$diyitem_id=(string)$posts['diyitem_id'];
		$diy_name=(string)$posts['diy_name'];
		
		$p=$posts;
		$toarr=array ();
		unset($p['diyitem_id'],$p['diy_name']);
		foreach($p as $k=>$v){
			if(strlen($v)<1)
				continue;
			$toarr[]=array (
					'key'=>$k,
					'val'=>$v 
			);
		}
		$pararr=array (
				'name'=>$diy_name,
				'pars'=>$toarr 
		);
		
		$html='<div class="board-item diyitem" diyitem-id=":" diy-par="'.html(json_encode($pararr)).'"></div>';
		$js='$("#'.$diyitem_id.'").after(\''.$html.'\').remove();diy_save();';
		amsg('','',$js);
	
	case 'diyitem_add':
		$diy_id=(string)$posts['diy_id'];
		$diy_name=(string)$posts['diy_name'];
		
		$p=$posts;
		$toarr=array ();
		unset($p['diy_id'],$p['diy_name']);
		foreach($p as $k=>$v){
			if(strlen($v)<1)
				continue;
			$toarr[]=array (
					'key'=>$k,
					'val'=>$v 
			);
		}
		$pararr=array (
				'name'=>$diy_name,
				'pars'=>$toarr 
		);
		
		$html='<div class="board-item diyitem" diyitem-id=":" diy-par="'.html(json_encode($pararr)).'"></div>';
		$js='$("#'.$diy_id.'").prepend(\''.$html.'\');diy_save();';
		amsg('','',$js);
	
	case 'layeritem_edit':
		$layeritem_id=(string)$posts['layeritem_id'];
		$addlayer=!empty($posts['addlayer'])?1:0;
		$b=(string)$posts['b'];
		$arr=explode(':',$b);
		$bs=array_map('intval',$arr);
		foreach($bs as $v){
			if($v<1)
				amsg('参数错误','e');
		}
		array_sum($bs)==12 or amsg('参数错误','e');
		
		$html='<div class="board-item layeritem" layeritem-id="'.$addlayer.':'.implode(':',$bs).'"></div>';
		$js='$("#'.$layeritem_id.'").after(\''.$html.'\').remove();layer_save();';
		amsg('','',$js);
	case 'layeritem_add':
		$layer_id=(string)$posts['layer_id'];
		$addlayer=!empty($posts['addlayer'])?1:0;
		$b=(string)$posts['b'];
		$arr=explode(':',$b);
		$bs=array_map('intval',$arr);
		foreach($bs as $v){
			if($v<1)
				amsg('参数错误','e');
		}
		array_sum($bs)==12 or amsg('参数错误','e');
		
		$html='<div class="board-item layeritem" layeritem-id="'.$addlayer.':'.implode(':',$bs).'"></div>';
		$js='$("#'.$layer_id.'").prepend(\''.$html.'\');layer_save();';
		amsg('','',$js);
	case 'diy_save':
		$diy=(string)$_GET['diy'];
		$tpl_file=(string)$_GET['tpl_file'];
		
		$arr=json_decode($diy);
		$files=json_decode($tpl_file);
		
		$diys=array ();
		foreach($arr as $k=>$v){
			$diys[$v[1]][]=array (
					'diyitem-id'=>$v[0],
					'diy-par'=>json_decode($v[2]) 
			);
		}
		
		$items=array ();
		foreach($files as $file){
			$code=file_get($file);
			$out=array ();
			preg_match_all("/\<diyitem\>(.*?)\<\/diyitem\>/is",$code,$out,PREG_PATTERN_ORDER);
			if(isset($out[1])){
				foreach($out[1] as $v){
					$items[md5($v)]=$v;
				}
			}
		}
		set_val('diys',$diys);
		set_val('items',$items);
		
		foreach($files as $file){
			set_val('file',$file);
			$code=file_get($file);
			$code=preg_replace_callback("/\<diy\>(.*?)\<\/diy\>/is","template_set_diy",$code);
			file_put($file,$code);
		}
		
		template_update();
		
		amsg(l('已保存'),'s','location=get_location_href();');
	
	case 'layer_save_2':
		
		$layer=(string)$_GET['layer'];
		$tpl_file=(string)$_GET['tpl_file'];
		$arr=json_decode($layer);
		$files=json_decode($tpl_file);
		
		$layers=array ();
		foreach($arr as $k=>$v){
			$layers[$v[1]][]=array (
					'layeritem-id'=>$v[0] 
			);
		}
		
		$items=array ();
		foreach($files as $file){
			$code=file_get($file);
			$code=template_formatcode_diy_2($code);
			
			$out=array ();
			preg_match_all("/\<layeritem\>(.*?)\<\/layeritem\>/is",$code,$out,PREG_PATTERN_ORDER);
			if(isset($out[1])){
				foreach($out[1] as $v){
					$v=str_replace(array (
							'LAYER_BEGIN',
							'LAYER_END',
							'LAYERITEM_BEGIN',
							'LAYERITEM_END' 
					),array (
							'<layer>',
							'</layer>',
							'<layeritem>',
							'</layeritem>' 
					),$v);
					$items[md5($v)]=$v;
				}
			}
		}
		
		set_val('layers',$layers);
		set_val('items',$items);
		foreach($files as $file){
		set_val('file',$file);
		
			$code=file_get($file);
			$code=template_formatcode_diy_2($code);
			$code=preg_replace_callback("/\<layer\>(.*?)\<\/layer\>/is","template_set_layer",$code);
			
			$code=str_replace(array (
					'LAYER_BEGIN',
					'LAYER_END',
					'LAYERITEM_BEGIN',
					'LAYERITEM_END' 
			),array (
					'<layer>',
					'</layer>',
					'<layeritem>',
					'</layeritem>' 
			),$code);
			
			file_put($file,$code);
		}
		
		template_update();
		amsg(l('已保存'),'s','location=get_location_href();');
	
	case 'layer_save_1':
		
		$layer=(string)$_GET['layer'];
		$tpl_file=(string)$_GET['tpl_file'];
		
		$arr=json_decode($layer);
		$files=json_decode($tpl_file);
		
		$layers=array ();
		foreach($arr as $k=>$v){
			$layers[$v[1]][]=array (
					'layeritem-id'=>$v[0] 
			);
		}
		
		$items=array ();
		foreach($files as $file){
			$code=file_get($file);
			$code=template_formatcode_diy_1($code);
			
			$out=array ();
			preg_match_all("/\<layeritem\>(.*?)\<\/layeritem\>/is",$code,$out,PREG_PATTERN_ORDER);
			if(isset($out[1])){
				foreach($out[1] as $v){
					$v=str_replace(array (
							'LAYER_BEGIN',
							'LAYER_END',
							'LAYERITEM_BEGIN',
							'LAYERITEM_END' 
					),array (
							'<layer>',
							'</layer>',
							'<layeritem>',
							'</layeritem>' 
					),$v);
					$items[md5($v)]=$v;
				}
			}
		}
		
		set_val('layers',$layers);
		set_val('items',$items);
		foreach($files as $file){
		set_val('file',$file);
			$code=file_get($file);
			$code=template_formatcode_diy_1($code);
			$code=preg_replace_callback("/\<layer\>(.*?)\<\/layer\>/is","template_set_layer",$code);
			file_put($file,$code);
		}
		template_update();
		amsg(l('已保存'),'s','location=get_location_href();');
	
	case 'diy':
		$in_diy=(int)$_GET['in_diy'];
		if($in_diy==1 or $in_diy==2 or $in_diy==3){
			set_cookie('diy',$in_diy);
			amsg(l('模式已切换'),'i','location=get_location_href();');
		}else{
			set_cookie('diy',null);
			amsg(l('DIY已关闭'),'i','location=get_location_href();');
		}
	
	case 'client':
		$client=(string)$_GET['client'];
		in_array($client,array (
				'pc',
				'tc',
				'wx' 
		)) or $client='pc';
		set_cookie('template',$client);
		amsg(l('已切换'),'i',AYA_URL);
	
	case 'save_theme':
		$arr=array (
				'theme_css'=>(string)$_GET['theme_css'],
				'body'=>(string)$_GET['body'],
				'container'=>(string)$_GET['container'] 
		);
		
		put_config($arr,AYA_TROOT.'theme/');
		amsg(l('已保存'),'s');
		
		break;
	case 'upload_thumb':
		$width=(string)$_GET['width'];
		
		if(!$USER['itemid'])
			die(l('请先登录'));
		$file=upload();
		if(strpos($file,'.')==false)
			die($file);
		
		$fileParts=pathinfo($file);
		$fileTypes=array (
				'jpg',
				'jpeg',
				'gif',
				'png' 
		);
		
		if(!in_array(strtolower($fileParts['extension']),$fileTypes)){
			file_del(AYA_ROOT.'upload/~tmp/'.$file);
			die(l('不支持该文件类型'));
		}
		
		if(!img2thumb($file,$width)){
			file_del(AYA_ROOT.'upload/~tmp/'.$file);
			die(l('无法生成缩略图'));
		}
		die($file);
		
		break;
	
	case 'upload_file':
		if(!$USER['itemid'])
			die(l('请先登录'));
		
		$file=upload();
		if(strpos($file,'.')==false)
			die($file);
		
		die($file);
		
		break;
	
	case 'poll':
		$itemid=(int)$_GET['itemid'];
		if(!$item=$db->get_one("SELECT * FROM {$db->pre}poll WHERE itemid={$itemid}"))
			amsg(l('投票项不存在'),'i');
		$items=explode('|',$item['items']);
		$polls=explode('|',$item['polls']);
		$polls=array_map('intval',$polls);
		
		if(IN_POST){
			
			$jy=substr((TIME-TIME%300).$_SERVER['HTTP_USER_AGENT'],0,50);
			if($jy==$item['jy'])
				amsg(l('您已经投过票了'),'i','var aModalTrigger = new ModalTrigger({remote: \''.AYA_URL.'ajax.php?fun=poll&lang='.AYA_LANG.'&itemid='.$itemid.'\',title:\''.html($item['title']).'\'});aModalTrigger.show();');
			
			if($item['ty']==1){
				
				isset($posts['id']) or amsg(l('请先选择'),'w');
				$id=(int)$posts['id'];
				if(!isset($items[$id]) or strlen($items[$id])<1)
					amsg(l('参数错误'),'w');
				$polls[$id]++;
			}else{
				$ids=$posts['ids'];
				if(!is_array($ids))
					amsg(l('至少选择一项'),'w');
				if(count($ids)>$item['ty'])
					amsg(l('最多选择%s项',$item['ty']),'w');
				
				foreach($ids as $id){
					if(isset($polls[$id]))
						$polls[$id]++;
				}
			}
			$val=implode('|',$polls);
			$arr=array (
					'polls'=>$val,
					'jy'=>$jy 
			);
			$sql=sql_update($arr);
			$db->query("UPDATE {$db->pre}poll SET {$sql} WHERE itemid={$itemid}");
			
			amsg(l('感谢您的投票'),'s','var aModalTrigger = new ModalTrigger({remote: \''.AYA_URL.'ajax.php?fun=poll&lang='.AYA_LANG.'&itemid='.$itemid.'\',title:\''.html($item['title']).'\'});aModalTrigger.show();');
		}
		$class=array (
				'',
				'progress-bar-info',
				'progress-bar-success',
				'progress-bar-warning',
				'progress-bar-danger',
				'',
				'progress-bar-info',
				'progress-bar-success',
				'progress-bar-warning',
				'progress-bar-danger' 
		);
		$num=0;
		foreach($items as $k=>$v){
			if(strlen($v)<1)
				continue;
			$num+=$polls[$k];
		}
		echo '<strong>'.l('共%s票',$num).'</strong>';
		foreach($items as $k=>$v){
			if(strlen($v)<1)
				continue;
			$w=($polls[$k]/$num)*100;
			echo '<div>'.html($v).' ('.$polls[$k].','.sprintf("%.2f",$w).'%)</div>
      <div class="progress" style="margin-bottom:9px">
                <div class="progress-bar '.$class[$k].'" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '.$w.'%">
                </div>
              </div>
';
		}
		break;
	case 'comment':
		if(IN_POST){
			session_start();
			$checkcode=(string)$posts[checkcode];
			if(strlen($checkcode)<1)
				amsg(l('请输入验证码'),'w','$("#comment_checkcode").focus();');
			if(strtolower($checkcode)!=$_SESSION['checkcode']){
				$_SESSION['checkcode']=random();
				amsg(l('验证码不符'),'w','comment_checkcode();');
			}
			
			$channelid=(int)$_GET['channelid'];
			$itemid=(int)$_GET['itemid'];
			$content=trim((string)$posts['content']);
			
			if(!isset($CHANNELS[$channelid]))
				amsg(l('参数错误'));
			
			extract($CHANNELS[$channelid],EXTR_PREFIX_ALL,'c');
			$PV=strlen($c_pv)>0?unserialize($c_pv):array ();
			
			empty($PV['comment'])&&$PV['comment']=array ();
			
			if(empty($PV['comment']))
				$USER['itemid']<1&&amsg(l('请先登录'));
			
			elseif(!in_array($USER['groupid'],$PV['comment']))
				amsg(l('权限不足'));
			
			if($c_comment==2){
				if(!$item=$db->get_one("SELECT * FROM ".PF."{$c_table} WHERE itemid='".$itemid."'"))
					amsg(l('参数错误'));
			}else
				$itemid=0;
			
			if(strlen($content)<1)
				amsg(l('请填写内容'),'w','$("#comment_content").focus();');
			if(strlen($content)>100)
				amsg(l('内容太多了'),'w','$("#comment_content").focus();');
			
			$p=array (
					'author'=>$USER['name'],
					'content'=>$content,
					'posttime'=>TIME,
					'channelid'=>$channelid,
					'itemid_by'=>$itemid 
			);
			$sql=sql_insert($p);
			
			if(!$db->query("insert into ".PF.'comment '.$sql))
				amsg('error!');
			$url=url($c_path,'comment.php',$c_comment==2?('itemid='.$itemid):'');
			amsg(l('感谢您的评论'),'s',$url);
		}
		
		break;
		case 'ueditor_controller':
		if($USER['groupid']!=2)
			die(l('权限不足'));
		require AYA_ROOT.'include/ueditor/php/controller.php';
		break;
		
	default:
}

