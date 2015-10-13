<?php
require_once ('includes/init.php');
require_once ('includes/checklogin.php');
$action = postget('action');
$id = postget('id');
$types = postget('types');
$ctype = postget('ctype');
$action = (empty ($action)) ? "list" : $action;
$types = (empty ($types)) ? 0 : $types;
$perpage = 15;
$page = empty ($_GET['page']) ? 1 : intval($_GET['page']);
$start = ($page -1) * $perpage;
$smarty->assign('action', $action);
$smarty->assign('types', $types);
$smarty->assign('id', $id);
$smarty->assign('ctype', $ctype);
if($types=='4'){
	$Config['hotel'][0]='餐费';
}
$tit = $Config['scenic'][$types];
$tit1 = $Config['hotel'][$ctype];
$smarty->assign('tit', $tit);
$smarty->assign('tit1', $tit1);
$scenicinfo = $db->getOneInfo("select * from cg_scenic  where id=$id");
$smarty->assign('scenicinfo',$scenicinfo);


//地区
$area = cg_class(5);
$smarty->assign('area', $area);
$areatt = cg_area();
$smarty->assign('areatt', $areatt);

//酒店星际
$hotel = cg_class(4);
$smarty->assign('hotel', $hotel);

$table = DBFIX . "hotel";

switch ($action) {
	case "delete" :
		$hid = $_GET['hid'];
		$sqlstr = "delete from $table where hid =" . $hid;
		$db->query($sqlstr);
		do_daily('hotel', $hid, 2, 'hotel', $ctype);
		$db->query("update cg_scenic set num=(select count(*) from cg_hotel  where id=$id and ctype=0) where id=$id");
		$db->query("update cg_scenic set num1=(select count(*) from cg_hotel  where id=$id and ctype=1) where id=$id");

		vheader("?types=$types&ctype=$ctype&id=$id");
		print "提交成功！<a href='?types=$types&ctype=$ctype&id=$id'>返回</a>";
		break;
	case "handle" :
		$url = UploadFile($_SESSION['id'], "pic");
		$_POST['url'] = !empty ($url) ? $url : $_POST['url'];
		$hid = $_POST['hid'];
		$do = 0;
		$_POST['userid'] = $_SESSION['id'];
		$_POST['op_user'] = $_SESSION['username'];
		$_POST['types'] = $types;

		if (empty ($hid)) { //add
			unset ($_POST['hid']);
			$do = 1;
			$hid = $db->inserttable($table, $_POST, 1);
		} else { //edit
			$db->updatetable($table, $_POST, array (
				'hid' => $hid
			));
		}
		$db->query("update cg_scenic set num=(select count(*) from cg_hotel  where id=$id and ctype=0) where id=$id");
		$db->query("update cg_scenic set num1=(select count(*) from cg_hotel  where id=$id and ctype=1) where id=$id");

		do_daily('hotel', $hid, $do, 'hotel', $ctype);
		print "提交成功！<a href='?types=$types&ctype=$ctype&id=$id'>返回</a>";
		break;
	case "list" :
		$sqladd = ' where types=' . $types . ' and ctype=' . $ctype . ' and id=' . $id;

		$sqlfrom = " from " . $table . $sqladd;
		$totalnum = $db->result($db->query("select count(*) " . $sqlfrom), 0); //总数;
		$query = $db->query("select * " . $sqlfrom . " order by hid ");
		$data = $comments = array ();
		while ($data = $db->fetch_array($query)) {
			$comments[] = $data;
		}
		$multipage = multi($totalnum, $perpage, $page, '?types=' . $types);
		$smarty->assign('multipage', $multipage);
		$smarty->assign('comments', $comments);
		$smarty->assign('totalnum', $totalnum);
		$smarty->display('hotel.html');
		break;
	default :
		if (!empty ($_GET['hid'])) {
			$hid = $_GET['hid'];
		} else {
			$hid = 0;
		}
		$sqlstr = "select * from $table where hid=" . $hid;
		$info = $db->fetch_array($db->query($sqlstr));
		if (!empty ($info)) {
		}
		$smarty->assign('info', $info);
		$smarty->display('hotel.html');
		break;
}
?>