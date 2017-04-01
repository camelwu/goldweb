<?php
//用户中心，验证登录
if (!isset ($_COOKIE["uid"])) {
	vheader("/login");
}
$uid = $_COOKIE["uid"];
$userinfo = login_user($uid);
$action = $_POST['action'];
$peoplenum = $_POST['peoplenum'];
$id = $_POST['id'];
/*线路明细查询*/
$sqlstr = "select * from cg_scenic where id=" . $id;
$info = $db->getOneInfo($sqlstr);
$smarty->assign('peoplenum', $peoplenum);
$smarty->assign('info', $info);
$smarty->assign('price', $peoplenum * $info['price1']);

if (!empty ($action)) {
	$data['orderNo'] = md5(time() . rand(1, 1000));
	$data['types'] = 3;
	$data['uid'] = $uid;
	$data['username'] = $userinfo['username'];
	$data['title'] = $info['title'];
	$data['id'] = $info['id'];
	$data['ordernum'] = $peoplenum;
	$data['price'] = $_POST['price'];
	$data['name'] = $_POST['name'];
	$data['ordertime'] = $_POST['ordertime'];
	$data['tel'] = $_POST['tel'];
	$data['email'] = $_POST['email'];
	$data['createtime'] = date("Y-m-d H:i:s");
	$data['info'] = (empty ($_POST['info'])) ? "无" : $_POST['info'];
	$db->inserttable("cg_product_order", $data);
	$smarty->assign('msg', '订单提交成功');
	$smarty->display(VIEWPATH . 'msg.html', $cache_id);
} else {
	$smarty->display(VIEWPATH . 'orderdetailfill.html', $cache_id);
}
?>
