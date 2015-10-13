<?php
require_once ('includes/init.php');
require_once ('includes/checklogin.php');
require_once ('includes/func_line.php');
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

$tit = "线路计划";
$smarty->assign('tit', $tit);

$areatt = cg_area();
$smarty->assign('areatt', $areatt);

//机构列表
$smarty->assign('cg_dj', cg_branch(0));
$smarty->assign('cg_yl', cg_branch(2));
//线路class
$class = cg_class(0);
$Allclass = cg_eclass(0);
$hotname = "线路分类";
$smarty->assign('hotname', $hotname);
$smarty->assign('class', $class);
$smarty->assign('Allclass', $Allclass);
$table = DBFIX . "product_route";

switch ($action) {
	case "delete" :
		$id = $_GET['id'];
		$sqlstr = "delete from $table where id =" . $id;
		$db->query($sqlstr);
		do_daily('line', $id, 2, 'line', 0);
		$db->query("delete from " . $table . "_stroke where routeid =" . $id);
		do_daily('line', $id, 2, 'line', 1);
		vheader("?types=$types&ctype=$ctype&id=$id");
		break;
	case "handle" :
		$url = UploadFile($_SESSION['id'], "pic");
		$_POST['url'] = !empty ($url) ? $url : $_POST['url'];
		$id = $_POST['id'];
		$do = 0;
		$_POST['userid'] = $_SESSION['id'];
		$_POST['op_user'] = $_SESSION['username'];

		$_POST["addr"] = is_array($_POST["addr"]) ? implode(',', $_POST["addr"]) : $_POST["addr"];
		$_POST["tim"] = is_array($_POST["tim"]) ? implode(',', $_POST["tim"]) : $_POST["tim"];
		$_POST["ro_type"] = isset ($_POST["ro_type"]) ? $_POST["ro_type"] : "";
		$_POST["ro_type"] = is_array($_POST["ro_type"]) ? implode(',', $_POST["ro_type"]) : $_POST["ro_type"];
		$_POST["op_type"] = isset ($_POST["op_type"]) ? $_POST["op_type"] : "";
		$_POST["op_type"] = is_array($_POST["op_type"]) ? implode(',', $_POST["op_type"]) : $_POST["op_type"];
		unset ($_POST['citys1']);
		unset ($_POST['citys2']);
		/*post plan*/
		if (empty ($id)) { //add
			unset ($_POST['id']);
			$do = 1;
			$id = $db->inserttable($table, $_POST, 1);
		} else { //edit
			$db->updatetable($table, $_POST, array (
				'id' => $id
			));
		}

		do_daily('line', $id, $do, 'line', 0);
		if (strpos($_POST["op_type"], '6')) { //add 2 sales
			$sqlstr = "select * from " . $table . "_sale where types=0 and ctype=0 and id=" . $id;
			$info = $db->getOneInfo($sqlstr);
			if (empty ($info)) { //empty then insert into
				$said = $db->inserttable($table . "_sale", array (
					'departure' => $_POST['city1'],
					'time' => $_POST['time'],
					'title' => $_POST['title'],
					'addr' => $_POST['addr'],
					'tim' => $_POST['tim'],
					'op_type' => $_POST['op_type'],
					'price1' => 0,
					'price2' => $_POST['price2'],
					'id' => $id,
					'userid' => $_SESSION['id'],
					'bid' => $_SESSION['bid'],
					'op_user' => $_SESSION['username']
				), 1);
				do_daily('line', $said, 1, 'line', 5);
			}
		}
		unset ($strokes);
		vheader("?action=edit&id=$id");
		//vheader("?types=$types&ctype=$ctype&id=$id");
		break;
	case "list" :
		$sqladd = " where userid={$_SESSION["id"]}"; //types=' . $types . ' and ctype=' . $ctype . ' and id=' . $id;
		if (!empty ($_GET['keyword'])) { //keywords
			$sqladd .= " and keyword like '%" . $_GET['keyword'] . "%'";
		}
		$sqlfrom = "from (select *, concat_ws(',',title,IFNULL(keywords,' '),IFNULL(remark,' '),op_user) keyword from $table) result" . $sqladd;
		$totalnum = $db->result($db->query("select count(*) " . $sqlfrom), 0); //总数;
		$query = $db->query("select * " . $sqlfrom . " order by id desc limit $start,$perpage");
		$data = $comments = array ();
		while ($data = $db->fetch_array($query)) {
			$data['go_time'] = go_tim($data['go_type'], $data['go_time']);
			$data['city1'] = $areatt[$data['city1']];
			$data['city2'] = $areatt[$data['city2']];
			$comments[] = $data;
		}
		$multipage = multi($totalnum, $perpage, $page, '?types=' . $types);
		$smarty->assign('multipage', $multipage);
		$smarty->assign('comments', $comments);
		$smarty->assign('totalnum', $totalnum);
		$smarty->display('line_plan.html');
		break;
	default :
		//
		$sqlstr = "select * from $table where id=" . $id;
		$info = $db->getOneInfo($sqlstr);
		if (!empty ($info)) {
			$info['ro_type'] = strpos($info['ro_type'], ',') ? explode(',', $info['ro_type']) : $info['ro_type'];
			$info['op_type'] = strpos($info['op_type'], ',') ? explode(',', $info['op_type']) : $info['op_type'];
			$info['city1'] = "<input type='radio' name='city1' value='{$info['city1']}' checked>" . $areatt[$info['city1']];
			$info['city2'] = "<input type='radio' name='city2' value='{$info['city2']}' checked>" . $areatt[$info['city2']];
			$query = $db->query("select * from " . $table . "_stroke where routeid=" . $id . " order by num asc");
			$data = $comments = array ();
			while ($data = $db->fetch_array($query)) {
				$data['eats'] = explode(',', $data['eats']);
				$data['scenics'] = cg_sight('' . $data['departure'] . ',' . $data['arrived'] . '');
				$data['scenic'] = explode(',', $data['scenic']);
				$comments[] = $data;
			}
			$smarty->assign('stroke', $comments);
		} else {
			$info['go_type'] = 3;
			$info['d_type'] = 0;
		}
		$smarty->assign('r_2', $r2);
		$smarty->assign('ro_type', $ro_types);
		$smarty->assign('go_type', $go_types);
		$smarty->assign('op_type', $op_types);
		$smarty->assign('eats', $eats);
		$smarty->assign('traffic', $traffics);
		//
		$smarty->assign('info', $info);
		$smarty->display('line_plan.html');
		break;
}
?>