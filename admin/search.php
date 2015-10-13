<?php
require_once ('includes/init.php');
require_once ('includes/checklogin.php');
$action = postget('action');
$action = (empty ($action)) ? "list" : $action;
$perpage = 15;
$page = empty ($_GET['page']) ? 1 : intval($_GET['page']);
$start = ($page -1) * $perpage;
$smarty->assign('action', $action);
$tit = "搜索";
$smarty->assign('tit', $tit);

$ctype = cg_class(0);
$smarty->assign('ctype', $ctype);

$table = DBFIX . "search";

switch ($action) {
	case "delete" :
		$ckey = $_GET['ckey'];
		$sqlstr = "delete from $table where ckey ='" . $ckey . "'";
		$db->query($sqlstr);
		do_daily('search', $id, 2);
		vheader("?types=" . $_POST['types']);
		print "删除成功！<a href='?types=" . $_GET['types'] . "'>返回</a>";
		break;
	case "handle" :
		$ckeys = $_POST['ckeys'];
		$do = 0;
		//$_POST['userid'] = $_SESSION['id'];
		//$_POST['op_user'] = $_SESSION['username'];
		$_POST['cminarr'] = splitarry2($_POST['cminarr']);
		if (empty ($_POST['cmin']) || !empty ($_POST['cminarr'])) {
			$_POST['cmin'] = $_POST['cminarr'];
		}
		unset ($_POST['cminarr'], $_POST['ckeys'], $_POST['keyname'], $_POST['cselected']);

		if (empty ($ckeys)) { //add
			$do = 1;
			$ckeys = $db->inserttable($table, $_POST, 1);
		} else { //edit
			$db->updatetable($table, $_POST, array (
				'ckey' => $ckeys
			));
		}
		do_daily('search', $ckeys, $do);
		print "提交成功！<a href='?types=" . $_POST['types'] . "&c_id=" . $_POST['c_id'] . "'>返回</a>";
		break;
	case "list" :
		$sqladd = ' where 1 ';

		if (!empty ($_GET['keyword'])) { //keywords
			$sqladd .= " and ctitle like '%" . $_GET['keyword'] . "%'";
		}

		$sqlfrom = " from " . $table . $sqladd . $adminsql;
		$totalnum = $db->result($db->query("select count(*) " . $sqlfrom), 0); //总数;
		$query = $db->query("select * " . $sqlfrom . " order by ctype,csearch,display limit $start,$perpage");
		$data = $comments = array ();
		while ($data = $db->fetch_array($query)) {
			$data['ctype'] = $ctype[$data['ctype']];
			$data['csearch'] = $Config['csearch'][$data['csearch']];
			$comments[] = $data;
		}
		$multipage = multi($totalnum, $perpage, $page, '?types=' . $types);
		$smarty->assign('multipage', $multipage);
		$smarty->assign('comments', $comments);
		$smarty->assign('totalnum', $totalnum);

		$smarty->display('search.html');
		break;
	default :
		$ckey = $_GET['ckey'];
		if (!empty ($ckey)) {
			$sqlstr = "select * from $table where ckey='" . $ckey . "'";
			$info = $db->fetch_array($db->query($sqlstr));
			$smarty->assign('info', $info);
		}
		$smarty->display('search.html');
		break;
}
?>