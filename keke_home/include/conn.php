<?php
# 文件名称:conn.php 2009-11-1 16:03:03
# 网站相关的设置及配置信息
header("Content-type: text/html;charset=utf-8");
//error_reporting(E_ERROR | E_PARSE);	//开发时注释掉，正式运营时，开启
//@ini_set("display_errors", "Off");
@set_time_limit(0);
//抑制报错  PHP接口执行需要时间，一段时间执行不完的话就直接退出
//0就是没有限制，设置最长的时间
//set_time_limit(5);防止占用服务器太多的时间，5秒后强制关闭页面
//版本相关设置，防不同版本而出错
//惠新宸
PHP_VERSION >= '5.1' && date_default_timezone_set('Asia/Shanghai');
//设置时区
//只允许私人存取，不允许代理存
session_cache_limiter('private, must-revalidate'); 
@ini_set('session.auto_start',0); 
//这种方式具有区域局限性，关闭session.start()


if(PHP_VERSION < '4.1.0') {
	//用& 相当于取地址，采用了引用功能
	$_GET         = &$HTTP_GET_VARS;
	$_POST        = &$HTTP_POST_VARS;
	$_COOKIE      = &$HTTP_COOKIE_VARS;
	$_SERVER      = &$HTTP_SERVER_VARS;
	$_ENV         = &$HTTP_ENV_VARS;
	$_FILES       = &$HTTP_POST_FILES;
}

//系统通用函数库 及 防注入等非法操作
//MAGIC_QUOTES_GPC = off = 0，需要手工转义
//在php中define相当于定义常量const
//__FILE__(在哪个文件里)为魔术常量 魔术函数 __DIR__（文件夹）__FUNCTION__(函数) __LINE__执行的程序在哪一行等
define('ROOTPATH', substr(dirname(__FILE__), 0, -7));
define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
isset($_REQUEST['GLOBALS']) && exit('Access Error');
require_once 'function.php';
foreach(array('_COOKIE', '_POST', '_GET') as $_request) {
	foreach($$_request as $_key => $_value) {
		$_key{0} != '_' && $$_key = daddslashes($_value);
	}
	//字符串中访问0号元素，用进行过滤的，因为直接用get或post有安全隐患
	//不是直接用post或get来得到数据，而是用这个foreach来实现
	//用$$来造变量
}

(!MAGIC_QUOTES_GPC) && $_FILES = daddslashes($_FILES);
$REQUEST_URI  = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
//页面压缩构造一个URL
function_exists('ob_gzhandler') ? ob_start('ob_gzhandler') :ob_start();

//用户IP
if($_SERVER['HTTP_X_FORWARDED_FOR']){
	$m_user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} elseif($_SERVER['HTTP_CLIENT_IP']){
	$m_user_ip = $_SERVER['HTTP_CLIENT_IP'];
} else{
	$m_user_ip = $_SERVER['REMOTE_ADDR'];
}
$m_user_ip  = preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/',$m_user_ip) ? $m_user_ip : 'Unknown';


//建立数据库连接
//配置文件大都是ini文件
//这里是解析ini文件数据库文件放到一个文件中
$db_settings = parse_ini_file('dbConfig.php');
@extract($db_settings);
require_once 'mysql.php';
$db =dbmysql::getInstance($con_db_host,$con_db_id,$con_db_pass,$con_db_name);//直接用类名调用
$rs = $db->query('select * from h_member');


$ckeditor_mc_id = '';
$ckeditor_mc_val = '';
$ckeditor_mc_lang = "zh-cn";
$ckeditor_mc_toolbar = "Default";
$ckeditor_mc_height = "400";

define('CC_FARM_CN', 618100);

//操作密码
define('CC_ACT_PWD', 'lalav5_#@!_19999999');

