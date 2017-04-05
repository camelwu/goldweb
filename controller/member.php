<?php
/*
 * 用户中心
 *
 * 处理用户登录，注册，用户中心
 *
*/

switch ($action) {
	case 'login':
	if($_SERVER['REQUEST_METHOD']=="POST"&&isset($_POST['email'])){
		if ($_POST['code']!=$_SESSION['num'] || empty($_SESSION['num'])){
				print "<script language=javascript>window.alert('验证码错误!');location.href='".$_SERVER['HTTP_REFERER']."';</script>";
		}else{
			if (isemail($_POST["email"])&&!empty($_POST["password"])) {
				$email = $_POST["email"];
				$password = md5($_POST["password"]);
				$query = "SELECT * FROM cg_client WHERE email = '$email'";
				$data = $db->getOneInfo($query);
				if (!empty($data)){
					if ($data['password'] == $password) {
						$_SESSION["uid"] = $data['id'];
						$_SESSION["email"] = $data['email'];
						$_SESSION["user"] = $data['username'];
						$_SESSION["names"] = $data['name'];
						$_SESSION["tel"] = $data['tel'];
						$_SESSION["birth"] = $data['birthday'];
						$_SESSION["idtype"] = $data['idtype'];
						$_SESSION["idnumber"] = $data['idnumber'];
						vheader("/member/center");
					} else {
						print "<script language=javascript>window.alert('密码错误！');location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
					}
				} else {
					print "该邮箱用户不存在，请核实！";
				}
			}else{
				print"信息输入不完全，请核实！";
			}
		}
	}else{
		$smarty->display(VIEWPATH . 'login.html',$cache_id);
	}
		break;
	case 'registered':
	$smarty->display(VIEWPATH . 'registered.html',$cache_id);
	break;
	default:
//用户中心，验证登录
if (!isset ($_COOKIE["uid"])) {
	vheader("/member/login");
}
$uid = $_COOKIE["uid"];

//基本资料
$user = array ();
$user = $db->getOneInfo("select * from cg_client where uid=" . $uid);
$smarty->assign('user', $user);
$smarty->assign('sexs', array (
	"男",
	"女"
));
$smarty->assign('idtypes', array (
	"身份证",
	"护照",
	"港澳通行证"
));
//旅行袋

//订单
$perpage = 6;
$start = ($page -1) * $perpage;
$sqlfrom = "from cg_product_order";
$sqladd = " where userid=" . $uid;
if ($match)
	//$sqldataid = ' and orderid=' . $orderid;
	$orderbysql = ' order by id desc';
$limitsql = " limit $start,$perpage";
$sql = "select * " . $sqlfrom . $sqladd . $sqldataid . $orderbysql . $limitsql;
$totalnum = $db->result($db->query("select count(*) " . $sqlfrom . $sqladd . $sqldataid), 0); //总数;
$query = $db->query($sql);
while ($value = $db->fetch_array($query)) {
	$orders[] = $value;
}
$pagecount = ceil($totalnum / $perpage);
//$totalnum,$pagecount,$nowpage,$url,pagenum,$css
$multipage = pagecute($totalnum, $pagecount, $page, $enname, $perpage, 'pb_on');
$smarty->assign('multipage', $multipage);
$smarty->assign('orders', $orders);
$smarty->assign('totalnum', $totalnum);
//联系人表
$sqlstr = "select * from cg_client where uid=" . $uid;
$query = $db->query($sqlstr);
while ($val = $db->fetch_array($query)) {
	$con[] = $val;
}
$smarty->assign('contact', $con);
$smarty->assign('cnname', $cname);
$smarty->assign('enname', $enname);

$smarty->display(VIEWPATH . 'MemberCenter.html', $cache_id);
break;
}
?>
