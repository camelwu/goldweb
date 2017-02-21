<?php


/**
 * 网站初始化
* $Author: shiyanqiu $
 * $Date: 2009/06/20 06:16:26 $
*/
set_time_limit(0);
if (!isset ($_SESSION)) {
	session_start();
}
header('Cache-control: private');
header('Content-type: text/html; charset=utf-8');

if (__FILE__ == '') {
	die('Fatal error code: 0');
}

define('ROOT_PATH', str_replace('includes/init.php', '', str_replace('\\', '/', __FILE__)));

/* 初始化设 */

ini_set('memory_limit', '-1');
//@ini_set('memory_limit',          '100M');
@ ini_set('session.cache_expire', 180);
@ ini_set('session.use_trans_sid', 0);
@ ini_set('session.use_cookies', 1);
@ ini_set('session.auto_start', 0);
@ ini_set('display_errors', 1);

ob_start();

if (DIRECTORY_SEPARATOR == '\\') {
	@ ini_set('include_path', '.;' . ROOT_PATH);
} else {
	@ ini_set('include_path', '.:' . ROOT_PATH);
}
set_include_path(get_include_path() . PATH_SEPARATOR . ROOT_PATH . 'includes/');
//是否开启调试模式
if (defined('DEBUG_MODE') == false) {
	define('DEBUG_MODE', 0);
}
if ((DEBUG_MODE & 1) == 1) {
	error_reporting(E_ALL);
} else {
	error_reporting(E_ALL ^ E_NOTICE);
}
/* 初始化数据库 */
require_once (ROOT_PATH . 'includes/config.php');
/* 加载库类 */
require_once (ROOT_PATH . 'includes/cls_mysql.php');
/* 调用数据库 */
$db = new cls_mysql($db_host_update, $db_host_select, $db_user_update, $db_user_select, $db_pass_update, $db_pass_select, $db_name, 'utf8', 0, 1);
$dberrno = $db->errno();
if (!empty ($dberrno)) {
	$log->errorlog("MYSQL", $db->error(), 0);
	die("错误({$dberrno}):" . $db->error());
}
/* 常用函数 */
require_once (ROOT_PATH . 'includes/lib_common.php');
/* 自定义函数 */
require_once (ROOT_PATH . 'includes/func_class.php');
require_once (ROOT_PATH . 'includes/lib_class.php');
/***图片服务器**/
$webconfig = $db->fetch_array($db->query("select * from " . DBFIX . "config"));
$picserver = $webconfig['picserver']; //图片服务器
$uploadir = $webconfig['uploadir']; //图片目录
/* 初始化Smarty */
startSmarty();
/* 初始化常量 */
$smarty->assign('Config', $Config);

if (!isset ($clear)) {
	//判断MEMCACHE
	if (MEMCACHE_SWITCH == 1 && !isset ($memcache)) {
		include_once ("memcached-client.php");
		$memcache = new memcached(array (
			'servers' => array (
				"$memcache_host : $memcache_port"
			),
			'debug' => false,
			'compress_threshold' => 10240,
			'persistant' => true
		));
	}
}
$timezone = "Asia/Shanghai";
if (PHP_VERSION >= '5.1' && isset ($timezone)) {
	date_default_timezone_set($timezone);
}
$now = gmtime();
$time = $now +3600 * 24 * 365;
$seconds = $now -86400 * 30;
ob_clean();
?>