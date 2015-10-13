<?php
require_once ('includes/init.php');
require_once ('includes/checklogin.php');
$perpage = 15;
$page = empty ($_GET['page']) ? 1 : intval($_GET['page']);
$start = ($page -1) * $perpage;
$action = postget('action');
$action = (empty ($action)) ? "list" : $action;
$smarty->assign('action', $action);
$tit = "人员";
//
$cg_branch = cg_branch();
$smarty->assign('cg_branch', $cg_branch);
$smarty->assign('tit', $tit);
//权限
$adminsql = '';
if ($adminid) {
	$adminsql = " and (uid={$adminid} )";
}

switch ($action) {
	case "delete" :
		$id = $_GET['id'];
		$sqlstr = "delete from cg_user where id>1 and id =" . $id.$adminsql;
		$db->query($sqlstr);
		do_daily('user', $id, 2);
		vheader("?types=" . $_POST['types']);
		break;
	case "handle" :
		$id = postget('id');
		$_POST['allowstr'] = splitarry($_POST['allowstr']);
		unset ($_POST['topassword'], $_POST['id']);
		$do = 0;
		if (!empty ($_POST['password'])) {
			$_POST['password'] = md5($_POST['password']);
		} else {
			unset ($_POST['password']);
		}
		if (empty ($id)) { //add
			$db->inserttable('cg_user', $_POST);
			$id = $db->insert_id();
			$do = 1;
		} else { //edit
			$db->updatetable('cg_user', $_POST, array (
				'id' => $id
			));
		}
		do_daily('user', $id, $do);
		print "提交成功！<a href='?action=edit&id=" . $id . "'>返回</a>";
		break;
	case "list" :
		$sqlfrom = " from " . DBFIX . "user where 1 ".$adminsql;
		if (!empty ($_GET['keyword'])) {
			$sqlfrom .= " and username like '%{$_GET['keyword']}%'";
		}
		$totalnum = $db->result($db->query("select count(*) " . $sqlfrom), 0); //总数
		$query = $db->query("select * " . $sqlfrom . " order by id limit $start,$perpage");
		$data = $comments = array ();
		while ($data = $db->fetch_array($query)) {
			$data['bid'] = getBran($data['bid']);
			$comments[] = $data;
		}
		$multipage = multi($totalnum, $perpage, $page, $filename);
		$smarty->assign('multipage', $multipage);
		$smarty->assign('comments', $comments);
		$smarty->assign('totalnum', $totalnum);

		$smarty->display('config_user.html');
		break;
	default :
		if (!empty ($_GET['id'])) {
			$id = $_GET['id'];
		} else {
			$id = 0;
		}
		$query = "select * from " . DBFIX . "user where id=" . $id . "";
		$info = $db->getOneInfo($query);
		$data = cg_user($adminid);
		$smarty->assign('info', $info);
		$smarty->assign('data', $data);
		$smarty->assign('menu', getmenu($info['allowstr']));
		$smarty->display('config_user.html');
		break;
}
?>
