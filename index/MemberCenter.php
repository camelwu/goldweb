<?php


/*
 * Created on 2015-4-26
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
*/
//用户中心，验证登录
if (!isset ($_COOKIE["uid"])) {
	vheader("/login");
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

$smarty->display(V_ROOT . './templates/MemberCenter.html', $cache_id);
?>
