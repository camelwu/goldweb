<?php
require_once ('includes/init.php');
require_once ('includes/checklogin.php');
require_once ('includes/func_line.php');
$action = postget('action');
$id = postget('id');
$hid = postget('hid');
$types = postget('types');
$ctype = postget('ctype');
$action = (empty ($action)) ? "list" : $action;
$types = (empty ($types)) ? 0 : $types;
$ctype = (empty ($ctype)) ? 0 : $ctype;
$perpage = 15;
$page = empty ($_GET['page']) ? 1 : intval($_GET['page']);
$start = ($page -1) * $perpage;
$smarty->assign('action', $action);
$smarty->assign('ctype', $ctype);
$smarty->assign('types', $types);
$smarty->assign('id', $id);
$smarty->assign('hid', $hid);

$tit = "销售";
$smarty->assign('tit', $tit);
$table = DBFIX . "product_route";
$taba = DBFIX . "product_route_sale";

//地区
$area = cg_class(5);
$smarty->assign('area', $area);

$areatt = cg_area();
$smarty->assign('areatt', $areatt);

//权限
$adminsql = '';
if ($adminid) {
	$adminsql = " and (userid={$adminid} or bid={$adminbid})  ";
}

switch ($action) {
	case "delete" :

		$sqlstr = "delete from $table where hid =" . $hid;
		$db->query($sqlstr);
		do_daily('line', $hid, 2, 'line', 4);

		vheader("?types=$types&ctype=$ctype");
		break;
	case "handle" :
		$hid = $_POST['hid'];
		$id = $_POST['id'];
		$do = 0;
		$_POST['userid'] = $_SESSION['id'];
		$_POST['bid'] = $_SESSION['bid'];
		$_POST['op_user'] = $_SESSION['username'];
		$_POST["addr"] = is_array($_POST["addr"]) ? implode(',', $_POST["addr"]) : $_POST["addr"];
		$_POST["tim"] = is_array($_POST["tim"]) ? implode(',', $_POST["tim"]) : $_POST["tim"];
		$_POST["op_type"] = isset ($_POST["op_type"]) ? $_POST["op_type"] : "";
		$_POST["op_type"] = is_array($_POST["op_type"]) ? implode(',', $_POST["op_type"]) : $_POST["op_type"];
		unset ($_POST['departures']);
		/*post sale*/
		if (empty ($hid)) { //add
			unset ($_POST['hid']);
			$do = 1;
			$hid = $db->inserttable($table . "_sale", $_POST, 1);
		} else { //edit
			$db->updatetable($table . "_sale", $_POST, array (
				'hid' => $hid
			));
		}
		do_daily('line', $hid, $do, 'line', 4);
		vheader("?action=edit&hid=$hid");
		//vheader("?types=$types&ctype=$ctype&id=$id");
		break;
	case "list" :
		//$adminsql = " and (p.userid={$adminid} or p.bid={$adminbid})  ";
		$sqladd = " and t.ctype=$ctype"; //第一手销售，非转销
		if ($types == 0) {
			if ($_SESSION["id"] != '1') {
				$sqladd .= " and (t.userid={$_SESSION["id"]} or t.bid={$adminbid})";
			}
		} else {
			if ($_SESSION["id"] != '1') {
				$sqladd .= " and t.userid!={$_SESSION["id"]}";
			}
		}

		if (!empty ($_GET['keyword'])) { //keywords
			$sqladd .= " and (p.keyword like '%" . $_GET['keyword'] . "%'";
			if ($types == 1 && $ctype == 0) {
				$sqladd .= " or p.op_user like '%" . $_GET['keyword'] . "%')";
			} else {
				$sqladd .= " or t.op_user like '%" . $_GET['keyword'] . "%')";
			}
		}
		$sqlfrom = "  from $taba t,$table p where t.id=p.id " . $sqladd;
		$totalnum = $db->result($db->query("select count(*) " . $sqlfrom), 0); //总数;
		$query = $db->query("select t.hid,t.title name,t.price1 price_1,t.price2 price_2,t.departure,p.* " . $sqlfrom . " order by hid desc limit $start,$perpage");
		$data = $comments = array ();
		while ($data = $db->fetch_array($query)) {
			$data['go_time'] = go_tim($data['go_type'], $data['go_time']);
			$comments[] = $data;
		}
		$multipage = multi($totalnum, $perpage, $page, '?types=' . $types . '?ctype=' . $ctype);
		$smarty->assign('multipage', $multipage);
		$smarty->assign('comments', $comments);
		$smarty->assign('totalnum', $totalnum);
		$smarty->display('line_sale.html');
		break;
	case "view" :
		$sqlstr = "select * from $table where id=" . $id;
		$info = $db->getOneInfo($sqlstr);
		if (!empty ($info)) {
			$info['go_time'] = go_tim($info['go_type'], $info['go_time']);
			$info['ro_type'] = cg_getval($info['ro_type'], $ro_types);
			$info['op_type'] = cg_getval($info['op_type'], $op_types);
			$info['visa'] = cg_gettit($info['visa'], 'visa');
			$info['dj'] = cg_gettit($info['dj'], 'branch');
			$data = $comments = array ();
			if ($info['d_type'] == 0) { //
				$query = $db->query("select * from " . $table . "_stroke where id=" . $info['id'] . " order by num asc");
				while ($data = $db->fetch_array($query)) {
					$data['eats'] = cg_getval($data['eats'], $eats);
					$data['traffic'] = cg_getval($data['traffic'], $traffics);
					$comments[] = $data;
				}
			} //
			$smarty->assign('stroke', $comments);
			$class1 = $db->getOneInfo("select title from cg_class where id=" . $info['classid'] . "");
			$smarty->assign('class1', $class1['title']);
			$class2 = $db->getOneInfo("select title from cg_class where id=" . $info['classid2'] . "");
			$smarty->assign('class2', $class2['title']);
		}

		$smarty->assign('info', $info);
		$smarty->display('line_sale.html');
		break;
	case "price" :
		$route = $db->getOneInfo("select * from $table where id=" . $id);
		$smarty->assign('route', $route);
		//
		$sqladd = ' where types=0 and ctype=0 and id=' . $id;
		$sqlfrom = " from " . $table . "_do" . $sqladd;
		$totalnum = $db->result($db->query("select count(*) " . $sqlfrom), 0); //总数;
		$query = $db->query("select * " . $sqlfrom . " order by hid desc");
		$data = $comments = array ();
		while ($data = $db->fetch_array($query)) {
			$comments[] = $data;
		}
		//$multipage = multi($totalnum, $perpage, $page, '?types=' . $types);
		//$smarty->assign('multipage', $multipage);
		$smarty->assign('comments', $comments);
		$smarty->assign('totalnum', $totalnum);
		$smarty->display('line_sale.html');
		break;
	default :

		//
		$info = $db->getOneInfo("select * from " . $taba . " where hid=" . $hid);
		if (!empty ($info)) {
			$info['op_type'] = strpos($info['op_type'], ',') ? explode(',', $info['op_type']) : $info['op_type'];
		}
		if (empty ($id)) {
			$id = $info['id'];
		}
		$route = $db->getOneInfo("select * from $table where id=" . $id);
		$smarty->assign('route', $route);

		$smarty->assign('info', $info);
		$smarty->assign('op_type', $op_types);
		$smarty->assign('traffic', $traffics);
		$smarty->display('line_sale.html');
		break;
}
?>