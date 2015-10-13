<?php
require_once ('includes/init.php');
require_once ('includes/checklogin.php');
require_once ('includes/func_line.php');
$action = postget('action');
$orderNo = postget('orderNo');
$hid = postget('hid');
$types = postget('types');
$ctype = postget('ctype');
$ctype = (empty ($ctype)) ? 0 : $ctype;
$action = (empty ($action)) ? "list" : $action;
$types = (empty ($types)) ? 0 : $types;
$perpage = 15;
$page = empty ($_GET['page']) ? 1 : intval($_GET['page']);
$start = ($page -1) * $perpage;
$table = DBFIX . "product_order";
$taba = DBFIX . "scenic";
switch ($types) {
	case 0 :
		$tit = "酒店";
		break;
	case 1 :
		$tit = "商品";
		break;
	case 2 :
		$tit = "签证";
		break;
	case 3 :
		$tit = "门票";
		break;
	case 4 : //餐厅
		$tit = "邮轮";
		break;
	case 5 :
		$tit = "游记/预计";
		break;
	case 6 :
		$tit = "订做";
		break;
	default :
		$tit = "线路";
		$taba = DBFIX . "product_route_sale";
		break;
}

$smarty->assign('action', $action);
$smarty->assign('types', $types);
$smarty->assign('ctype', $ctype);
$smarty->assign('tit', $tit);
$smarty->assign('orderNo', $orderNo);


switch ($action) {
	case "delete" :
		$id = $_GET['id'];
		$sqlstr = "delete from $table where id =" . $id;
		$db->query($sqlstr);
		do_daily('line', $id, 2, 'line', 0);

		vheader("?types=$types&ctype=$ctype");
		break;
	case "handle" :
		$do = 0;
		$_POST['userid'] = $_SESSION['id'];
		$_POST['op_user'] = $_SESSION['username'];
		/*post sale*/
		if (empty ($id)) { //add
			$db->updatetable($table, $_POST, array (
				'orderNo' => $orderNo
			));
		}
		do_daily('line', $id, $do, 'line', 0);
		vheader("?action=edit&orderNo=$orderNo");
//		$emails = array (
//			$_POST['email']
//		);
//		sendmail($emails, $subject, $content);
//		vheader("?types=$types&ctype=$ctype&id=$id");
		break;
	case "list" :
		$sqladd = " where types=$types and status=$ctype ";

		if (!empty ($_GET['keyword'])) { //keywords
			$sqladd .= " and keyword like '%" . $_GET['keyword'] . "%'";
		}
		$sqlfrom = " from  $table " . $sqladd;
		$totalnum = $db->result($db->query("select count(*) " . $sqlfrom), 0); //总数;
		$query = $db->query("select * " . $sqlfrom . " order by id desc limit $start,$perpage");
		$data = $comments = array ();
		while ($data = $db->fetch_array($query)) {
			$comments[] = $data;
		}
		$multipage = multi($totalnum, $perpage, $page, '?types=' . $types . '&ctype=' . $ctype);
		$smarty->assign('multipage', $multipage);
		$smarty->assign('comments', $comments);
		$smarty->assign('totalnum', $totalnum);
		$smarty->display('product_order.html');
		break;
	case "edit" :
		//
		$sqlstr = "select * from $table where orderNo='$orderNo'";
		$info = $db->getOneInfo($sqlstr);
		if (!empty ($info)) {

		} else {

		}
	
		$smarty->assign('info', $info);
		$smarty->display('product_order.html');
		break;
	default :
		$info = $db->getOneInfo("select * from $table where orderNo='$orderNo'");
		$smarty->assign('info', $info);
		//$smarty->assign('op_type', array(2=>'特色',3=>'推荐',4=>'专题'));
		//$smarty->assign('traffic', $traffics);
		$smarty->display('product_order.html');
		break;
}
?>