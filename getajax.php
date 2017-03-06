<?PHP
include_once ('./common/inc/main.inc.php');
$action = $_GET['action'];
if ('getend' == $action) {
	$enname = $_GET['enname'];
	$end = $_GET['end'];
	$end2 = $_GET['end2'];
	$go_start = $_GET['go_start'];
	$go_days = $_GET['go_days'];
	$go_starttime = $_GET['go_starttime'];
	$go_endtime = $_GET['go_endtime'];
	$go_money = $_GET['go_money'];
	$go_tuijian = $_GET['go_tuijian'];
	$go_sall = $_GET['go_sall'];
	$go_hot = $_GET['go_hot'];
	$echohtml = $sqlwhere = "";
	if ('overseas' == $enname) {
		$sqlwhere .= " and a.classid!=65";
	}else if('touraround' == $enname||'domestic'==$enname){
		$sqlwhere .= " and a.classid=65";
	}else{
		
	}
	//从查询库里做中转
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
	}
	$query = $db->query("SELECT a.id,a.title FROM cg_area a where 1=1 $sqlwhere order by a.region,a.pid");
	//echo("SELECT a.id,a.title FROM cg_area a,cg_area b where a.pid=b.id $sqlwhere order by a.region,a.pid");
	while ($info = $db->fetch_array($query)) {
		$echohtml .= "<span" . ($end2 == $info['id'] ? " class=dga_on" : "") . "><a href=/$enname/$go_start-$end-" . $info['id'] . "-$go_days-$go_starttime-$go_endtime-$go_money-$go_tuijian-$go_sall-$go_hot>" . $info['title'] . '</a></span>';
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