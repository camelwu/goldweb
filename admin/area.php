<?php
include_once 'includes/init.php';
require_once ('includes/checklogin.php');
$types = postget('types');
$action = postget('action');
$action = (empty ($action)) ? "list" : $action;
$types = (empty ($types)) ? 0 : $types;
$perpage = 15;
$page = empty ($_GET['page']) ? 1 : intval($_GET['page']);
$start = ($page -1) * $perpage;
$tit = $Config['types'][$types];
$smarty->assign('action', $action);
$smarty->assign('types', $types);
$smarty->assign('tit', $tit);

$area = cg_class(5);
$smarty->assign('area', $area);
$area2 = cg_class(6);
$smarty->assign('area2', $area2);

$table = DBFIX . "area";

switch ($action) {
	case "delete" :
		$id = $_GET['id'];
		$sqlstr = "delete from $table where id =" . $id;
		$db->query($sqlstr);
		do_daily('area', $id, 2);
		vheader("?types=" . $_POST['types']);
		break;
	case "handle" :
		$_POST['status'] = isset($_POST['status'])?$_POST['status']:0;
		$_POST['hits'] = isset($_POST['hits'])?$_POST['hits']:0;
		require_once('includes/class.py.php');
		$py = new PinYin();
		$_POST['region'] = $py->getAllPY($_POST['title']);
		$url = UploadFile($_SESSION['id'], "pic");
		$_POST['url'] = !empty ($url) ? $url : $_POST['url'];
		$id = $_POST['id'];
		$do = 0;
		$_POST['userid'] = $_SESSION['id'];
		$_POST['op_user'] = $_SESSION['username'];
		if (empty ($id)) { //add
			unset ($_POST['id']);
			$do = 1;
			$id = $db->inserttable('cg_area', $_POST, 1);
		} else { //edit
			$db->updatetable('cg_area', $_POST, array (
				'id' => $id
			));
		}
		do_daily('area', $id, $do);
		vheader("?types=" . $_POST['types']);
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
		$sqlfrom = " from " . $table ." t ". $sqladd;
		$totalnum = $db->result($db->query("select count(*) " . $sqlfrom), 0); //总数;
		$query = $db->query("select *,(select title from cg_area where id=t.pid) as pidname " . $sqlfrom . " order by id desc limit $start,$perpage");
		$data = $comments = array ();
		while ($data = $db->fetch_array($query)) {
			$data['url'] = $picserver . (empty ($data['url']) ? '/attached/no.gif' : $data['url']);
			$data['classid'] = $area[$data['classid']];
			$data['classid1'] = $area2[$data['classid1']];
			$comments[] = $data;
		}
		$multipage = multi($totalnum, $perpage, $page, '?types=' . $types);
		$smarty->assign('multipage', $multipage);
		$smarty->assign('comments', $comments);
		$smarty->assign('totalnum', $totalnum);
		$smarty->display('./area.html');
		break;
	default : //add,edit
		if (!empty ($_GET['id'])) {
			$id = $_GET['id'];
		} else {
			$id = 0;
		}
		$sqlstr = "select * from $table where id=" . $id;
		$info = $db->fetch_array($db->query($sqlstr));
		$smarty->assign('info', $info);

		$smarty->display('./area.html');
		break;
}
?>