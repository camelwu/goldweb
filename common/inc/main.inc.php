<?php
/**
 * @Copyright 2008 be-member Inc
 * 开始获取配置，连接数据库并展示网站前端
 * 
 * Creater: Wusongbo
 * Date: 2008-9-10 
 */
define('V_ROOT', substr(dirname(__FILE__), 0, -11));
//合法应用config文件
define('E_ENG', '1');
//开发模式
define('D_BUG', '1');
D_BUG ? error_reporting(E_ALL&~E_NOTICE) : error_reporting(0);
//包含公用文件
include_once (V_ROOT . '/common/config.php');
include_once (V_ROOT . '/common/inc/tool.func.php');
include_once (V_ROOT . '/common/inc/main.func.php');
include_once (V_ROOT . '/common/inc/sel.func.php');
//过滤
if (!(get_magic_quotes_gpc())) {
	$_GET = vaddslashes($_GET);
	$_POST = vaddslashes($_POST);
}
// SQL注入
$_GET = escapeStr($_GET);
$_POST = escapeStr($_POST);
//设置字符集
if (!empty ($headercharset)) {
	header('Content-Type: text/html; charset=' . $charset);
}

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
if (!isset ($_GET['accessurl'])) {
	$accessurl = $_SERVER['REQUEST_URI'];
} else {
	$accessurl = $_GET['accessurl'];
}

if (!isset ($_GET['referurl'])) {
	$referurl = $_SERVER['HTTP_REFERER'];
} else {
	$referurl = $_GET['referurl'];
}
//当前时间戳
$timezone = "Asia/Shanghai";
date_default_timezone_set($timezone);
$timestamp = time();
//
$siteurl = 'http://' . $_SERVER['HTTP_HOST'].'';
//数据库
dbconnect();
//用户身份ID
$uh_token = getHiddenUIDfromCookie();
//ip定位
$ip = getIP();
if (!isset ($_COOKIE['sp'])) { //first
	$addr = getCity(getIP());
	$province = str_replace('市', '',$addr['city']);
	$sp = $addr['area']?$addr['area']:'';
	//cookie
	save_cookie("sp", $sp);
	save_cookie("province", $province);
	//首次访问跳转本地机构，查询并跳转，当前屏蔽
	$sql = "SELECT myurl FROM cg_area a,cg_branch t where a.id=t.city and a.title like '%" . $province . "%' limit 1";
	$myurl = $db->result($db->query($sql), 0);
	if (!empty ($myurl) && strpos($myurl, $siteurl) === false) {
		//vheader('http://' .$myurl);
	}
} else {
	$sp = $_COOKIE["sp"];
	$province = $_COOKIE["province"];
}
//分站地址区分(机构)
$myurl = $_SERVER['HTTP_HOST'];
if (!isset ($_COOKIE["myurl"])) {
	save_cookie('myurl', $myurl);
}
if (!isset ($_COOKIE["bid"]) || $_COOKIE["myurl"] != $myurl) {
	$query = $db->query("select * from cg_branch where myurl='$myurl'");
	$bidinfo = $db->fetch_array($query);
	$bid = (empty ($bidinfo)) ? 0 : $bidinfo['id'];
	//机构ID
	save_cookie('bid', $bid);
} else {
	$bid = $_COOKIE["bid"];
	$query = $db->query("select * from cg_branch where id=$bid");
	$bidinfo = $db->fetch_array($query);
}
//网站模板
$template = $bidinfo['templates'];
$template = (empty ($template)) ? "index" : $template;
//常量初始化
init_config();
//smarty
startSmarty(true);
//定位IP区域
$smarty->assign('ipfrom', $province);
$smarty->assign('sp', $sp);
//所在地查询（机构）
if('branch'==$template){
	$sqlarea = "SELECT title FROM cg_area where id=".$bidinfo['aid'];
	$mycountry = $db->result($db->query($sqlarea), 0);
 	if(!empty($mycountry))
		$smarty->assign('mycountry', $mycountry);
	else
		$smarty->assign('mycountry', '金桥分站');
}
?>