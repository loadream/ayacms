<?php
defined('IN_AYA') or exit('Access Denied');
function get_template(){
	global $CFG,$USER;
	$template=get_cookie('template');
	
	if(in_array($template, array('pc','tc','wx'))){
		define('CLIENT',$template);
		return $CFG['template_'.$template];
	}
	
	if(is_weixin()){
		define('CLIENT','wx');
		set_cookie('template','wx');
		return $CFG['template_wx'];
	}elseif(is_touch()){
		define('CLIENT','tc');
		set_cookie('template','tc');
		return $CFG['template_tc'];
	}else{
		define('CLIENT','pc');
		set_cookie('template','pc');
		return $CFG['template_pc'];
	}
}
function is_weixin(){
	return strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger')!==false;
}
function is_touch(){
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");
	$is_mobile = false;
	foreach ($mobile_agents as $device) {
		if (stristr($user_agent, $device)) {
			$is_mobile = true;
			break;
		}
	}
	return $is_mobile;
}
function comment_del($itemid){
	global $db;
	$db->query("delete from ".PF."comment where itemid='".$itemid."'");
	return true;
}
function send_mail($sendto_email,$subject,$body,$user_name){
	global $USER,$CFG;
	require_once (AYA_ROOT.'include/mailer/class.phpmailer.php');
	
	ob_start();
	$mail=new PHPMailer();
	$mail->IsSMTP();
	$mail->Host='ssl://'.$CFG['smtp_host'];
	$mail->Port=$CFG['smtp_port'];
	$mail->SMTPAuth=true;
	$mail->Username=$CFG['smtp_username'];
	$mail->Password=$CFG['smtp_password'];
	$mail->From=$CFG['smtp_from']; // 发件人email;
	$mail->FromName=$CFG['title']; // 发件人称呼
	$mail->CharSet="UTF-8";
	$mail->Encoding="base64";
	$mail->AddAddress($sendto_email,$user_name);
	$mail->IsHTML(true);
	$mail->Subject=$subject;
	$mail->Body='
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>'.$body.'
</body>
</html>
';
	ob_end_clean();
	ob_start();
	$re=$mail->Send();
	ob_end_clean();
	if($re===true){
		return true;
	}else{
		return $mail->ErrorInfo;
	}
}
function put_config($arr,$path=AYA_ROOT){
	ob_start();
	var_export($arr);
	$string=ob_get_contents();
	ob_end_clean();
	
	$string='<?php defined(\'IN_AYA\') or exit(\'Access Denied\');
			return '.$string.';
					';
	$file=$path.'config.inc.php';
	return file_put($file,$string);
}
function l($str,$s1='',$s2='',$s3=''){
	global $L;
	if(!isset($L[$str])){
		return sprintf($str,$s1,$s2,$s3);
	}else
		return sprintf($L[$str],$s1,$s2,$s3);
}
function timer_start(){
	global $__timestart;
	return $__timestart=microtime(true);
}
function timer_end($display=false){
	global $__timestart,$db;
	$_t=sprintf('%01.3fMs',microtime(true)-$__timestart);
	$_t.=sprintf(' %01.2fMb',memory_get_usage()/1024/1024);
	$_t.=' '.$db->querynum.'Queries';
	if(DEBUG)
		$_t.=' DEBUG <span style="color:red">on</span>';
	if(empty($display))
		return $_t;
	echo $_t;
}
function set_theme(){
	extract($GLOBALS);
	if($USER['groupid']!=2)
		return;
	include AYA_TROOT.'theme/tpl.inc.php';
	return;
}
function fm_path($module,$lang=false){
	global $CHANNELS;
	if(false===$lang)
		$lang=AYA_LANG;
	
	foreach($CHANNELS as $v){
		if($v['module']==$module&&$v['language']==$lang){
			return $v['path'];
		}
	}
	
	return '';
}
function url($path,$action='',$query=''){
	if(substr($path,0,7)!='http://'){
		$path=AYA_URL.$path;
	}
	if($action=='index.php')
		$action='';
	
	if(!REWRITE or !in_array($action,array (
			'',
			'show.php' 
	)))
		return $path.$action.(strlen($query)>0?'?':'').$query;
	
	parse_str($query,$put);
	
	if(strlen($put['sign'])>0)
		$pname=$put['sign'];
	else if(strlen($put['tag'])>0)
		$pname=$put['tag'];
	else if($action=='show.php')
		$pname='show-'.$put['itemid'];
	else
		$pname='';
	
	$page=$put['page'];
	unset($put['sign'],$put['tag'],$put['page'],$put['itemid']);
	
	$query=http_build_query($put);
	if($query)
		$query='?'.$query;
	
	if(strlen($pname)>0){
		if($page<2&&$page!='(*)')
			$url=$path.$pname.'.html'.$query;
		else
			$url=$path.$pname.'-'.$page.'.html'.$query;
	}else{
		if($page<2&&$page!='(*)')
			$url=$path.$query;
		else
			$url=$path.$page.'.html'.$query;
	}
	
	return $url;
}
function thesenames($dir,$is_dir=false,$note=false){
	$these=array ();
	$arr=$is_dir?file_dlist($dir):file_flist($dir);
	
	if(empty($arr))
		return $these;
	
	$file=$dir.'these.name.php';
	if(is_file($file))
		$names=include $file;
	else
		$names=array ();
	
	foreach($arr as $v){
		$filename=basename($v);
		if($filename=='these.name.php')
			continue;
		if($note)
			$these[$filename]=isset($names[$filename])?($names[$filename].'('.$filename.')'):$filename;
		else
			$these[$filename]=isset($names[$filename])?$names[$filename]:'';
	}
	
	return $these;
}
function explodes($d1,$d2,$str){
	$arr=array ();
	$_arr=explode($d2,$str);
	
	foreach($_arr as $_str){
		$_str=trim($_str);
		if(strlen($_str)>0){
			$_=explode($d1,$_str);
			$arr[$_[0]]=$_[1];
		}
	}
	return $arr;
}

function implodes($d1,$d2,$arr){
	$str='';
	$a=array();
	foreach($arr as $k=>$v){
	$a[]=$k.$d1.$v;
	}
	return implode($d2,$a);
}


function move_upload($file){
	if(preg_match('/^~tmp\/([A-Za-z0-9\.]+)/is',$file,$data)){
		
		$file=AYA_ROOT.'upload/'.$file;
		if(!is_file($file))
			amsg(l('上传文件已丢失'));
		
		$ym=date('ym',TIME);
		$d=date('d',TIME);
		
		dir_create(AYA_ROOT.'upload/'.$ym) or amsg('upload/'.l('无法创建目录'));
		dir_create(AYA_ROOT.'upload/'.$ym.'/'.$d) or amsg('upload/'.$ym.l('无法创建目录'));
		
		$newfile=AYA_ROOT.'upload/'.$ym.'/'.$d.'/'.$data[1];
		
		if(!file_copy($file,$newfile)){
			amsg(l('复制文件失败'));
		}
		
		$ext=strtolower(str_replace('.','',strrchr($file,'.')));
		if(in_array($ext,array (
				'gif',
				'png',
				'jpg',
				'jpeg' 
		))){
			thumb($newfile);
		}
		file_del($file);
		return $ym.'/'.$d.'/'.$data[1];
	}else if(preg_match('/\d{4}\/\d{2}\/[A-Za-z0-9\.]+/isU',$file)){
		
		return $file;
	}else
		return;
}
function img2thumb($file,$width=''){
	$file=AYA_ROOT.'upload/~tmp/'.$file;
	
	if(!is_file($file))
		return;
	$ext=strtolower(str_replace('.','',strrchr($file,'.')));
	if(!in_array($ext,array (
			'gif',
			'png',
			'jpg',
			'jpeg' 
	)))
		return;
	
	if(!$data=@getimagesize($file)){
		return;
	}
	
	if(empty($width)){
		$w=$data[0];
	}else if(str_is_int($width))
		$w=$width;
	else
		$w=800;
	
	$img=null;
	if($ext=='gif'){
		$img=imagecreatefromgif($file);
	}else if($ext=='jpg'||$ext=='jpeg'){
		$img=imagecreatefromjpeg($file);
	}else if($ext=='png'){
		$img=imagecreatefrompng($file);
	}
	if(empty($img)){
		return;
	}
	
	$width=$data[0]>$w?$w:$data[0];
	$height=$data[1]*($width/$data[0]);
	
	$srcW=$data[0];
	$srcH=$data[1];
	
	$sx=0;
	$sy=0;
	
	if(function_exists('imagecreatetruecolor')){
		$new=imagecreatetruecolor($width,$height);
		if($ext=='png'){
		$alpha = imagecolorallocatealpha($new, 0, 0, 0, 127);
		imagefill($new, 0, 0, $alpha);
		}
		ImageCopyResampled($new,$img,0,0,$sx,$sy,$width,$height,$srcW,$srcH);
	}else{
		$new=imagecreate($width,$height);
		ImageCopyResized($new,$img,0,0,$sx,$sy,$width,$height,$srcW,$srcH);
	}
	if($ext=='gif'){
		Imagegif($new,$file,90);
	}else if($ext=='jpg'||$ext=='jpeg'){
		Imagejpeg($new,$file,90);
	}else if($ext=='png'){
		imagesavealpha($new, true);
		Imagepng($new,$file);
	}
	ImageDestroy($new);
	ImageDestroy($img);
	return true;
}
function thumb($file){
	if(!is_file($file))
		return;
	$ext=strtolower(str_replace('.','',strrchr($file,'.')));
	
	if(!$data=@getimagesize($file)){
		return;
	}
	
	$img=null;
	if($ext=='gif'){
		$img=imagecreatefromgif($file);
	}else if($ext=='jpg'||$ext=='jpeg'){
		$img=imagecreatefromjpeg($file);
	}else if($ext=='png'){
		$img=imagecreatefrompng($file);
	}
	if(empty($img)){
		return;
	}
	/* */
	$newfile=get_4x4($file);
	$width=240;
	$height=240;
	
	$srcW=$data[0];
	$srcH=$data[1];
	
	if($srcW/$srcH>4/3){
		$_x=$srcH*4/4;
		$sx=round(($srcW-$_x)/2);
		$sy=0;
		$srcW=round($srcH*4/4);
	}elseif($srcW/$srcH<4/4){
		$_y=$srcW*4/4;
		$sx=0;
		$sy=round(($srcH-$_y)/5);
		$srcH=round($srcW*4/4);
	}else{
		$sx=0;
		$sy=0;
	}
	
	if(function_exists('imagecreatetruecolor')){
		$new=imagecreatetruecolor($width,$height);
		if($ext=='png'){
		$alpha = imagecolorallocatealpha($new, 0, 0, 0, 127);
		imagefill($new, 0, 0, $alpha);
		}
		ImageCopyResampled($new,$img,0,0,$sx,$sy,$width,$height,$srcW,$srcH);
	}else{
		$new=imagecreate($width,$height);
		ImageCopyResized($new,$img,0,0,$sx,$sy,$width,$height,$srcW,$srcH);
	}
	if($ext=='gif'){
		Imagegif($new,$newfile,90);
	}else if($ext=='jpg'||$ext=='jpeg'){
		Imagejpeg($new,$newfile,90);
	}else if($ext=='png'){
		imagesavealpha($new, true);
		Imagepng($new,$newfile);
	}
	ImageDestroy($new);
	/* */
	$newfile=get_4x3($file);
	$width=240;
	$height=180;
	
	$srcW=$data[0];
	$srcH=$data[1];
	
	if($srcW/$srcH>4/3){
		$_x=$srcH*4/3;
		$sx=round(($srcW-$_x)/2);
		$sy=0;
		$srcW=round($srcH*4/3);
	}elseif($srcW/$srcH<4/3){
		$_y=$srcW*3/4;
		$sx=0;
		$sy=round(($srcH-$_y)/5);
		$srcH=round($srcW*3/4);
	}else{
		$sx=0;
		$sy=0;
	}
	
	if(function_exists('imagecreatetruecolor')){
		$new=imagecreatetruecolor($width,$height);
		if($ext=='png'){
		$alpha = imagecolorallocatealpha($new, 0, 0, 0, 127);
		imagefill($new, 0, 0, $alpha);
		}
		ImageCopyResampled($new,$img,0,0,$sx,$sy,$width,$height,$srcW,$srcH);
	}else{
		$new=imagecreate($width,$height);
		ImageCopyResized($new,$img,0,0,$sx,$sy,$width,$height,$srcW,$srcH);
	}
	if($ext=='gif'){
		Imagegif($new,$newfile,90);
	}else if($ext=='jpg'||$ext=='jpeg'){
		Imagejpeg($new,$newfile,90);
	}else if($ext=='png'){
		imagesavealpha($new, true);
		Imagepng($new,$newfile);
	}
	ImageDestroy($new);
	/* */
	$newfile=get_3x2($file);
	$width=240;
	$height=160;
	
	$srcW=$data[0];
	$srcH=$data[1];
	
	if($srcW/$srcH>3/2){
		$_x=$srcH*3/2;
		$sx=round(($srcW-$_x)/2);
		$sy=0;
		$srcW=round($srcH*3/2);
	}elseif($srcW/$srcH<3/2){
		$_y=$srcW*2/3;
		$sx=0;
		$sy=round(($srcH-$_y)/5);
		$srcH=round($srcW*2/3);
	}else{
		$sx=0;
		$sy=0;
	}
	
	if(function_exists('imagecreatetruecolor')){
		$new=imagecreatetruecolor($width,$height);
		if($ext=='png'){
		$alpha = imagecolorallocatealpha($new, 0, 0, 0, 127);
		imagefill($new, 0, 0, $alpha);
		}
		ImageCopyResampled($new,$img,0,0,$sx,$sy,$width,$height,$srcW,$srcH);
	}else{
		$new=imagecreate($width,$height);
		ImageCopyResized($new,$img,0,0,$sx,$sy,$width,$height,$srcW,$srcH);
	}
	if($ext=='gif'){
		Imagegif($new,$newfile,90);
	}else if($ext=='jpg'||$ext=='jpeg'){
		Imagejpeg($new,$newfile,90);
	}else if($ext=='png'){
		imagesavealpha($new, true);
		Imagepng($new,$newfile);
	}
	ImageDestroy($new);
	/* */
	$newfile=get_2x3($file);
	$width=240;
	$height=360;
	
	$srcW=$data[0];
	$srcH=$data[1];
	
	if($srcW/$srcH>2/3){
		$_x=$srcH*2/3;
		$sx=round(($srcW-$_x)/2);
		$sy=0;
		$srcW=round($srcH*2/3);
	}elseif($srcW/$srcH<2/3){
		$_y=$srcW*3/2;
		$sx=0;
		$sy=round(($srcH-$_y)/5);
		$srcH=round($srcW*3/2);
	}else{
		$sx=0;
		$sy=0;
	}
	
	if(function_exists('imagecreatetruecolor')){
		$new=imagecreatetruecolor($width,$height);
		if($ext=='png'){
		$alpha = imagecolorallocatealpha($new, 0, 0, 0, 127);
		imagefill($new, 0, 0, $alpha);
		}
		ImageCopyResampled($new,$img,0,0,$sx,$sy,$width,$height,$srcW,$srcH);
	}else{
		$new=imagecreate($width,$height);
		ImageCopyResized($new,$img,0,0,$sx,$sy,$width,$height,$srcW,$srcH);
	}	
	if($ext=='gif'){
		Imagegif($new,$newfile,90);
	}else if($ext=='jpg'||$ext=='jpeg'){
		Imagejpeg($new,$newfile,90);
	}else if($ext=='png'){
		imagesavealpha($new, true);
		Imagepng($new,$newfile);
	}
	ImageDestroy($new);
	/* */
	$newfile=get_16x9($file);
	$width=240;
	$height=135;
	
	$srcW=$data[0];
	$srcH=$data[1];
	
	if($srcW/$srcH>16/9){
		$_x=$srcH*16/9;
		$sx=round(($srcW-$_x)/2);
		$sy=0;
		$srcW=round($srcH*16/9);
	}elseif($srcW/$srcH<16/9){
		$_y=$srcW*9/16;
		$sx=0;
		$sy=round(($srcH-$_y)/2);
		$srcH=round($srcW*9/16);
	}else{
		$sx=0;
		$sy=0;
	}
	
	if(function_exists('imagecreatetruecolor')){
		$new=imagecreatetruecolor($width,$height);
		if($ext=='png'){
		$alpha = imagecolorallocatealpha($new, 0, 0, 0, 127);
		imagefill($new, 0, 0, $alpha);
		}
		ImageCopyResampled($new,$img,0,0,$sx,$sy,$width,$height,$srcW,$srcH);
	}else{
		$new=imagecreate($width,$height);
		ImageCopyResized($new,$img,0,0,$sx,$sy,$width,$height,$srcW,$srcH);
	}
	if($ext=='gif'){
		Imagegif($new,$newfile,90);
	}else if($ext=='jpg'||$ext=='jpeg'){
		Imagejpeg($new,$newfile,90);
	}else if($ext=='png'){
		imagesavealpha($new, true);
		Imagepng($new,$newfile);
	}
	ImageDestroy($new);
	ImageDestroy($img);
	return;
}
function get_4x4($filename){
	return preg_replace("/(\.[\w]+)$/i",'_4x4\\1',$filename);
}
function get_4x3($filename){
	return preg_replace("/(\.[\w]+)$/i",'_4x3\\1',$filename);
}
function get_3x2($filename){
	return preg_replace("/(\.[\w]+)$/i",'_3x2\\1',$filename);
}
function get_2x3($filename){
	return preg_replace("/(\.[\w]+)$/i",'_2x3\\1',$filename);
}
function get_16x9($filename){
	return preg_replace("/(\.[\w]+)$/i",'_16x9\\1',$filename);
}
function upload_del($filename){
	if(!preg_match('/\d{4}\/\d{2}\/[A-Za-z0-9\.]+/isU',$filename))
		return;
	file_del(AYA_ROOT.'upload/'.$filename);
	file_del(AYA_ROOT.'upload/'.get_4x4($filename));
	file_del(AYA_ROOT.'upload/'.get_4x3($filename));
	file_del(AYA_ROOT.'upload/'.get_3x2($filename));
	file_del(AYA_ROOT.'upload/'.get_2x3($filename));
	file_del(AYA_ROOT.'upload/'.get_16x9($filename));
}
function upload(){
	return include AYA_ROOT.'include/uploadifive/uploadifive.php';
}
function set_upload($inputname,$url,$is_pic=false,$file=''){
	$filebox='';
	$thumb='';
	
	if(!empty($file)){
		$thumb='<div style="height:102px; "> <img data-src="holder.js/50%x180" style="height:100px" src="'.AYA_URL.'aya/upload/'.$file.'" alt=""></div>';
		$filebox.='<div style="height:135px; padding: 0 10px 0 0;float:left;min-width:50px;"><input name="'.$inputname.'" type="hidden" value="'.$file.'" />'.$thumb.'<button type="button" class="close" onclick="$(this).parent().remove()">×</button></div>';
	}
	
	$filebox_id=random();
	$queue_id=random();
	$upload_id=random();
	
	$html='
	<div id="'.$filebox_id.'">'.$filebox.'</div>
    <div style="clear: both"></div>
	<div id="'.$queue_id.'"></div>
	<input id="'.$upload_id.'" name="" type="file" multiple="true">
	';
	
	$js="
			$('#".$upload_id."').uploadifive({
				'buttonText'    : '".l('点击上传')."',
				'auto'             : true,
				 'removeCompleted' : true,
				'formData'         : {
				                     },";
	if($is_pic)
		$js.="'fileType'     : [\"image\/jpeg\",\"image\/png\",\"image\/jpg\",\"image\/gif\"],";
	$js.="
				'multi'  : false,
				'queueID'          : '".$queue_id."',
				'uploadScript'     : '".$url."',
				'onUpload'         : function(){
					$(\"#pic\").val(\"\");
					if($(\"#".$queue_id."\").children().length>1)
	$('#".$queue_id." div').eq(0).remove();
				},
				'onUploadComplete' : function(file, data) {


						if(data.indexOf(\".\") <0) {
						alert(data);
						return;
						}
			var extStart=file.name.lastIndexOf(\".\");
						var thumb='';
        var ext=file.name.substring(extStart,file.name.length).toUpperCase();

        if(ext==\".JPG\" || ext==\".JPEG\" || ext==\".GIF\" || ext==\".PNG\"){
        thumb='<div style=\"height:102px; \"> <img data-src=\"holder.js/50%x180\"  style=\"height:100px\" src=\"".AYA_URL."aya/upload/~tmp/'+data+'\" alt=\"...\"></div>';
}else
        		thumb=file.name;
						$('#".$filebox_id."').html('<div style=\"min-width:50px; padding: 0 10px 0 0;float:left;\" class=\"c'+data.replace(\".\",\"\")+'\"><input name=\"".$inputname."\" type=\"hidden\" value=\"~tmp/'+data+'\" />'+thumb+'<button type=\"button\" class=\"close\" onclick=\"$(\'.c'+data.replace(\".\",\"\")+'\').remove()\">×</button></div>');

			}
			});
		";
	
	$js='<script type="text/javascript">
		$(function() {
			'.$js.'
			});
	</script> ';
	
	return $html.$js;
}
function set_uploads($inputname,$url,$is_pic=false,$file=''){
	return set_field_upload($inputname,$url,$is_pic,$file);
}
function set_field_upload($inputname,$url,$is_pic=false,$files=''){
	$filebox='';
	
	$files=explode(',',$files);
	
	foreach($files as $k=>$file){
		if(empty($file))
			continue;
		$f=explode('|',$file);
		$thumb='';
		$ext=strtolower(str_replace('.','',strrchr($f[0],'.')));
		if(in_array($ext,array (
				'jpg',
				'jpge',
				'gif',
				'png' 
		)))
			$thumb='<div style="height:102px; "> <img data-src="holder.js/50%x180" style="height:100px" src="'.AYA_URL.'aya/upload/'.$f[0].'" alt=""></div>';
		
		$filebox.='<div style="height:135px; padding: 0 10px 0 0;float:left;min-width:50px;" class="c'.$k.'"><input name="'.$inputname.'[0][]" type="hidden" value="'.$f[0].'" />'.$thumb.'<input name="'.$inputname.'[1][]" type="text" value="'.$f[1].'" style="width:135px"/><button type="button" class="close" onclick="$(\'.c'.$k.'\').remove()">×</button></div>';
	}
	
	$filebox_id=random();
	$queue_id=random();
	$upload_id=random();
	
	$html='
	<div id="'.$filebox_id.'">'.$filebox.'</div>
    <div style="clear: both"></div>
	<div id="'.$queue_id.'"></div>
	<input id="'.$upload_id.'" name="" type="file" multiple="true">
	';
	
	$js="
			$('#".$upload_id."').uploadifive({
				'buttonText'    : '".l('点击上传')."',
				'auto'             : true,
				'removeCompleted' : true,
				'formData'         : {
				                     },";
	if($is_pic)
		$js.="'fileType'     : [\"image\/jpeg\",\"image\/png\",\"image\/jpg\",\"image\/gif\"],";
	$js.="
				'multi'  : true,
				'queueID'          : '".$queue_id."',
				'uploadScript'     : '".$url."',
				'onUpload'         : function(){
					$(\"#pic\").val(\"\");
					if($(\"#".$queue_id."\").children().length>1)
	$('#".$queue_id." div').eq(0).remove();
				},
				'onUploadComplete' : function(file, data) {
						if(data.indexOf(\".\") <0) {
						alert(data);
						return;
						}
						var extStart=file.name.lastIndexOf(\".\");
						var thumb='';
        var ext=file.name.substring(extStart,file.name.length).toUpperCase();

        if(ext==\".JPG\" || ext==\".JPEG\" || ext==\".GIF\" || ext==\".PNG\"){
        thumb='<div style=\"height:102px; \"> <img data-src=\"holder.js/50%x180\"  style=\"height:100px\" src=\"".AYA_URL."aya/upload/~tmp/'+data+'\" alt=\"...\"></div>';
}else
        		thumb=file.name;
						$('#".$filebox_id."').append('<div style=\"min-width:50px; padding: 0 10px 0 0;float:left;\" class=\"c'+data.replace(\".\",\"\")+'\"><input name=\"".$inputname."[0][]\" type=\"hidden\" value=\"~tmp/'+data+'\" />'+thumb+'<input style=\"width:135px\" name=\"".$inputname."[1][]\" type=\"text\" value=\"\" /><button type=\"button\" class=\"close\" onclick=\"$(\'.c'+data.replace(\".\",\"\")+'\').remove()\">×</button></div>');

			}
			});
		";
	
	$js='<script type="text/javascript">
		$(function() {
			'.$js.'
			});
	</script> ';
	
	return $html.$js;
}
function strlens($str,$min,$max,$encoding='UTF-8'){
	$t=mb_strlen($str,$encoding);
	if($t>$max)
		return false;
	if($t<$min)
		return false;
	return true;
}
function arr2input($arr,$d=',',$g="\n"){
	if(is_string($arr))
		@$arr=unserialize($arr);
	if(!is_array($arr))
		return '';
	$_arr=array ();
	foreach($arr as $k=>$v){
		if(is_array($v))
			return '';
		$_arr[]=$d===''?$v:($k.$d.$v);
	}
	return implode($g,$_arr);
}
function input2arr($str,$d=',',$g="\n"){
	$str=trim($str,$g);
	$_arr=explode($g,$str);
	if($d==='')
		return $_arr;
	
	$arr=array ();
	
	foreach($_arr as $k=>$v){
		
		$_=explode($d,$v);
		if(count($_)>1)
			$arr[$_[0]]=$_[1];
		else
			$arr[]=$v;
	}
	
	return $arr;
}
function set_editor($contentid,$content,$style='',$config=array()){
	$pf=random();
	$conid=$contentid.'_script';
	$editorid=$pf;
	
	$html='<script type="text/plain" id="'.$conid.'" style="'.$style.'">'.$content.'</script>
			<input id="'.$contentid.'" name="posts['.$contentid.']" type="hidden" value="" />';
	
	isset($config['lang']) or $config['lang']="'".AYA_LANG."'";
	
	$js='';
	
	foreach($config as $k=>$v){
		if($v===false)
			$v='false';
		elseif($v===true)
			$v='true';
		
		$js.=$k.':'.$v.',
			';
	}
	
	$html.='
			<script type="text/javascript">
			var '.$editorid.'=UE.getEditor(\''.$conid.'\', {
		'.$js.'
	});
	</script>
				';
	return $html;
}
function set_field_editor($contentid,$content,$style='',$config=array()){
	$pf=random();
	$conid=$contentid.'_script';
	$editorid=$pf;
	
	$html='<script type="text/plain" id="'.$conid.'" style="'.$style.'">'.$content.'</script>
			<input id="'.$contentid.'" name="field_posts['.$contentid.']" type="hidden" value="" />';
	
	isset($config['lang']) or $config['lang']="'".AYA_LANG."'";
	
	$js='';
	
	foreach($config as $k=>$v){
		if($v===false)
			$v='false';
		elseif($v===true)
			$v='true';
		
		$js.=$k.':'.$v.',
			';
	}
	
	$html.='
			<script type="text/javascript">
			var '.$editorid.'=UE.getEditor(\''.$conid.'\', {
		'.$js.'
	});
	</script>
				';
	return $html;
}
function set_code_editor($contentid,$content,$style='',$config=array()){

}
function is_hot($sum){
	global $CFG;
	return $sum>=(int)$CFG['aahot'];
}
function is_new($time){
	global $CFG;
	return (TIME-$time)<(int)$CFG['aanew'];
}
function pages($url,$pg_c,$pg_m,$pg_d=20,$pg_l=10,$classname='pull-right'){
	if($pg_m<1)
		return;
	$pages=new page($pg_d,$pg_m,$pg_c,$pg_l,$url,true,false,$classname);
	return $pages->pages;
}
function sql_update($arr){
	$a=array ();
	foreach($arr as $k=>$v){
		$a[]='`'.$k.'`=\''.addslashes($v).'\'';
	}
	return implode(',',$a);
}
function sql_insert($arr){
	$karr=$varr=$varr2=array ();
	foreach($arr as $key=>$val){
		if(is_array($val)){
			foreach($val as $k=>$v){
				empty($karr)&&$karr=array_keys($val);
				$varr[$key][]='\''.addslashes($v).'\'';
			}
		}else{
			$karr[]=$key;
			$varr[0][]='\''.addslashes($val).'\'';
		}
	}
	
	foreach($karr as $k=>$v){
		$karr[$k]='`'.$v.'`';
	}
	
	$kstr=' ('.implode(',',$karr).')';
	foreach($varr as $v){
		$varr2[]='('.implode(',',$v).')';
	}
	return $kstr.' values'.implode(',',$varr2);
}
function str_is_int($str){
	return preg_match("/^[0-9]+$/",$str);
}

function __autoload($class_name){
	if(is_file($file=AYA_ROOT.'module/'.$class_name.'/class.inc.php')){
		require_once ($file);
	}elseif(is_file($file=AYA_ROOT.'include/'.$class_name.'.class.php'))
		require_once ($file);
}
function amsg($msg,$class='',$js=''){
	if(substr($js,0,7)=='http://')
		$js='location="'.$js.'";';
	
	$head=substr($msg,0,3);
	
	switch(substr($msg,0,3)){
		case '301':
			@header("HTTP/1.1 301 Moved Permanently");
			$_message=l('页面已移动');
		case '403':
			@header("HTTP/1.1 403 Forbidden");
			$_message=l('无访问权限');
		case '404':
			@header("HTTP/1.1 404 Not Found");
			$_message=l('页面不存在');
			
			$_msg=ltrim($msg,',0134');
			empty($_msg) or $_message=$_msg;
			unset($_msg);
			
			$_js=$js;
			$_class='warning';
			
			if(IN_AJAX){
				
				if(substr($_js,0,9)=='location='){
					
					if(!empty($_message)){
						
						setcookie("amsg",$_message,0,'/');
						setcookie("aclass",$_class,0,'/');
					}
					if(IN_MODAL){
						echo '<script type="text/javascript">';
						echo '$(".modal-header .close").trigger("click");';
					}
					echo $_js;
					if(IN_MODAL){
						echo '</script>';
					}
				}else{
					if(IN_MODAL){
						echo '<script type="text/javascript">';
						echo '$(".modal-header .close").trigger("click");';
					}
					if(!empty($_message))
						echo '$.messager.show("',html($_message).'", {time: 3000, type:"'.$_class.'",placement: "top"});';
					if(!empty($_js))
						echo $_js;
					if(IN_MODAL){
						echo '</script>';
					}
				}
			}else{
				extract($GLOBALS,EXTR_SKIP);
				include template('message');
			}
			break;
		
		default:
			$_message=$msg;
			$_js=$js;
			$_class='';
			switch($class){
				case 's':
					$_class='success';
					
					defined('IN_ADMIN')&&upcache();
					
					break;
				case 'w':
					$_class='warning';
					break;
				case 'i':
					$_class='info';
					break;
				case 'd':
					$_class='danger';
					break;
				case 'l':
					$_class='loading';
					break;
				default:
					$_class='info';
			}
			
			if(IN_AJAX || IN_MODAL){

				if(substr($_js,0,9)=='location='){
					
					if(!empty($_message)){
						setcookie("amsg",$_message,0,'/');
						setcookie("aclass",$_class,0,'/');
					}
					if(IN_MODAL){
						echo '<script type="text/javascript">';
						echo '$(".modal-header .close").trigger("click");';
					}
					echo $_js;
					if(IN_MODAL){
						echo '</script>';
					}
				}else{
					if(IN_MODAL){
						echo '<script type="text/javascript">';
						echo '$(".modal-header .close").trigger("click");';
					}
					if(!empty($_message))
						echo '$.messager.show("',html($_message).'", {time: 3000, type:"'.$_class.'",placement: "top"});';
					if(!empty($_js))
						echo $_js;
					if(IN_MODAL){
						echo '</script>';
					}
				}
			}else{
				extract($GLOBALS,EXTR_SKIP);
				include template('message');
			}
	}
	exit();
}
function random($length=4,$chars='abcdefghijklmnopqrstuvwxyz'){
	$hash='';
	$max=strlen($chars)-1;
	for($i=0;$i<$length;$i++){
		$hash.=$chars[mt_rand(0,$max)];
	}
	return $hash;
}
function aaddslashes($string){
	if(!is_array($string))
		return addslashes($string);
	foreach($string as $key=>$val)
		$string[$key]=aaddslashes($val);
	return $string;
}
function astripslashes($string){
	if(!is_array($string))
		return stripslashes($string);
	foreach($string as $key=>$val)
		$string[$key]=astripslashes($val);
	return $string;
}
function htmls(&$array){
	trims($array);
	
	foreach($array as $key=>$val){
		if(is_array($val))
			$array[$key]=htmls($val);
		else
			$array[$key]=html($val);
	}
	return $array;
}
function trims(&$array){
	foreach($array as $key=>$val){
		if(is_array($val))
			$array[$key]=trims($val);
		else
			$array[$key]=trim($val);
	}
	return $array;
}
/*
 * 检查变量名是否符合标准
 */
function check_name($name){
	return preg_match("/^[a-zA-Z]{1}[a-zA-Z0-9_\-]{0,}[a-zA-Z0-9]{0,}$/",$name);
}
function check_filename($name){
	return check_name(filename($name));
}
function set_cookie($var,$value='',$time=0){
	global $CFG;
	$time=$time>0?$time:(empty($value)?TIME-3600:0);
	$var=$CFG['cookie_pre'].$var;
	return setcookie($var,$value,$time,'/');
}
function get_cookie($var){
	global $CFG;
	$var=$CFG['cookie_pre'].$var;
	return isset($_COOKIE[$var])?$_COOKIE[$var]:'';
}
function encrypt($txt,$key=''){
	$key or $key=AYA_KEY;
	$rnd=random(32);
	$len=strlen($txt);
	$ctr=0;
	$str='';
	for($i=0;$i<$len;$i++){
		$ctr=$ctr==32?0:$ctr;
		$str.=$rnd[$ctr].($txt[$i]^$rnd[$ctr++]);
	}
	return str_replace('=','',base64_encode(kecrypt($str,$key)));
}
function decrypt($txt,$key=''){
	$key or $key=AYA_KEY;
	$txt=kecrypt(base64_decode($txt),$key);
	$len=strlen($txt);
	$str='';
	for($i=0;$i<$len;$i++){
		$tmp=$txt[$i];
		$str.=$txt[++$i]^$tmp;
	}
	return $str;
}
function kecrypt($txt,$key){
	$key=md5($key);
	$len=strlen($txt);
	$ctr=0;
	$str='';
	for($i=0;$i<$len;$i++){
		$ctr=$ctr==32?0:$ctr;
		$str.=$txt[$i]^$key[$ctr++];
	}
	return $str;
}
function html($string){
	return htmlspecialchars($string);
}
function dhtml($string){
	return htmlspecialchars_decode($string);
}
function strip_nr($string,$js=false){
	$string=str_replace(array (
			chr(13),
			chr(10),
			"\n",
			"\r",
			"\t",
			'  ' 
	),array (
			'',
			'',
			'',
			'',
			'',
			'' 
	),$string);
	if($js)
		$string=str_replace("'","\'",$string);
	return $string;
}
function tag($tagname,$dir=''){
	if(defined('IN_ADMIN')){
		$dir==''&&$dir='admin';
		return AYA_ROOT.'module/'.$dir.'/admin/template/tag/'.$tagname.'.php';
	}else
		return AYA_TROOT.'tag/'.$tagname.'.php';
}
function diy($__diyname,$__par=''){
	extract($GLOBALS, EXTR_SKIP);
	eval('$__evv ="'.$__par.'";');
	
	parse_str($__evv);
	if(strlen($box_cache)<1)
		$box_cache=1;
	
	if(!is_file($__file=AYA_TROOT.'diy/'.$__diyname.'.php')){
		return;
	}
	
	$__box_class=!empty($box_class);
	
	$__box_head=$__box_class?('<div class="'.$box_class.'">'):'';
	$__box_foot=$__box_class?'</div>':'';
	
	$cachefile=AYA_ROOT.'cache/diy/'.md5($__file.'+'.$__evv).'.php';
	if(DEBUG||!$box_cache){
		echo $__box_head;
		$re=include $__file;
		if(!is_int($re))
			echo $re;
		echo $__box_foot;
	}else if(!is_file($cachefile) or (TIME-intval(substr(file_get($cachefile),0,10)))>120){
		ob_start();
		echo $__box_head;
		$re=include $__file;
		if(!is_int($re))
			echo $re;
		echo $__box_foot;
		$html=ob_get_contents();
		ob_end_clean();
		
		file_put($cachefile,TIME.$html);
		echo $html;
	}else{
		echo substr(file_get($cachefile),10);
	}
	
}

function template($action,$c_module='',$c_dirname=''){
	global $CFG;
	
	if(defined('IN_ADMIN')){
		
		if($c_module==''){
			$to=AYA_CACHE.'template/admin/'.$action.'.php';
			if(!is_file($from=AYA_ROOT.'module/admin/admin/template/'.$action.'.html'))
				$from=AYA_ROOT.'module/admin/admin/template/tpl/'.$action.'.html';
		}else{
			$to=AYA_CACHE.'template/admin/'.$c_module.'-'.$action.'.php';
			$from=AYA_ROOT.'module/'.$c_module.'/admin/template/'.$action.'.html';
		}
	}else{
		
		if(IN_DIY==1){
			$diy='diy_1_';
		}elseif(IN_DIY==2){
			$diy='diy_2_';
		}elseif(IN_DIY==3){
			$diy='diy_3_';
		}else 
			$diy='';
		
		if(!$c_module){
			$to=AYA_CACHE.'template/'.$diy.TEMPLATE.'-'.$action.'.php';
			
			if(!is_file($from=AYA_ROOT.'template/'.TEMPLATE.'/'.$action.'.html'))
				$from=AYA_ROOT.'template/'.TEMPLATE.'/tpl/'.$action.'.html';
		}else{
			$to=AYA_CACHE.'template/'.$diy.$c_module.'-'.$c_dirname.'-'.CLIENT.'-'.$action.'.php';
			if(!is_file($from=ROOT.$c_dirname.'/'.CLIENT.'/'.$action.'.html')){
				$from=AYA_ROOT.'template/'.TEMPLATE.'/'.$c_module.'/'.$action.'.html';
			}
		}
		
	}
	
	is_file($from) or exit('模板缺失:'.$from);
	if(!is_file($to)||filemtime($from)>filemtime($to)||DEBUG){
		template_compile($from,$to);
	}
	
	return $to;
}
function cache_read($file,$dir='',$mode=false){
	$file=$dir?AYA_ROOT.'cache/'.$dir.'/'.$file:AYA_ROOT.'cache/'.$file;
	if(!is_file($file))
		return $mode?'':array ();
	return $mode?file_get($file):include $file;
}
function cache_write($file,$string,$dir=''){
	if(is_array($string))
		$string="<?php defined('IN_AYA') or exit('Access Denied'); return ".var_export($string,true)."; ?>";
	$file=$dir?AYA_CACHE.$dir.'/'.$file:AYA_CACHE.$file;
	$strlen=file_put($file,$string);
	return $strlen;
}
function get_user($value,$key='name',$from='itemid'){
	global $db;
	$r=$db->get_one("SELECT `$from` FROM {$db->pre}member WHERE `$key`='$value'");
	return $r[$from];
}
function is_robot(){
	return preg_match("/(spider|bot|crawl|slurp|lycos|robozilla)/i",$_SERVER['HTTP_USER_AGENT']);
}
function is_ip($ip){
	return preg_match("/^([0-9]{1,3}\.){3}[0-9]{1,3}$/",$ip);
}
function is_mobile($mobile){
	return preg_match("/^1[3|4|5|6|7|8|9]{1}[0-9]{9}$/",$mobile);
}
function is_md5($password){
	return preg_match("/^[a-f0-9]{32}$/",$password);
}
function debug(){
	global $db,$debug_starttime;
	$mtime=explode(' ',microtime());
	$s=number_format(($mtime[1]+$mtime[0]-$debug_starttime),3);
	echo 'Processed in '.$s.' second(s), '.$db->querynum.' queries';
	if(function_exists('memory_get_usage'))
		echo ', Memory '.round(memory_get_usage()/1024/1024,2).' M';
}
function hook_exists($action){
	global $_HOOKS;
	return is_array($_HOOKS[$action]);
}
function do_apply($action,$type='array'){
	global $_HOOKS;
	
	$arr=array ();
	if(hook_exists($action)){
		
		ksort($_HOOKS[$action]);
		foreach($_HOOKS[$action] as $funcs){
			
			foreach($funcs as $func){
				if(!is_string($func[0])){
					$arr[]=$func[0];
				}else if(substr($func[0],0,5)=='code:'){
					$func[0]=substr($func[0],5);
					$func=create_function('',$func[0]);
					$arr[]=$func();
				}elseif(substr($func[0],-2)=='()'){
					$func[0]=substr($func[0],0,-2);
					$argarr_1=is_array($func[1])?$func[1]:array ();
					$argarr_2=(func_num_args()>2)?array_splice(func_get_args(),2):array ();
					$argarr=$argarr_1+$argarr_2;
					$arg=array ();
					while(list($key,)=@each($argarr)){
						$arg[]='$argarr['.$key.']';
					}
					eval('$_t='.$func[0].'('.implode(',',$arg).');empty($_t) or $arr[]=$_t;');
				}else{
					$arr[]=$func[0];
				}
			}
		}
	}
	
	switch($type){
		case 'string':
			return implode('',$arr);
			break;
		case 'array+':
			$_arr=array ();
			for($i=0;$i<count($arr);$_arr+=$arr[$i],$i++)
				;
			return $_arr;
			break;
		case 'array_merge':
		case 'array_m':
			$_arr=array ();
			for($i=0;$i<count($arr);$_arr=array_merge($_arr,$arr[$i]),$i++)
				;
			return $_arr;
			break;
		case 'array':
			return $arr;
			break;
		default:
			return;
	}
}
function action_exists($action){
	global $_HOOKS;
	return is_array($_HOOKS[$action])?true:false;
}
function apply($action,$func,$level=10){
	global $_HOOKS;
	
	if($level===true){
		unset($_HOOKS[$action]);
		$level=0;
	}
	/* php 5.4 */
	$arr=func_get_args();
	$args=(func_num_args()>3)?array_splice($arr,3):null;
	$_HOOKS[$action][$level][]=array (
			$func,
			$args 
	);
}
function upcache(){
	global $db;
	$dirs=array("cache/*.php","cache/template/*.php","cache/template/admin/*.php","cache/diy/*.php","upload/~tmp/*.*");
	foreach ($dirs as $dir){
		$files=glob(AYA_ROOT.$dir);
		if(is_array($files)){
			foreach ($files as $filename) {
				file_del($filename);
			}
		}

		file_put(dirname(AYA_ROOT.$dir).'/index.html','');
	}

	$arr=include AYA_ROOT.'config.inc.php';
	$lang=explode(',',$arr['lang']);
	if($item=$db->get_one("SELECT * FROM {$db->pre}channel WHERE language='{$lang[0]}' ORDER by listorder desc,channelid asc")){
		$con="<?php return '".$item['dirname']."';";
		file_put(AYA_ROOT.'cache/home-dirname.php',$con);
	}
}
function &get_val($key){
	return $GLOBALS['_G'][$key];
}
function set_val($key,$val){
	$GLOBALS['_G'][$key]=$val;
}
function get_aya_dir(){
	$rootPath=str_replace("\\",'/',$_SERVER['DOCUMENT_ROOT']);
	$arr=explode(rtrim($rootPath,'/'),rtrim(ROOT,'/'));
	return isset($arr[1])?$arr[1]:'';
}
?>