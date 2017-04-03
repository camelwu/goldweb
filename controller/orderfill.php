<?php
//用户中心，验证登录
if (!isset ($_COOKIE["uid"])) {
	vheader("/login");
}
$action = $_POST['action'];
$uid = $_COOKIE["uid"];
$userinfo = login_user($uid);
/*线路明细查询*/
$sqlstr = "select * from cg_product_route_sale t,cg_product_route p where t.id=p.id and t.hid=" . $id;
$info = $db->getOneInfo($sqlstr);

$smarty->assign('info', $info);

$smarty->display(VIEWPATH.'OrderForm_fill.html',$cache_id);
?>
