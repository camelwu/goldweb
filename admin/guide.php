<?php
require_once ('includes/init.php');
require_once ('includes/checklogin.php');
$action = postget('action');
$types = postget('types');
$action = (empty ($action)) ? "list" : $action;
$types = (empty ($types)) ? 0 : $types;
$perpage = 15;
$page = empty ($_GET['page']) ? 1 : intval($_GET['page']);
$start = ($page -1) * $perpage;
$smarty->assign('action', $action);
$smarty->assign('types', $types);
$tit = $Config['guide'][$types];
$smarty->assign('tit', $tit);

$area = cg_class(5);
$smarty->assign('area', $area);

$areatt = cg_area();
$smarty->assign('areatt', $areatt);

$language = cg_class(7);
$smarty->assign('language', $language);

$table = DBFIX . "guide";

switch ($action) {
	case "delete" :
		$id = $_GET['id'];
		$sqlstr = "delete from $table where id =" . $id;
		$db->query($sqlstr);
		do_daily('guide', $id, 2,'guide',$types);
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
		$_POST['types'] = $types;
		if (!empty ($_POST['language'])) {
			$_POST['language'] = implode(',', $_POST['language']);
		}
		if (empty ($id)) { //add
			unset ($_POST['id']);
			$do = 1;
			$id = $db->inserttable($table, $_POST, 1);
		} else { //edit
			$db->updatetable($table, $_POST, array (
				'id' => $id
			));
		}
		do_daily('guide', $id, $do,'guide',$types);
		print "提交成功！<a href='?types=" . $_POST['types'] . "&c_id=" . $_POST['c_id'] . "'>返回</a>";
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
			$lang = explode(',', $data['language']);
			$data['language'] = $common = '';
			foreach ($lang as $key) {
				$data['language'] .= $common . $language[$key];
				$common = ',';
			}
			$comments[] = $data;
		}
		$multipage = multi($totalnum, $perpage, $page, '?types=' . $types);
		$smarty->assign('multipage', $multipage);
		$smarty->assign('comments', $comments);
		$smarty->assign('totalnum', $totalnum);
		$smarty->display('guide.html');
		break;
	default :
		if (!empty ($_GET['id'])) {
			$id = $_GET['id'];
		} else {
			$id = 0;
		}
		$sqlstr = "select * from $table where id=" . $id;
		$info = $db->fetch_array($db->query($sqlstr));
		if (!empty ($info)) {
			$info['language'] = explode(',', $info['language']);
		}
		$smarty->assign('info', $info);
		$smarty->display('guide.html');
		break;
}
?>