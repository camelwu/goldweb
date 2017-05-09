<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$perpage = 6;
if ('scenic' == $action) {
	$json = json_decode(file_get_contents('php://input'));
	if($json){
		$city2 = $json->go_end2;
		$go_modle = $json->go_modle;
		$go_type = $json->go_type;
		$go_money = $json->go_price;
		$order = $json->order;
		$orderby = $json->orderby;
		$page = $json->page;
		$page = empty($page)?1:$page;
		$start = ($page -1) * $perpage;

		$msg = array(
			'num' => selectScenic(3, "", $city2, false, 0, 1),
			'page' => $page,
			'res' => selectScenic(3, "", $city2, true, $start, 6, $order, $orderby)
		);
	}else{
		$msg = array(
			'num' => 0,
			'page' => 1,
			'res' => array()
		);
	}
	echo json_encode($msg);
} elseif ('tours' == $action) {
	$json = json_decode(file_get_contents('php://input'));
	if($json){
		$cid = $json->cid;
		$cid2 = $json->cid2;

		$go_start = $json->go_start;
		$end = $json->go_end;
		$go_end2 = $json->go_end2;
		$go_days = $json->go_days;
		$go_starttime = $json->go_starttime;
		$go_endtime = $json->go_endtime;
		$go_money = $json->go_money;
		$order = $json->order;
		$orderby = $json->orderby;

		$page = $json->page;
		$page = empty($page)?1:$page;
		$start = ($page -1) * $perpage;

		$msg = array(
			'num' => selectRoleSale($cid, false, 0, 1, $go_start, $go_end2, $go_days, $go_starttime, $go_endtime, $go_money, '', $order, $orderby),
			'page' => $page,
			'res' => selectRoleSale($cid, true, $start, $perpage, $go_start, $go_end2, $go_days, $go_starttime, $go_endtime, $go_money, '', $order, $orderby)
		);
	}else{
		$msg = array(
			'num' => 0,
			'page' => 1,
			'res' => array()
		);
	}
	echo json_encode($msg);
	exit;
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
} elseif ('logout' == $action) {
	destroy_cookie();
	$msg = array ();
	$msg['status'] = 0;
	echo json_encode($msg);
} elseif ('login' == $action) {
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
} elseif ('checkemail' == $action) {
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
