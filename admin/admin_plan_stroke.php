<?php
require_once ('includes/init.php');
require_once ('includes/checklogin.php');
$action = postget('action');
$routeid = postget('routeid');

$action = (empty ($action)) ? "list" : $action;
$perpage = 15;
$page = empty ($_GET['page']) ? 1 : intval($_GET['page']);
$start = ($page -1) * $perpage;
$smarty->assign('action', $action);
$smarty->assign('routeid', $routeid);

$tit = "线路";
$tit1 = "行程";
$smarty->assign('tit', $tit);
$smarty->assign('tit1', $tit1);
$scenicinfo = $db->getOneInfo("select * from " . DBFIX . "product_route where id=$routeid");
//$scenicinfo['go_time'] = go_tim($scenicinfo['go_type'],$scenicinfo['go_time']);
$smarty->assign('scenicinfo', $scenicinfo);
//地区
$area = cg_class(5);
$smarty->assign('area', $area);
$areatt = cg_area();
$smarty->assign('areatt', $areatt);

$table = DBFIX . "product_route_stroke";

switch ($action) {
	case "delete" :
		$hid = $_GET['hid'];
		$sqlstr = "delete from $table where hid =" . $hid;
		$db->query($sqlstr);
		do_daily('line', $hid, 2, 'line', intval($ctype) + 2);
		$db->query("update " . DBFIX . "product_route set num2=(select count(*) from $table where routeid=$routeid) where id=$routeid");
		vheader("?types=$types&ctype=$ctype&id=$id");

		break;
	case "handle" :
		$url = UploadFile($_SESSION['id'], "pic");
		$_POST['url'] = !empty ($url) ? $url : $_POST['url'];
		$sid = $_POST['sid'];
		$do = 0;
		$_POST['userid'] = $_SESSION['id'];
		$_POST['op_user'] = $_SESSION['username'];

		$_POST['eats'] = implode(',', $_POST['eats']);
		$_POST['tname'] = implode(',', $_POST['tname']);
		$_POST['scenic'] = implode(',', $_POST['scenic']);
		unset ($_POST['tnames'], $_POST['tnamesh'], $_POST['scenics'], $_POST['scenicsh']);

		if (empty ($sid)) { //add
			unset ($_POST['sid']);
			$do = 1;
			$hid = $db->inserttable($table, $_POST, 1);
		} else { //edit
			$db->updatetable($table, $_POST, array (
				'sid' => $sid
			));
		}
		$db->query("update " . DBFIX . "product_route set num2=(select count(*) from $table where routeid=$routeid) where id=$routeid");
		do_daily('line', $hid, 2, 'line', intval($ctype) + 2);
		vheader("?routeid={$_POST['routeid']}");
		break;
	case "list" :
		$sqladd = ' where routeid=' . $routeid;

		$sqlfrom = " from " . $table . $sqladd;
		$totalnum = $db->result($db->query("select count(*) " . $sqlfrom), 0); //总数;
		$query = $db->query("select * " . $sqlfrom . " order by num ");
		$data = $comments = array ();
		while ($data = $db->fetch_array($query)) {
			$comments[] = $data;
		}
		$multipage = multi($totalnum, $perpage, $page, '?action=' . $action);
		$smarty->assign('multipage', $multipage);
		$smarty->assign('comments', $comments);
		$smarty->assign('totalnum', $totalnum);
		$smarty->display('line_day.html');
		break;
	default :
		if (!empty ($_GET['sid'])) {
			$sqlstr = "select * from $table where sid=" . $_GET['sid'];
			$info = $db->fetch_array($db->query($sqlstr));
			$info['eats'] = explode(',', $info['eats']);
		}
		$smarty->assign('info', $info);
		$smarty->display('line_day.html');
		break;
}
?>