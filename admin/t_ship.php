<?php
require_once ('includes/init.php');
require_once ('includes/checklogin.php');
$action = postget('action');
$action = (empty ($action)) ? "list" : $action;
$perpage = 15;
$page = empty ($_GET['page']) ? 1 : intval($_GET['page']);
$start = ($page -1) * $perpage;
$smarty->assign('action', $action);
$tit = "轮船";
$smarty->assign('tit', $tit);

$area = cg_class(5);
$smarty->assign('area', $area);

$areatt = cg_area();
$smarty->assign('areatt', $areatt);


$table = DBFIX . "cost_tra_ship";


switch ($action) {
	case "delete" :
		$id = $_GET['id'];
		$sqlstr = "delete from $table where id =" . $id;
		$db->query($sqlstr);
		do_daily('cost_tra_ship', $id, 2);
		vheader("?types=" . $_POST['types']);
		break;
	case "handle" :
		$id = $_POST['id'];
		$do = 0;
		$_POST['userid'] = $_SESSION['id'];
		$_POST['op_user'] = $_SESSION['username'];
		if (empty ($id)) { //add
			unset ($_POST['id']);
			$do = 1;
			$id = $db->inserttable($table, $_POST, 1);
		} else { //edit
			$db->updatetable($table, $_POST, array (
				'id' => $id
			));
		}
		do_daily('cost_tra_ship', $id, $do);
		vheader("?types=" . $_POST['types']);
		break;
	case "list" :
		$sqladd = ' where 1 ';

		if (!empty ($_GET['keyword'])) { //keywords
			if ($sqladd == "") {
				$sqladd .= " and title like '%" . $_GET['keyword'] . "%'";
			} else {
				$sqladd .= " and title like '%" . $_GET['keyword'] . "%'";
			}
		}
		$sqlfrom = " from " . $table . $sqladd;
		$totalnum = $db->result($db->query("select count(*) " . $sqlfrom), 0); //总数;
		$query = $db->query("select * " . $sqlfrom . " order by id desc limit $start,$perpage");
		$data = $comments = array ();
		while ($data = $db->fetch_array($query)) {
			$comments[] = $data;
		}
		$multipage = multi($totalnum, $perpage, $page, '?types=' . $types);
		$smarty->assign('multipage', $multipage);
		$smarty->assign('comments', $comments);
		$smarty->assign('totalnum', $totalnum);

		$smarty->display('t_ship.html');
		break;
	default :
		if (!empty ($_GET['id'])) {
			$id = $_GET['id'];
		} else {
			$id = 0;
		}
		$sqlstr = "select * from $table where id=" . $id;
		$info = $db->fetch_array($db->query($sqlstr));
		$smarty->assign('info', $info);
		$smarty->display('t_ship.html');
		break;
}
?>