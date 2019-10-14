<?php
defined('IN_AYA') or exit('Access Denied');
function template_diy($str,$tplfile){
	static $sign=array ();
	isset($sign[$tplfile]) or $sign[$tplfile]=0;
	
	$i=$sign[$tplfile]++;
	$id=md5($tplfile).'_'.$i;
	
	return '<div class="board panel" style="float: none; width: 100%; margin:5px ">
			<div class="panel-heading dropdown" style="padding:0px 15px;" >

          <a role="button" data-toggle="dropdown" style="font-size:9px">
           edit <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li>
              <a href="javascript:void(0)" onclick="diyitem_add(\''.$id.'\')">新加标签</a>
            </li>
            <li>
              <a href="javascript:void(0)" onclick="diy_clean(\''.$id.'\')">清空</a>
            </li>
          </ul>

            </div>
			<div style="padding:5px">
              <div class="board-list" id="'.$id.'" tpl-file="'.$tplfile.'">
			'.$str.'
					</div>
					</div>
					</div>';
}
function template_diyitem($str){
	$pararr=array ();
	$con=array ();

	if(preg_match('/'.preg_quote('{diy ','/').'(.+)'.preg_quote('}','/').'/isU',$str,$con)){
		eval('$pararr=_template_diyitem_in1('.$con[1].');');
	}
	
	return '<div class="board-item diyitem" diyitem-id="'.md5($str).'" id="'.random(5).'" diy-par="'.html(json_encode($pararr)).'">
			<div class="dropdown">
          <a role="button" data-toggle="dropdown" style="font-size:9px">
           edit <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li>
              <a href="javascript:void(0)" onclick="diyitem_edit(this)">编辑</a>
            </li>
            <li>
              <a href="javascript:void(0)" onclick="diyitem_del(this)">删除</a>
            </li>
          </ul>
            </div>
			'.$str.'</div>';
}
function template_set_diy(){
	
	$diys=get_val('diys');
	$items=get_val('items');
	$tplfile=get_val('file');
	
	static $sign=array ();
	isset($sign[$tplfile]) or $sign[$tplfile]=0;
	
	$i=$sign[$tplfile]++;
	$id=md5($tplfile).'_'.$i;
	
	$code='';
	if(is_array($diys[$id])&&count($diys[$id]>0)){
		foreach($diys[$id] as $v){
			if(isset($items[$v['diyitem-id']]))
				$code.="\n".'<diyitem>'.$items[$v['diyitem-id']].'</diyitem>';
			else{
				// 新建
				$diy_par=(array)$v['diy-par'];
				$name=$diy_par['name'];
				$pars=$diy_par['pars'];
				
				$parstr='';
				foreach($pars as $pv){
					$pv=(array)$pv;
					if($parstr)
						$parstr.='&';
					$parstr.=$pv['key'].'='.$pv['val'];
				}
				$parstr=str_replace('\'','\\\'',$parstr);
				$code.="\n".'<diyitem>{diy \''.$name.'\',\''.$parstr.'\'}</diyitem>';
			}
		}
	}
	return '<diy>'.$code.'</diy>';
}
function template_layer($str,$tplfile){
	static $sign=array ();
	isset($sign[$tplfile]) or $sign[$tplfile]=0;
	$i=$sign[$tplfile]++;
	$id=md5($tplfile).'_'.$i;
	
	return '<div class="board panel" style="float: none; width: 100%; margin:5px ">
			<div class="panel-heading dropdown" style="padding:0px 15px;" >

          <a role="button" data-toggle="dropdown" style="font-size:9px">
           edit <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li>
              <a href="javascript:void(0)" onclick="layeritem_add(\''.$id.'\')">新加布局</a>
            </li>
            <li>
              <a href="javascript:void(0)" onclick="layer_clean(\''.$id.'\')">清空</a>
            </li>
          </ul>
		
            </div>
			<div style="padding:5px">
              <div class="board-list" id="'.$id.'" tpl-file="'.$tplfile.'">
			'.$str.'
					</div>
					</div>
					</div>';
}
function template_layeritem($str){
	$html=str_replace(array (
			'<diyitem>',
			'</diyitem>',
			'<diy>',
			'</diy>',
			'LAYER_BEGIN',
			'LAYER_END',
			'LAYERITEM_BEGIN',
			'LAYERITEM_END' 
	),'',$str);
	$str=str_replace(array (
			'LAYER_BEGIN',
			'LAYER_END',
			'LAYERITEM_BEGIN',
			'LAYERITEM_END' 
	),array (
			'<layer>',
			'</layer>',
			'<layeritem>',
			'</layeritem>' 
	),$str);
	
	return '<div class="board-item layeritem" layeritem-id="'.md5($str).'" id="'.random(5).'">
						<div class="dropdown">

          <a role="button" data-toggle="dropdown" style="font-size:9px">
           edit <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li>
              <a href="javascript:void(0)" onclick="layeritem_edit(this)">更换</a>
            </li>
            <li>
              <a href="javascript:void(0)" onclick="layeritem_del(this)">删除</a>
            </li>
          </ul>
            </div>
			'.$html.'</div>';
}
function template_set_layer(){
	
	$layers=get_val('layers');
	$items=get_val('items');
	$tplfile=get_val('file');
	
	static $sign=array ();
	isset($sign[$tplfile]) or $sign[$tplfile]=0;
	
	$i=$sign[$tplfile]++;
	$id=md5($tplfile).'_'.$i;
	$code='';
	if(is_array($layers[$id])&&count($layers[$id]>0)){
		foreach($layers[$id] as $v){
			if(isset($items[$v['layeritem-id']]))
				$code.="\n".'<layeritem>'.$items[$v['layeritem-id']].'</layeritem>';
			else
				$code.="\n".template_bs_layer($v['layeritem-id']);
		}
	}
	return '<layer>'.$code.'</layer>';
}
function template_bs_layer($str){
	if(empty($str))
		$str='0:12';
	$x=explode(':',$str);
	$tag=array_shift($x);
	$tag=$tag?'layer':'diy';
	$code='';
	foreach($x as $v){
		$code.='<div class="col-md-'.$v.'">
<'.$tag.'></'.$tag.'>
</div>';
	}
	
	return '<layeritem>
			<div class="row">
			'.$code.'
			</div>
			</layeritem>';
}
function template_update(){
	$files=glob(AYA_ROOT.'cache/template/*.php');
	if(is_array($files)){
		foreach($files as $file){
			file_del($file);
		}
	}
	return true;
}
function template_compile($from,$to){
	$content=template_parse(file_get($from),$from);
	file_put($to,$content);
}
function template_formatcode_diy_1($str){
	set_val('tpls',array());
	
	$str=preg_replace_callback("/(\<layer\>)((?!\<layer\>|\<\/layer\>).)*?(\<\/layer\>)/is","_template_formatcode_diy_1_in1",$str);
	$reptpl=get_val('tpls');	
	foreach($reptpl as $k=>$tpl){
		$tpl=preg_replace("/(\<layer\>)(.*?)(\<layeritem\>)(.*?)(\<\/layer\>)/is",'$1$2LAYERITEM_BEGIN$4$5',$tpl);
		$tpl=preg_replace("/(\<layer\>)(.*?)(\<\/layeritem\>)(.*?)(\<\/layer\>)/is",'$1$2LAYERITEM_END$4$5',$tpl);
		$tpl=preg_replace("/\<layer\>/is",'LAYER_BEGIN',$tpl);
		$tpl=preg_replace("/\<\/layer\>/is",'LAYER_END',$tpl);
		$reptpl[$k]=$tpl;
	}
	
	set_val('reptpl',$reptpl);
	$str=preg_replace_callback("/(\<layer\>)((?!\<layer\>|\<\/layer\>).)*?(\<\/layer\>)/is","_template_formatcode_diy_1_in2",$str);
	
	$str=preg_replace_callback("/\{\{(\w{32})\}\}/is","_template_formatcode_diy_1_in3",$str);
	
	return $str;
}
function template_formatcode_diy_2($str){
	set_val('tpls',array());
	
	$str=preg_replace_callback("/(\<layer\>)((?!\<layer\>|\<\/layer\>).)*?(\<\/layer\>)/is","_template_formatcode_diy_2_in1",$str);
	$str=preg_replace_callback("/(\<layer\>)((?!\<layer\>|\<\/layer\>).)*?(\<\/layer\>)/is","_template_formatcode_diy_2_in2",$str);
	
	$reptpl=get_val('tpls');
	foreach($reptpl as $k=>$tpl){
		$tpl=str_replace(array (
				'<layer>',
				'</layer>',
				'<layeritem>',
				'</layeritem>' 
		),array (
				'LAYER_BEGIN',
				'LAYER_END',
				'LAYERITEM_BEGIN',
				'LAYERITEM_END' 
		),$tpl);
		$reptpl[$k]=$tpl;
	}
	set_val('reptpl',$reptpl);
	$str=preg_replace_callback("/\{\{(\w{32})\}\}/is","_template_formatcode_diy_2_in3",$str);
	
	return $str;
}
function template_parse($str,$tplfile){
	global $CFG;
	set_val('tplfile',$tplfile);
	if(IN_DIY==1){
		$str=template_formatcode_diy_1($str);
		
		
		
		$str=preg_replace_callback("/\<layer\>(.*?)\<\/layer\>/is","_template_parse_in1",$str);
		$str=preg_replace_callback("/\<layeritem\>(.*?)\<\/layeritem\>/is","_template_parse_in2",$str);
		$str=str_replace(array (
				'LAYER_BEGIN',
				'LAYER_END',
				'LAYERITEM_BEGIN',
				'LAYERITEM_END' 
		),'',$str);
	}elseif(IN_DIY==2){
		$str=template_formatcode_diy_2($str);
		$str=preg_replace_callback("/\<layer\>(.*?)\<\/layer\>/is","_template_parse_in1",$str);
		$str=preg_replace_callback("/\<layeritem\>(.*?)\<\/layeritem\>/is","_template_parse_in2",$str);
		$str=str_replace(array (
				'LAYER_BEGIN',
				'LAYER_END',
				'LAYERITEM_BEGIN',
				'LAYERITEM_END' 
		),'',$str);
	}elseif(IN_DIY==3){
		$str=str_replace(array (
				'<layeritem>',
				'</layeritem>',
				'<layer>',
				'</layer>' 
		),'',$str);
		$str=preg_replace_callback("/\<diy\>(.*?)\<\/diy\>/is","_template_parse_in3",$str);
		$str=preg_replace_callback("/\<diyitem\>(.*?)\<\/diyitem\>/is","_template_parse_in4",$str);
	}else{
		$str=str_replace(array (
				'<diy>',
				'</diy>',
				'<diyitem>',
				'</diyitem>',
				'<layer>',
				'</layer>',
				'<layeritem>',
				'</layeritem>' 
		),'',$str);
	}
	
	!DEBUG&&$str=preg_replace("/\s*<\!--[^\[]*?-->/si","",$str);
	$str=preg_replace("/\{template\s+([^\}]+)\}/","<?php include template(\\1);?>",$str);
	$str=preg_replace("/\{tag\s+([^\}]+)\}/","<?php include tag(\\1);?>",$str);
	$str=preg_replace("/\{diy\s+([^\}]+)\}/","<?php diy(\\1);?>",$str);
	$str=preg_replace("/\{php\s+(.+)\}/","<?php \\1?>",$str);
	$str=preg_replace("/\{if\s+(.+?)\}/","<?php if(\\1) { ?>",$str);
	$str=preg_replace("/\{else\}/","<?php } else { ?>",$str);
	$str=preg_replace("/\{elseif\s+(.+?)\}/","<?php } else if(\\1) { ?>",$str);
	$str=preg_replace("/\{\/if\}/","<?php } ?>\r\n",$str);
	$str=preg_replace("/\{loop\s+(\S+)\s+(\S+)\}/","<?php if(is_array(\\1)) { foreach(\\1 as \\2) { ?>",$str);
	$str=preg_replace("/\{loop\s+(\S+)\s+(\S+)\s+(\S+)\}/","<?php if(is_array(\\1)) { foreach(\\1 as \\2 => \\3) { ?>",$str);
	$str=preg_replace("/\{\/loop\}/","<?php } } ?>",$str);
	$str=preg_replace("/\{([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*\(([^{}]*)\))\}/","<?php echo \\1;?>",$str);
	$str=preg_replace_callback("/<\?php([^\?]+)\?>/s","_template_parse_in5",$str);
	$str=preg_replace("/\{(\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\+\-\x7f-\xff]*)\}/","<?php echo \\1;?>",$str);
	$str=preg_replace_callback("/\{(\\$[a-zA-Z0-9_\[\]\'\"\$\x7f-\xff]+)\}/s","_template_parse_in6",$str);
	$str=preg_replace("/\{([A-Z_\x7f-\xff][A-Z0-9_\x7f-\xff]*)\}/s","<?php echo \\1;?>",$str);
	$str=preg_replace("/\'([A-Za-z]+)\[\'([A-Za-z\.]+)\'\](.?)\'/s","'\\1[\\2]\\3'",$str);
	$str=preg_replace("/(\r?\n)\\1+/","\\1",$str);
	$str=str_replace("\t",'',$str);
	$str="<?php defined('IN_AYA') or exit('Access Denied');?>".$str;
	
	return $str;
}
function template_addquote($str){
	return preg_replace_callback("/\[([a-zA-Z0-9_\-\.\x7f-\xff]+)\]/s","_template_parse_in7",$str);
}
?>