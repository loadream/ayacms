<?php
defined('IN_AYA') or exit('Access Denied');
function field_exists($table,$field){
	global $db;
	$rs=$db->query("describe `".PF.$table."` `".$field."`");
	$arr=$db->fetch_array($rs);
	return is_array($arr);
}
function get_field_sql($table,$name,$html='',$newname=''){
	if($html==''&&$newname=='')
		$type='del';
	elseif($newname=='')
		$type='add';
	else
		$type='edit';
	
	if($type=='del')
		return "ALTER TABLE  `".PF.$table."` DROP  `".$name."`";
	
	else if($type=='add'){
		
		switch($html){
			case 'text':
				$sql="ALTER TABLE  `".PF.$table."` ADD  `".$name."` VARCHAR( 255 ) NOT NULL";
				break;
			case 'textarea':
				$sql="ALTER TABLE  `".PF.$table."` ADD  `".$name."` TEXT NOT NULL";
				break;
			case 'int':
				$sql="ALTER TABLE  `".PF.$table."` ADD  `".$name."` INT( 10 ) NOT NULL";
				break;
			case 'float':
				$sql="ALTER TABLE  `".PF.$table."` ADD  `".$name."` DECIMAL( 10, 2 ) NOT NULL";
				break;
			case 'select':
				$sql="ALTER TABLE  `".PF.$table."` ADD  `".$name."` VARCHAR( 255 ) NOT NULL";
				break;
			case 'radio':
				$sql="ALTER TABLE  `".PF.$table."` ADD  `".$name."` VARCHAR( 255 ) NOT NULL";
				break;
			case 'checkbox':
				$sql="ALTER TABLE  `".PF.$table."` ADD  `".$name."` VARCHAR( 255 ) NOT NULL";
				break;
			case 'hidden':
				$sql="ALTER TABLE  `".PF.$table."` ADD  `".$name."` TEXT NOT NULL";
				break;
			case 'thumb':
				$sql="ALTER TABLE  `".PF.$table."` ADD  `".$name."` VARCHAR( 255 ) NOT NULL";
				break;
			case 'file':
				$sql="ALTER TABLE  `".PF.$table."` ADD  `".$name."` TEXT NOT NULL";
				break;
			case 'editor':
				$sql="ALTER TABLE  `".PF.$table."` ADD  `".$name."` LONGTEXT NOT NULL";
				break;
			case 'date':
				$sql="ALTER TABLE  `".PF.$table."` ADD  `".$name."` VARCHAR( 255 ) NOT NULL";
				break;
			default:
				$sql='';
		}
		return $sql;
	}else if($type=='edit'){
		
		switch($html){
			case 'text':
				$sql="ALTER TABLE  `".PF.$table."` CHANGE  `".$name."`  `".$newname."` VARCHAR( 255 ) NOT NULL";
				break;
			case 'textarea':
				$sql="ALTER TABLE  `".PF.$table."` CHANGE  `".$name."`  `".$newname."` TEXT NOT NULL";
				break;
			case 'int':
				$sql="ALTER TABLE  `".PF.$table."` CHANGE  `".$name."`  `".$newname."` INT( 10 ) NOT NULL";
				break;
			case 'float':
				$sql="ALTER TABLE  `".PF.$table."` CHANGE  `".$name."`  `".$newname."` DECIMAL( 10, 2 ) NOT NULL";
				break;
			case 'select':
				$sql="ALTER TABLE  `".PF.$table."` CHANGE  `".$name."`  `".$newname."` VARCHAR( 255 ) NOT NULL";
				break;
			case 'radio':
				$sql="ALTER TABLE  `".PF.$table."` CHANGE  `".$name."`  `".$newname."` VARCHAR( 255 ) NOT NULL";
				break;
			case 'checkbox':
				$sql="ALTER TABLE  `".PF.$table."` CHANGE  `".$name."`  `".$newname."` VARCHAR( 255 ) NOT NULL";
				break;
			case 'hidden':
				$sql="ALTER TABLE  `".PF.$table."` CHANGE  `".$name."`  `".$newname."` TEXT NOT NULL";
				break;
			case 'thumb':
				$sql="ALTER TABLE  `".PF.$table."` CHANGE  `".$name."`  `".$newname."` VARCHAR( 255 ) NOT NULL";
				break;
			case 'file':
				$sql="ALTER TABLE  `".PF.$table."` CHANGE  `".$name."`  `".$newname."` TEXT NOT NULL";
				break;
			case 'editor':
				$sql="ALTER TABLE  `".PF.$table."` CHANGE  `".$name."`  `".$newname."` LONGTEXT NOT NULL";
				break;
			case 'date':
				$sql="ALTER TABLE  `".PF.$table."` CHANGE  `".$name."`  `".$newname."` VARCHAR( 255 ) NOT NULL";
				break;
			default:
				$sql='';
		}
		return $sql;
	}else
		return;
}
function fields_check(&$p,$fds){
	$posts=$GLOBALS['field_posts'];
	$item=$GLOBALS['item'];
	if(empty($fds))
		return true;
	
	foreach($fds as $name=>$fd){
		
		if(!$fd['display'] or !$fd['front'])
			continue;
		
		$v=$posts[$name];
		
		switch($fd['html']){
			case 'text':
			case 'textarea':
			case 'editor':
				$fd['input_limit']&&strlen($v)<1&&amsg(l($fd['title']).l('必填'),'w','$("#'.$name.'").focus();');
				
				strlen($v)<$fd['vmin']&&amsg(l($fd['title']).l('字数不足,需 >=%s',$fd['vmin']),'w','$("#'.$name.'").focus();');
				strlen($v)>$fd['vmax']&&amsg(l($fd['title']).l('字数超限,需 <=%s',$fd['vmax']),'w','$("#'.$name.'").focus();');
				$p[$name]=$v;
				break;
			case 'int':
				$fd['input_limit']&&strlen($v)<1&&amsg(l($fd['title']).l('必填'),'w','$("#'.$name.'").focus();');
				$v=(int)$v;
				
				$v<$fd['vmin']&&amsg(l($fd['title']).l('值太小,需 >=%s',$fd['vmin']),'w','$("#'.$name.'").focus();');
				$v>$fd['vmax']&&amsg(l($fd['title']).l('值太大,需 <=%s',$fd['vmax']),'w','$("#'.$name.'").focus();');
				$p[$name]=$v;
				break;
			case 'float':
				
				$fd['input_limit']&&strlen($v)<1&&amsg($fd['title'].' 必填','w','$("#'.$name.'").focus();');
				$v=floatval(sprintf("%.2f",$v));
				
				$v<$fd['vmin']&&amsg(l($fd['title']).l('值太小,需 >=%s',$fd['vmin']),'w','$("#'.$name.'").focus();');
				$v>$fd['vmax']&&amsg(l($fd['title']).l('值太大,需 <=%s',$fd['vmax']),'w','$("#'.$name.'").focus();');
				$p[$name]=$v;
				break;
			case 'radio':
			case 'select':
				
				$arr=explodes(',',"\n",$fd['option_value']);
				
				if($fd['input_limit']){
					strlen($v)<1&&amsg(l($fd['title']).l('必选'),'$("#'.$name.'").focus();','w');
					isset($arr[$v]) or amsg(l($fd['title']).l('非法的值').': '.$v,'w','$("#'.$name.'").focus();');
				}else{
					strlen($v)>0&&!isset($arr[$v])&&amsg(l($fd['title']).l('非法的值'),'w','$("#'.$name.'").focus();');
				}
				
				$p[$name]=$v;
				break;
			
			case 'checkbox':
				$os=explodes(',',"\n",$fd['option_value']);
				$v=is_array($v)?$v:array ();
				
				if($fd['input_limit']){
					count($v)<1&&amsg(l($fd['title']).l('必选'),'w','$("#'.$name.'").focus();');
				}
				
				foreach($v as $_v)
					isset($os[$_v]) or amsg(l($fd['title']).l('非法的值').': '.$_v,'w','$("#'.$name.'").focus();');
				
				count($v)<$fd['vmin']&&amsg(l($fd['title']).l('选择过少,需 >=%s','w',$fd['vmin']),'$("#'.$name.'").focus();');
				count($v)>$fd['vmax']&&amsg(l($fd['title']).l('选择过多,需 <=%s','w',$fd['vmax']),'$("#'.$name.'").focus();');
				
				$p[$name]=implode(',',$v);
				break;
			
			case 'date':
				if(!preg_match("/^((?:19|20)\d\d)-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/",$v))
					amsg(l('日期格式错误'),'w','$("#'.$name.'").focus();');
				$p[$name]=strtotime($v);
				
				break;
			
			case 'thumb':
				$v=is_array($v)?$v:array ();
				
				is_array($v[0]) or $v[0]=array ();
				is_array($v[1]) or $v[1]=array ();
				$pics=array ();
				$n_arr=array ();
				foreach($v[0] as $key=>$val){
					$n_arr[$val]=str_replace(array (
							',',
							'|' 
					),'',$v[1][$key]);
					;
				}
				if($fd['input_limit']){
					count($v[0])<1&&amsg(l($fd['title']).l('必选'),'w','$("#'.$name.'").focus();');
				}
				
				count($v[0])>$fd['vmax']&&amsg(l($fd['title']).l('上传文件过多'),'w','$("#'.$name.'").focus();');
				
				$s_arr=explodes('|',',',$item[$name]);
				
				$m_arr=array_merge($s_arr,$n_arr);
				
				foreach($m_arr as $kk=>$vv){
					if(!isset($n_arr[$kk])){
						upload_del($kk);
					}elseif($_tmp=move_upload($kk)){
						$pics[$_tmp]=$vv;
					}else{
						upload_del($kk);
					}
				}
				
				$p[$name]=implodes('|',',',$pics);
				
				break;
			
			case 'file':
				
				$v=is_array($v)?$v:array ();
				
				if($fd['input_limit']){
					count($v)<1&&amsg(l($fd['title']).l('必选'),'w','$("#'.$name.'").focus();');
				}
				
				count($v)>$fd['vmax']&&amsg(l($fd['title']).l('上传文件过多'),'w','$("#'.$name.'").focus();');
				
				$arr=explode(',',$item[$name]);
				
				$_arr=array_merge($arr,$v);
				$m_arr=array_unique($_arr);
				
				foreach($m_arr as $kk=>$vv){
					if(strlen($vv)<1){
						unset($m_arr[$kk]);
					}elseif(!in_array($vv,$v)){
						// 删除
						upload_del($vv);
						unset($m_arr[$kk]);
					}elseif($_tmp=move_upload($vv)){
						$m_arr[$kk]=$_tmp;
						;
					}else{
						unset($m_arr[$kk]);
					}
				}
				
				$p[$name]=implode(',',$m_arr);
				break;
			
			default:
		}
	}
	
	return true;
}
function fields_data_del($fds,$dval){
	foreach($fds as $name=>$fd){
		
		if(!$fd['display'] or !$fd['front'])
			continue;
		
		switch($fd['html']){
			case 'thumb':
				
				$arr=explodes('|',',',$dval[$name]);
				foreach($arr as $k=>$v){
					if(strlen($k)<1)
						continue;
					upload_del($k);
				}
				
				break;
			
			case 'file':
				
				$arr=explode(',',$dval[$name]);
				foreach($arr as $v){
					if(strlen($v)<1)
						continue;
					upload_del($v);
				}
				
				break;
			default:
		}
	}
	
	return true;
}
function fields_show($tpl='',$wrap='',$class=''){
	
	$fds=$GLOBALS['FD'];
	$item=$GLOBALS['item'];
	
	if(empty($fds))
		return '';
	
	$html='';
	foreach($fds as $name=>$v){
		if(!$v['front'])
			continue;
		$html.=field_show($name,$fds,$item[$name],$tpl);
	}
	
	if($html!=''){		
	if($tpl=='' && $wrap=='')
			$wrap='<form class="form-horizontal">
				%s
  </form>';
		$html=sprintf($wrap,$html);
		if($class=='')
			$class='mb-20';
		$html='<div class="'.$class.'">'.$html.'</div>';
	}
	
	return $html;
}
function field_show($name,$fds,$val,$tpl=''){
	if(empty($fds) or !isset($fds[$name]))
		return;
	
	$col="10";
	if(empty($tpl)){
		if(defined('IN_ADMIN'))
			$tpl='<div class="form-group">
            <label class="col-md-1 control-label">%s</label>
            <div class="col-md-%s">
             <div class="form-control-static">
					%s
			 </div>
            </div>
          </div>';
		else
			$tpl='<div class="form-group">
            <label class="col-md-2 control-label">%s</label>
            <div class="col-md-%s">
             <div class="form-control-static">
					%s
			 </div>
            </div>
          </div>';
	}
	
	$title='';
	$html='';
	
	$fd=$fds[$name];
	
	$value=$val;
	
	if($fd['html']=='hidden'){
		$html.=html($value);
	}else{
		
		$title=$fd['title'];
		
		switch($fd['html']){
			case 'text':
			case 'float':
			case 'textarea':
				$html=html($value);
				break;
			
			case 'select':
			case 'radio':
			case 'checkbox':
				$os=explodes(',',"\n",$fd['option_value']);
				foreach($os as $k=>$v){
					if($k==$value){
						$html=html($v);
						break;
					}
				}
				
				break;
			
			case 'date':
				$html=date('Y-m-d',$value);
				break;
			case 'thumb':
				$arr=explodes('|',',',$value);
				foreach($arr as $k=>$v){
					if(strlen($k))
						$html.='<img src="'.AYA_URL.'aya/upload/'.$k.'" title="'.html($v).'"/> ';
				}
				break;
			case 'file':
				$arr=explode(',',$value);
				foreach($arr as $v){
					if(strlen($v))
						$html.='<a class="btn btn-sm" href="'.AYA_URL.'aya/upload/'.$v.'"><span class="icon-download-alt"></span> '.l('下载文件').'</a> ';
				}
				break;
			case 'editor':
				$html=$value;
		}
		$v['note']&&$html.='<div class="help-block"> '.$fd['note'].'</div>';
		
		$html=sprintf($tpl,$title,$col,$html);
	}
	return $html;
}
function field($name,$tpl='index'){
	global $FD,$item;
	
	if(!is_array($FD) or !is_array($item) or !isset($FD[$name]))
		return;
	
	$html='';
	$value=$item[$name];
	$fd=$FD[$name];
	
	switch($fd['html']){
		case 'hidden':
		case 'text':
		case 'float':
		case 'textarea':
		case 'date':
		case 'editor':
			if(is_file($file=AYA_ROOT.'table/'.$fd['html'].'/'.$tpl.'.php'))
				include $file;
			break;
		
		case 'select':
		case 'radio':
			$os=explodes(',',"\n",$fd['option_value']);
			if(isset($os[$value])&&is_file($file=AYA_ROOT.'table/'.$fd['html'].'/'.$tpl.'.php')){
				$value=$os[$value];
				include $file;
			}
			break;
		case 'checkbox':
				$os=explodes(',',"\n",$fd['option_value']);
				$val=explode(',', $value);
				if(!is_file($file=AYA_ROOT.'table/'.$fd['html'].'/'.$tpl.'.php')) {
					$values=array();
					foreach($val as $v){
						if(isset($os[$v]))
					$values[]=$os[$v];
					}
					include $file;
				}
				break;
		case 'thumb':
			$values=explodes('|',',',$value);
			if(is_file($file=AYA_ROOT.'table/'.$fd['html'].'/'.$tpl.'.php'))
				include $file;
			break;
		case 'file':
			$values=explode(',',$value);
			if(is_file($file=AYA_ROOT.'table/'.$fd['html'].'/'.$tpl.'.php'))
				include $file;
			break;
	}
	
	return $html;
}
function fields_edit(){
	global $FD;
	if(!is_array($FD) or empty($FD))
		return;
	
	$html='';
	foreach($FD as $name=>$v){
		if(!$v['display'])
			continue;
		$html.=field_edit($name);
	}
	return $html;
}
function field_edit($name,$tpl=''){
	global $FD,$item;
	if(!isset($FD) or !isset($FD[$name]))
		return;
	
	$fd=$FD[$name];
	
	if(is_array($item)&&isset($item[$name]))
		$value=(string)$item[$name];
	else
		eval('$value = "'.$fd['default_value'].'";');
	
	$col="6";
	if(empty($tpl)){
		if(defined('IN_ADMIN'))
			$tpl='<div class="form-group">
            <label class="col-md-1 control-label %s">%s</label>
            <div class="col-md-%s">
             %s
            </div>
          </div>';
		else
			$tpl='<div class="form-group">
            <label class="col-md-2 control-label %s">%s</label>
            <div class="col-md-%s">
             %s
            </div>
          </div>';
	}
	
	$title='';
	$requi='';
	$html='';
	
	if($fd['html']=='hidden'){
		$html.='<input type="hidden" name="field_posts['.$name.']" id="'.$fd['name'].'" value="'.html($value).'" />';
	}else{
		
		if($fd['input_limit']){
			$requi=' required';
		}
		
		$title=$fd['title'];
		
		switch($fd['html']){
			case 'text':
			case 'float':
				$html.='<input type="text" name="field_posts['.$fd['name'].']" id="'.$fd['name'].'" value="'.html($value).'" class="form-control" '.$fd['addition'].'/> ';
				break;
			case 'textarea':
				$html.='<textarea class="form-control" name="field_posts['.$fd['name'].']" id="'.$fd['name'].'" '.$fd['addition'].'>'.html($value).'</textarea> ';
				break;
			
			case 'select':
				
				$os=explodes(',',"\n",$fd['option_value']);
				
				$html.='<select class="form-control" name="field_posts['.$fd['name'].']" id="'.$fd['name'].'" '.$fd['addition'].'><option value="">请选择..</option>';
				foreach($os as $k=>$v){
					$html.='<option value="'.$k.'"'.($k==$value?' selected':'').'>'.html($v).'</option>';
				}
				$html.='</select> ';
				
				break;
			case 'radio':
				$os=explodes(',',"\n",$fd['option_value']);
				
				$html.='<span id="'.$name.'">';
				foreach($os as $k=>$v){
					$html.='<label class="checkbox-inline"><input type="radio" name="field_posts['.$fd['name'].']" value="'.$k.'" id="'.$fd['name'].'_'.$k.'"'.($k==$value?' checked':'').'> '.html($v).'</label>';
				}
				$html.='</span> ';
				
				break;
			case 'checkbox':
				$os=explodes(',',"\n",$fd['option_value']);
				
				$html.='<span id="'.$fd['name'].'">';
				$value=explode(',',$value);
				foreach($os as $k=>$v){
					$html.='<label class="checkbox-inline"><input type="checkbox" name="field_posts['.$fd['name'].'][]" value="'.$k.'" id="'.$fd['name'].'_'.$k.'"'.(in_array($k,$value)?' checked':'').'> '.html($v).'</label>';
				}
				$html.='</span> ';
				
				break;
			case 'date':
				$html.='<input type="text" name="field_posts['.$fd['name'].']" class="form-control form-dcalendar" placeholder="" value="'.date('Y-m-d',$value).'">';
				break;
			case 'thumb':
				$html.=set_field_upload('field_posts['.$fd['name'].']',AYA_URL.'ajax.php?fun=upload_thumb','pic',$value);
				break;
			case 'file':
				$html.=set_field_upload('field_posts['.$fd['name'].']',AYA_URL.'ajax.php?fun=upload_file','',$value);
				
				break;
			case 'editor':
				if(defined('IN_ADMIN'))
				$col=11;
				else 
				$col=10;
				$html.=set_field_editor($fd['name'],$value,$fd['addition']);
				break;
		}
		$v['note']&&$html.='<div class="help-block"> '.$fd['note'].'</div>';
		
		$html=sprintf($tpl,$requi,$title,$col,$html);
	}
	return $html;
}
?>