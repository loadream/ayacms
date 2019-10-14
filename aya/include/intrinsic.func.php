<?php
defined('IN_AYA') or exit('Access Denied');
function _template_diyitem_in1($par1,$par2){
	parse_str($par2,$arr);
	$toarr=array ();
	foreach($arr as $k=>$v){
		$toarr[]=array (
				'key'=>$k,
				'val'=>$v 
		);
	}
	return array (
			'name'=>$par1,
			'pars'=>$toarr 
	);
}
function _template_formatcode_diy_1_in1($r){
	$tpls=&get_val('tpls');
	$code=$r[0];
	$md5=md5($code);
	$tpls[$md5]=$code;
	return '{{'.$md5.'}}';
}
function _template_formatcode_diy_1_in2($r){
	$code=$r[0];
	$code=preg_replace_callback("/\{\{(\w{32})\}\}/is","_template_formatcode_diy_1_in2_in1",$code);
	return $code;
}
function _template_formatcode_diy_1_in2_in1($r){
	$tpls=&get_val('reptpl');
	return $tpls[$r[1]];
}
function _template_formatcode_diy_1_in3($r){
	$tpls=&get_val('tpls');
	return $tpls[$r[1]];
}
function _template_formatcode_diy_2_in1($r){
	$tpls=&get_val('tpls');
	$code=$r[0];
	$md5=md5($code);
	$tpls[$md5]=$code;
	return '{{'.$md5.'}}';
}
function _template_formatcode_diy_2_in2($r){
	$code=$r[0];
	$code=str_replace(array (
			'<layer>',
			'</layer>',
			'<layeritem>',
			'</layeritem>' 
	),array (
			'LAYER_BEGIN',
			'LAYER_END',
			'LAYERITEM_BEGIN',
			'LAYERITEM_END' 
	),$code);
	$code=preg_replace_callback("/\{\{(\w{32})\}\}/is","_template_formatcode_diy_2_in2_in1",$code);
	return $code;
}
function _template_formatcode_diy_2_in2_in1($r){
	$tpls=&get_val('tpls');
	return $tpls[$r[1]];
}
function _template_formatcode_diy_2_in3($r){
	$tpls=&get_val('reptpl');
	return $tpls[$r[1]];
}
function _template_parse_in1($r){
	$tplfile=&get_val('tplfile');
	return template_layer($r[1],$tplfile);
}
function _template_parse_in2($r){
	return template_layeritem($r[1]);
}
function _template_parse_in3($r){
	$tplfile=&get_val('tplfile');
	return template_diy($r[1],$tplfile);
}
function _template_parse_in4($r){
	return template_diyitem($r[1]);
}
function _template_parse_in5($r){
	return template_addquote('<?php'.$r[1].'?>');
}
function _template_parse_in6($r){
	return template_addquote('<?php echo '.$r[1].';?>');
}
function _template_parse_in7($r){
	if(preg_match('/[A-Z0-9_]+$/s',$r[1]))
		return '['.$r[1].']';
	else
	return '[\''.$r[1].'\']';
	
}

function _class_phpmailer_in1($r){
	return '='.sprintf('%02X',ord($r[1]));
}