<?php
require_once ('includes/init.php');
require_once ('includes/checklogin.php');
$action = postget('action');
$action = (empty ($action)) ? "list" : $action;
$types = postget('types');
$types = (empty ($types)) ? 0 : $types;
$ctype = postget('ctype');
$ctype = (empty ($ctype)) ? 0 : $ctype;
//
$perpage = 15;
$page = empty ($_GET['page']) ? 1 : intval($_GET['page']);
$start = ($page -1) * $perpage;
$table = DBFIX."air";
if($types==0){
	$tit = "航空公司";
}else{
	$tit = "航空机场";
}
$smarty->assign('tit', $tit);
$smarty->assign('action', $action);
$smarty->assign('types', $types);

switch ($action) {
	case "delete" :
		$id = $_GET['id'];
		$sqlstr = "delete from $table where id =" . $id;
		$db->query($sqlstr);
		do_daily('air', $id, 2);
		vheader("?types=" . $_POST['types']);
		print "删除成功！<a href='?types=" . $_GET['types'] . "'>返回</a>";
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
		do_daily('air', $id, $do);
		print "提交成功！<a href='?types=" . $_POST['types'] . "&ctype=" . $_POST['ctype'] . "'>返回</a>";
		break;
	case "list" :
		$sqladd = ' where types=' . $types;

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

		$smarty->display('air.html');
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
		$smarty->display('air.html');
		break;
}
?>