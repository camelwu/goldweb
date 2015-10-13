<?php
require_once ('includes/init.php');
require_once ('includes/checklogin.php');
$action = postget('action');
$action = (empty ($action)) ? "list" : $action;
$perpage = 15;
$page = empty ($_GET['page']) ? 1 : intval($_GET['page']);
$start = ($page -1) * $perpage;
$smarty->assign('action', $action);
$tit = "链接";
$smarty->assign('tit', $tit);

$area = cg_class(5);
$smarty->assign('area', $area);

$areatt = cg_area();
$smarty->assign('areatt', $areatt);

$table = DBFIX . "link";

$cg_branch = cg_branch(1);
$smarty->assign('cg_branch', $cg_branch);

$adminsql = '';
if ($adminbid) {
	$adminsql = " and bid={$adminbid} ";
}

switch ($action) {
	case "delete" :
		$id = $_GET['id'];
		$sqlstr = "delete from $table where id =" . $id . $adminsql;
		$db->query($sqlstr);
		do_daily('cost_tra_car', $id, 2);
		vheader("?types=" . $_POST['types']);
		print "删除成功！<a href='?types=" . $_GET['types'] . "'>返回</a>";
		break;
	case "handle" :
		$url = UploadFile($_SESSION['id'], "pic");
		$_POST['url'] = !empty ($url) ? $url : $_POST['url'];
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
		do_daily($table, $id, $do);
		print "提交成功！<a href='?types=" . $_POST['types'] . "&c_id=" . $_POST['c_id'] . "'>返回</a>";
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
		$sqlfrom = " from " . $table . $sqladd . $adminsql;
		$totalnum = $db->result($db->query("select count(*) " . $sqlfrom), 0); //总数;
		$query = $db->query("select * " . $sqlfrom . " order by hots limit $start,$perpage");
		$data = $comments = array ();
		while ($data = $db->fetch_array($query)) {
			$data['url'] = (empty ($data['url']) ? '/attached/no.gif' : $data['url']);
			$data['status'] = $Config['status'][$data['status']];
			$comments[] = $data;
		}
		$multipage = multi($totalnum, $perpage, $page, '?types=' . $types);
		$smarty->assign('multipage', $multipage);
		$smarty->assign('comments', $comments);
		$smarty->assign('totalnum', $totalnum);

		$smarty->display('config_link.html');
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
		$smarty->display('config_link.html');
		break;
}
?>