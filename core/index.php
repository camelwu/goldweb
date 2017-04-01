<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//静态
$shtm = array("aboutus", "contactus", "advise", "advertising", "qualifications", "duty", "partner", "sitemap", "insurance", "help", "instructions", "statement", "agreement", "company");
//导航菜单与产品组合：custom，visa，无法组合
$snav = array("visa", "abroad", "domestic", "around", "package", //freetour
"cruises", "custom", "scenic");
//产品
$spro = array("destination", "scenic", "guide", "tours", "visa");
//引入公用文件
include_once (BASEPATH . '/config/config.php');
include_once (BASEPATH . '/config/database.php');
include_once (BASEPATH . '/helpers/tool_helper.php');
include_once (BASEPATH . '/func/main.php');
include_once (BASEPATH . '/func/sels.php');
// 过滤
if (!(get_magic_quotes_gpc())) {
	$_GET = vaddslashes($_GET);
	$_POST = vaddslashes($_POST);
}
// SQL注入
$_GET = escapeStr($_GET);
$_POST = escapeStr($_POST);
//设置字符集
header('Content-Type: text/html; charset=' . $config['charset']);

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
//.htaccess querystring变量作为路由
$url = (empty($_SERVER['HTTP_X_REWRITE_URL']))?$_SERVER['REQUEST_URI']:$_SERVER['HTTP_X_REWRITE_URL'];
$key = explode("/", $url);
$module = $_GET['enname'];
$id = $_GET['id'];
$match = $_GET['match'];
$match = (empty($match)) ? '------' : $match;
$page = isset($_GET['page'])?intval($_GET['page']):1;
/**
 * 基础数据获取完毕，开始处理
 * 根据module参数进行路由设置，除异步请求外都需要先获取数据
 **/
if ($module==='async') {
	include_once (BASEPATH . '/controllers/async.php');
}else{
	//分站地址区分(机构)
	$myurl = $_SERVER['HTTP_HOST'];
	if (!isset($_COOKIE["myurl"])) {
		save_cookie('myurl', $myurl);
	}
	if (!isset($_COOKIE["bid"]) || $_COOKIE["myurl"] != $myurl) {
		$query = $db -> query("select * from cg_branch where myurl='$myurl'");
		$bidinfo = $db -> fetch_array($query);
		$bid = (empty($bidinfo)) ? 0 : $bidinfo['id'];
		//机构ID
		save_cookie('bid', $bid);
	} else {
		$bid = $_COOKIE["bid"];
		$query = $db -> query("select * from cg_branch where id=$bid");
		$bidinfo = $db -> fetch_array($query);
	}
	//根据域名,常量初始化
	init_config();
	//ip定位
	$ip = getIP();
	save_cookie("ip", $ip);
	if (!isset($_COOKIE['province'])) {
		$addr = getCity($ip);
		if(empty($addr['city'])){
			$province = $addr['province'];
		}else{
			$province = str_replace('市', '', $addr['city']);
		}
		//cookie
		save_cookie("province", $province);
		//首次访问跳转本地机构，查询并跳转，当前屏蔽
		/*$sql = "SELECT myurl FROM cg_area a,cg_branch t where a.id=t.city and a.title like '%" . $province . "%' limit 1";
		$myurl = $db -> result($db -> query($sql), 0);
		if (!empty($myurl) && strpos($myurl, $siteurl) === false) {
			vheader('http://' .$myurl);
		}*/
	} else {
		$province = $_COOKIE["province"];
	}
	//网站模板&所经营地区
	if(empty($bidinfo)){
		$template = "index";
		$mycountry = '金桥主站';
	}else{
		$template = $bidinfo['templates'];
		$mycountry = cg_area_tit($bidinfo['aid']);
		if (empty($mycountry)){
			$mycountry = '金桥分站';
		}
	}
	/**
	 * 基础数据获取完毕，开始处理
	 * 首先判断是否使用smarty模板
	 **/
	if (U_TEMP) {
		//smarty
		startSmarty(B_ENG);
		include_once (V_ROOT . '/controller/index.php');
	} else {
		include_once (BASEPATH .'/controllers/router.php');
	}
}
?>
