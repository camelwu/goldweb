<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//包含公用文件
include_once (BASEPATH . '/config/config.php');
include_once (BASEPATH . '/config/database.php');
include_once (BASEPATH . '/helpers/tool_helper.php');
include_once (BASEPATH . '/func/main.php');
include_once (BASEPATH . '/func/sels.php');
//过滤
if (!(get_magic_quotes_gpc())) {
	$_GET = vaddslashes($_GET);
	$_POST = vaddslashes($_POST);
}
// SQL注入
$_GET = escapeStr($_GET);
$_POST = escapeStr($_POST);
//设置字符集
header('Content-Type: text/html; charset=' . $charset);

if ($gzipcompress && function_exists('ob_gzhandler')) {
	ob_start('ob_gzhandler');
} else {
	ob_start();
}
//开始session
session_start();
//urldecode
$_SERVER["REQUEST_URI"] = urldecode($_SERVER["REQUEST_URI"]);
$_SERVER["HTTP_REFERER"] = urldecode($_SERVER["HTTP_REFERER"]);
//终端初始化，以下参数若从$_GET获得，则为日志记录请求(/tac)，参数以get请求为准
if (!isset($_GET['accessurl'])) {
	$accessurl = $_SERVER['REQUEST_URI'];
} else {
	$accessurl = $_GET['accessurl'];
}

if (!isset($_GET['referurl'])) {
	$referurl = $_SERVER['HTTP_REFERER'];
} else {
	$referurl = $_GET['referurl'];
}
//当前时间戳
$timezone = "Asia/Shanghai";
date_default_timezone_set($timezone);
$timestamp = time();
//数据库
dbconnect();
//用户身份ID
$uh_token = getHiddenUIDfromCookie();
//ip定位
$ip = getIP();
if (!isset($_COOKIE['province'])) {//first
	$addr = getCity($ip);
	$province = str_replace('市', '', $addr['city']);
	$sp = $addr['area'] ? $addr['area'] : '';
	//cookie
	save_cookie("sp", $sp);
	save_cookie("province", $province);
	//首次访问跳转本地机构，查询并跳转，当前屏蔽
	/*$sql = "SELECT myurl FROM cg_area a,cg_branch t where a.id=t.city and a.title like '%" . $province . "%' limit 1";
	$myurl = $db -> result($db -> query($sql), 0);
	if (!empty($myurl) && strpos($myurl, $siteurl) === false) {
		vheader('http://' .$myurl);
	}*/
} else {
	$sp = $_COOKIE["sp"];
	$province = $_COOKIE["province"];
}
/**
 * 基础数据获取完毕，开始处理
 * 首先判断是否使用smarty模板
 * */
if (U_TEMP) {
	include_once (V_ROOT . '/controller/index.php');
} else {
	include_once (BASEPATH .'/controllers/mobile.php');
}
?>