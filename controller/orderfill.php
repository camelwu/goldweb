<?php
//用户中心，验证登录
if (!isset ($_COOKIE["uid"])) {
	vheader("/login");
}
$uid = $_COOKIE["uid"];
$userinfo =login_user($uid);
/*线路明细查询*/
$info = cg_product($id);
$smarty->assign('info', $info);
$action = $_POST['action'];

$smarty->display(V_ROOT.'./templates/OrderForm_fill.html',$cache_id);
?>