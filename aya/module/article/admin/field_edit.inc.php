<?php
defined('IN_AYA') or exit('Access Denied');

$sname=(string)$_GET['name'];
isset($FD[$sname]) or amsg(l('表单不存在'),'w');

if(IN_POST){
	extract($posts,EXTR_SKIP);
	
	$p=array (
			'name'=>(string)$name,
			'title'=>(string)$title,
			'html'=>(string)$html,
			'vmin'=>(int)$vmin,
			'vmax'=>(int)$vmax,
			'note'=>(string)$note,
			'input_limit'=>$input_limit?1:0,
			'option_value'=>(string)$option_value,
			'default_value'=>(string)$default_value,
			'display'=>(string)$display,
			'front'=>(string)$front,
			'addition'=>(string)$addition 
	);
	
	check_name($p['name']) or amsg(l('请正确填写字段名称'),'w','$("#name").focus();');
	empty($p['title'])&&amsg(l('请填写标题'),'w','$("#title").focus();');
	isset($ADDFIELD[$p['html']]) or amsg(l('请选择表单类型'),'w','$("#html").focus();');
	
	if(!in_array($p['html'],array (
			'radio',
			'hidden',
			'checkbox',
			'thumb',
			'file' 
	))){
		$p['vmin']<0&&amsg(l('请正确设置最小输入范围'),'w','$("#vmin").focus();');
	}
	
	if(!in_array($p['html'],array (
			'radio',
			'hidden' 
	))){
		($p['vmax']<1 or $p['vmin']>$p['vmax'])&&amsg(l('请正确设置最大输入范围'),'w','$("#vmax").focus();');
	}
	
	if(in_array($p['html'],array (
			'radio',
			'select',
			'checkbox' 
	))){
		empty($p['option_value'])&&amsg(l('请填写选项值'),'w','$("#option_value").focus();');
	}
	
	$o=new field();
	$o->table=$c_table;
	$o->name=$sname;
	$o->newname=$p['name'];
	$o->p=$p;
	if(!$o->edit()){
		amsg($o->msg,'w');
	}else
		amsg(l('已修改'),'s');
}

htmls($FD[$sname]);
extract($FD[$sname],EXTR_SKIP);

include template($action,'article');
