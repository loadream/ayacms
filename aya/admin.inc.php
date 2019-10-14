<?php
@set_magic_quotes_runtime(0);
@ini_set('magic_quotes_sybase',0);
mb_internal_encoding('UTF-8');
$_HOOKS=array ();

define('DEBUG',0);
define('IN_AYA',1);
define('IN_ADMIN',1);
define('ERRMSG','Invalid Request');
define('AYA_ROOT',str_replace("\\",'/',dirname(__FILE__)).'/');
define('AYA_CACHE',AYA_ROOT.'cache/');
define('ROOT',dirname(AYA_ROOT).'/');
define('TIME',time());
@error_reporting(E_ALL^E_NOTICE);
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
require AYA_ROOT.'include/admin.func.php';

timer_start();

if(get_magic_quotes_gpc()){
	$_POST=astripslashes($_POST);
	$_GET=astripslashes($_GET);
	$_COOKIE=astripslashes($_COOKIE);
}

$CFG=include AYA_ROOT.'config.inc.php';

define('PF',$CFG['db_pre']);
define('AYA_KEY',$CFG['aya_key']);
define('AYA_URL',$CFG['url']);
define('AYA_DIR',get_aya_dir());
define('AYA_ADMIN_URL',$CFG['url'].$filename);

define('AYA_TURL',AYA_URL.'aya/module/admin/admin/template/');
define('AYA_TROOT',AYA_ROOT.'module/admin/template/');
define('REWRITE',0);

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
define('IN_MODULE',isset($_POST['in_module']) or isset($_GET['in_module']));

define('ADD_A',$CFG['add_a']);
define('ADD_B',$CFG['add_b']);
define('ADD_C',$CFG['add_c']);

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
		$_USER=$db->get_one("SELECT * FROM {$db->pre}member WHERE groupid=2 && itemid=$_userid");
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

unset($_auth,$_userid,$_username,$_password,$_USER);

$LEVEL=cache_read('channel_level.php');
$ALLLANG=cache_read('alllang.php');
$LANG=explode(',',$CFG['lang']);
$GROUP=explode(',',$CFG['groups']);
$COLOR=$CFG['aacolor'];
if($_lang=get_cookie('admin_lang'))
	$_lang=decrypt($_lang);

empty($_lang)&&$_lang=$LANG[0];

define('AYA_LANG',$_lang);

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

$ADDFIELD=array (
		'text'=>l('单行文本'),
		'textarea'=>l('多行文本'),
		'int'=>l('数字框'),
		'float'=>l('金额'),
		'select'=>l('下拉框'),
		'radio'=>l('单选框'),
		'checkbox'=>l('多选框'),
		'hidden'=>l('隐藏域'),
		'thumb'=>l('缩略图上传'),
		'file'=>l('文件上传'),
		'editor'=>l('富文本编辑器'),
		'date'=>l('日期选择') 
);

$OPENTYPE=array (
		'php',
		'txt',
		'html',
		'htm',
		'js',
		'gif',
		'png',
		'jpg',
		'jpeg',
		'css' 
);

require AYA_ROOT.'module/admin/common.inc.php';

