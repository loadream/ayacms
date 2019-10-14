<?php
@set_magic_quotes_runtime(0);
@ini_set('magic_quotes_sybase',0);
mb_internal_encoding('UTF-8');

$_HOOKS=array ();
$_G=array();

define('DEBUG',0);
define('IN_AYA',1);
define('ERRMSG','Invalid Request');
define('AYA_ROOT',str_replace("\\",'/',dirname(__FILE__)).'/');
define('AYA_CACHE',AYA_ROOT.'cache/');
define('ROOT',dirname(AYA_ROOT).'/');
define('TIME',time());
@error_reporting(E_ALL^E_NOTICE);
DEBUG &&
clearstatcache();

if(isset($_SERVER['HTTP_X_REWRITE_URL'])){
	$_SERVER['REQUEST_URI']=$_SERVER['HTTP_X_REWRITE_URL'];
}
if(isset($_REQUEST['GLOBALS'])||isset($_FILES['GLOBALS']))
	exit('Request Denied');
	
require AYA_ROOT.'include/global.func.php';
require AYA_ROOT.'include/intrinsic.func.php';
require AYA_ROOT.'include/cache.func.php';
require AYA_ROOT.'include/file.func.php';
require AYA_ROOT.'include/field.func.php';
require AYA_ROOT.'include/template.func.php';
require AYA_ROOT.'include/db_mysql.class.php';

timer_start();

if(get_magic_quotes_gpc()){
	$_POST=astripslashes($_POST);
	$_GET=astripslashes($_GET);
	$_COOKIE=astripslashes($_COOKIE);
}

$CFG=include AYA_ROOT.'config.inc.php';
define('TEMPLATE',get_template());
define('PF',$CFG['db_pre']);
define('AYA_KEY',$CFG['aya_key']);
define('AYA_URL',$CFG['url']);
define('AYA_DIR',get_aya_dir());
define('AYA_TURL',AYA_URL.'aya/template/'.TEMPLATE.'/');
define('AYA_TROOT',AYA_ROOT.'template/'.TEMPLATE.'/');
define('REWRITE',$CFG['rewrite']);

if(function_exists('date_default_timezone_set'))
	date_default_timezone_set($CFG['timezone']);

require AYA_ROOT.'version.inc.php';

header('Content-Type: text/html; charset=utf-8');

$db_class='db_'.$CFG['database'];
$db=new $db_class();
$db->halt=DEBUG?1:0;
$db->pre=PF;

$db->connect($CFG['db_host'],$CFG['db_user'],$CFG['db_pass'],$CFG['db_name'],$CFG['db_charset'],$CFG['pconnect']);

unset($CFG['db_host'],$CFG['db_name'],$CFG['db_user'],$CFG['db_pass'],$CFG['db_pre'],$db_class);

if(DEBUG or !$CHANNELS=cache_read('channel.php')){
	cache_all();
	$CHANNELS=cache_read('channel.php');
}

define('IN_POST',strtoupper($_SERVER['REQUEST_METHOD'])=='POST');
define('IN_AJAX',isset($_POST['in_ajax']) or isset($_GET['in_ajax']));
define('IN_MODAL',isset($_POST['in_modal']) or isset($_GET['in_modal']));

if(IN_AJAX || IN_MODAL){
	@header("Expires: -1");
	@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0",false);
	@header("Pragma: no-cache");
}

$_userid=0;
$_username=$_pass='';
$_USER=array ();

if($_auth=get_cookie('auth')){
	$_auth=explode("\t",decrypt($_auth));
	$_userid=isset($_auth[0])?intval($_auth[0]):0;
	$_username=isset($_auth[1])?trim($_auth[1]):'';
	$_password=isset($_auth[2])?trim($_auth[2]):'';
	
	if($_userid){
		$_USER=$db->get_one("SELECT * FROM {$db->pre}member WHERE itemid=$_userid");
		if(!$_USER or $_USER['password']!=$_password){
			$_userid=0;
			set_cookie('auth','');
			unset($_USER);
		}
	}
}

$USER=$_userid>0?$_USER:array (
		'itemid'=>0,
		'username'=>'~Guest',
		'groupid'=>0 
);

$_diy=(int)get_cookie('diy');
define('IN_DIY',($USER['groupid']==2 && in_array($_diy, array(1,2,3)))?$_diy:0);

unset($_auth,$_userid,$_username,$_password,$_USER);

$LEVEL=cache_read('channel_level.php');
$ALLLANG=cache_read('alllang.php');
$LANG=explode(',',$CFG['lang']);
$GROUP=explode(',',$CFG['groups']);
$COLOR=$CFG['aacolor'];

$CHANNEL=cache_read('channel-'.$channelid.'.php');
extract($CHANNEL,EXTR_PREFIX_ALL,'c');

define('AYA_LANG',$c_language);

if(is_file($file=AYA_ROOT.'lang/'.AYA_LANG.'.inc.php'))
	
	$L=include $file;
else
	$L=array ();

if($_POST){
	trims($_POST);
	$posts=(array)$_POST['posts'];
	$field_posts=$_POST['field_posts'];
}else{
	$posts=$field_posts=array ();
}

if(is_file($file=AYA_TROOT.'theme/config.inc.php'))
	$T=include $file;
else
	$T=array ();

apply('seo_title',$CFG['title']);
apply('seo_title',$c_name);
apply('seo_keywords',$CFG['keywords']);
apply('seo_keywords',$c_keywords);
apply('seo_description',$CFG['description']);
apply('seo_description',$c_description);

if($c_parentid>0)
	apply('pathnav',array (
			$CHANNELS[$c_parentid]['name'],
			($CHANNELS[$c_parentid]['module']=='anull'?'':AYA_URL).$CHANNELS[$c_parentid]['path']
	));
	apply('pathnav',array (
	$c_name,
	($CHANNELS[$c_channelid]['module']=='anull'?'':AYA_URL).$c_path
	));

	
