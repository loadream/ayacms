<?php
defined('IN_AYA') or exit('Access Denied');


$t=array('pc','tc','wx');
foreach($t as $type){
${$type.'s'}=thesenames(ROOT.$c_dirname.'/'.$type.'/','');
${$type.'2s'}=thesenames(AYA_ROOT.'template/'.$CFG['template_'.$type].'/'.$c_module.'/','');

${$type.'v'}=${$type.'2v'}=array ();
foreach(${$type.'s'} as $k=>$v){
${$type.'v'}[$k]=array (
			'name'=>$v,
			'dir'=>$c_dirname.'/'.$type.'/',
			'alert'=>false 
	);
}

foreach(${$type.'2s'} as $k=>$v){
${$type.'2v'}[$k]=array (
			'name'=>$v,
			'dir'=>'aya/template/'.$CFG['template_'.$type].'/'.$c_module.'/',
			'alert'=>isset(${$type.'s'}[$k]) 
	);
}
}


include template($action,'article');
