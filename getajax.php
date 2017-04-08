<?PHP
/**
 *
 * @package	Code2travel
 * @author	heluo Dev Team
 * @copyright	Copyright (c) 2003 - 2017, 河洛, Inc. (http://www.be-member.com/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://be-member.com
 * @since	Version 4.2.1
 * @filesource
*/
//根目录
define('V_ROOT', dirname(__FILE__));
//合法应用config文件
define('B_ENG', '1');
//debug模式
define('B_BUG', '1');
B_BUG ? error_reporting(E_ALL & ~E_NOTICE) : error_reporting(0);
//模板开启
define('B_TEMP', '1');
//路径设置
$system_path = 'core';
$source_path = 'resource';
$view_path = 'view';
define('BASEPATH', V_ROOT.'/'.$system_path);
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
init_config();
$action = $_GET['action'];
$perpage = 6;
if ('scenic' == $action) {
	$json = json_decode(file_get_contents('php://input'));

	$city2 = $json->go_end2;
	$page = $json->page;
	$page = empty($page)?1:$page;
	$start = ($page -1) * $perpage;
	$go_modle = $json->go_modle;
	$go_type = $json->go_type;
	$go_money = $json->go_price;
	$ob_hit = $json->ob_hit;
	$ob_sall = $json->ob_sall;
	$ob_price = $json->ob_price;
	//$num = selectScenic(3, "", $city2, true, $start, 1);
	$msg = array(
		'num' => selectScenic(3, "", $city2, false, 0, 1),
		'page' => $page,
		'res' => selectScenic(3, "", $city2, true, $start, 6)
	);
	echo json_encode($msg);
} elseif ('tours' == $action) {
	$json = json_decode(file_get_contents('php://input'));
	$end = $json->end;
	$end2 = $json->end2;
	$go_start = $json->go_start;
	$go_days = $json->go_days;
	$go_starttime = $json->go_starttime;
	$go_endtime = $json->go_endtime;
	$go_money = $json->go_money;
	$go_tuijian = $json->go_tuijian;
	$go_sall = $json->go_sall;
	$go_hot = $json->go_hot;

	$city2 = $json->go_end2;
	$page = $json->page;
	$page = empty($page)?1:$page;
	$start = ($page -1) * $perpage;
	$go_modle = $json->go_modle;
	$go_type = $json->go_type;
	$go_money = $json->go_price;
	$ob_hit = $json->ob_hit;
	$ob_sall = $json->ob_sall;
	$ob_price = $json->ob_price;

	$echohtml = $sqlwhere = "";
	if ('overseas' == $enname) {
		$sqlwhere .= " and a.classid!=65";
	}else if('touraround' == $enname||'domestic'==$enname){
		$sqlwhere .= " and a.classid=65";
	}else{

	}
	exit;
	/*if (!empty ($end)) {
		$cmin = cg_search_cmin($end);
		if (!empty ($cmin)) {
			$sqlwhere .= " and FIND_IN_SET(a.id,'{$cmin}') ";
		}
	}*/
	//直接找产品
	if(empty($end)){
		$sql = "select aid2 from cg_product_route where aid2!=0 GROUP BY aid2";
	}else{
		$sql = "select aid2 from cg_product_route where aid2!=0 and cid2=$end GROUP BY aid2";
	}
	$str = '';
	$my = $db->query($sql);
	while ($info = $db->fetch_array($my)) {
		$str .= $info['aid2'].",";
	}
	if(strlen($str)>1) $cmin = substr($str, 0, -1);

	if (!empty ($cmin)) {
		$sqlwhere .= " and FIND_IN_SET(a.id,'{$cmin}') ";
		$query = $db->query("SELECT a.id,a.title FROM cg_area a where 1=1 $sqlwhere order by a.region,a.pid");
		//echo ("SELECT a.id,a.title FROM cg_area a,cg_area b where 1 $sqlwhere order by a.region,a.pid");
		while ($info = $db->fetch_array($query)) {
			$echohtml .= "<span" . ($end2 == $info['id'] ? " class=dga_on" : "") . "><a href=/$enname/$go_start-$end-" . $info['id'] . "-$go_days-$go_starttime-$go_endtime-$go_money-$go_tuijian-$go_sall-$go_hot>" . $info['title'] . '</a></span>';
		}
	}else{
		$echohtml = "<span>暂无此洲的线路</span>";
	}
	echo $echohtml;
}
elseif ('logout' == $action) {
	destroy_cookie();
	$msg = array ();
	$msg['status'] = 0;
	echo json_encode($msg);
}
elseif ('login' == $action) {
	$email = $_GET['email'];
	$password = $_GET['password'];
	$code = $_GET['code'];
	$baseinfo = login_user(0, $email, $password);
	$result = true;
	$msg = array ();
	$msg['status'] = 0;
	if (empty ($baseinfo)) {
		$msg['status'] = 1;
		$msg['msg'] = "用户名或密码错误";
		$result = false;
	}
	if ($result && $code != $_SESSION['num']) {
		$msg['status'] = 1;
		$msg['msg'] = "验证码输入错误";
		$result = false;
	}
	echo json_encode($msg);
}
elseif ('checkemail' == $action) {
	$email = $_GET['email'];
	$username = $_GET['username'];
	$password = $_GET['password'];
	$password2 = $_GET['password2'];
	$code = $_GET['code'];
	$pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
	$result = true;
	$msg = array ();
	$msg['reg_str'] = 0;
	$msg['status'] = 0;
	if (empty ($email)) {
		$msg['status'] = 1;
		$msg['msg'] = "请输入邮箱地址";
		$result = false;
	}
	if ($result) {
		if (!preg_match($pattern, $email)) {
			$msg['status'] = 1;
			$msg['msg'] = "邮箱地址不合法";
			$result = false;
		}
	}
	if ($result) {
		$sql = "SELECT count(*) FROM cg_client WHERE email = '$email'";
		if ($db->result($db->query($sql), 0)) {
			$msg['status'] = 1;
			$msg['msg'] = "邮箱地址已注册";
			$result = false;
		}
	}

	if ($result && empty ($username)) {
		$msg['status'] = 1;
		$msg['msg'] = "请输入用户名";
		$result = false;
	}

	if ($result) {
		$sql = "SELECT count(*) FROM cg_client WHERE username = '$username'";
		if ($db->result($db->query($sql), 0)) {
			$msg['status'] = 1;
			$msg['msg'] = "用户名已占用";
			$result = false;
		}
	}

	if ($result && empty ($password)) {
		$msg['status'] = 1;
		$msg['msg'] = "请输入密码";
		$result = false;
	}

	if ($result) {
		if (ctype_digit($password)) {
			$msg['reg_str'] = 1;
		} else
			if (ctype_alpha($password)) {
				$msg['reg_str'] = 2;
			} else {
				$msg['reg_str'] = 3;
			}
	}

	if ($result && empty ($password2)) {
		$msg['status'] = 1;
		$msg['msg'] = "请输入确认密码";
		$result = false;
	}

	if ($result && $password != $password2) {
		$msg['status'] = 1;
		$msg['msg'] = "两次输入的密码不一致";
		$result = false;
	}

	if ($result && empty ($code)) {
		$msg['status'] = 1;
		$msg['msg'] = "请输入验证码";
		$result = false;
	}

	if ($result && $code != $_SESSION['num']) {
		$msg['status'] = 1;
		$msg['msg'] = "验证码输入错误";
		$result = false;
	}
	if ($result) {
		unset ($_GET['action'], $_GET['password2'], $_GET['code']);
		$_GET['password'] = md5($_GET["password"]);
		$uid = $db->inserttable("cg_client", $_GET, 1);
		if (empty ($uid)) {
			$msg['status'] = 1;
			$msg['msg'] = "用户注册异常，请稍候再试";
			$result = false;
		} else {
			save_cookie('uid', $uid);
			save_cookie('username', $username);
		}
	}
	echo json_encode($msg);
}
?>
