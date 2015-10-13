<?php
require_once ('includes/init.php');
require_once ('includes/checklogin.php');
$action = postget('action');
$action = (empty ($action)) ? "list" : $action;
$types = postget('types');
$types = (empty ($types)) ? 0 : $types;

//
$perpage = 15;
$page = empty ($_GET['page']) ? 1 : intval($_GET['page']);
$start = ($page -1) * $perpage;

if($types==0){
	$tit = "线路产品";$table = DBFIX."product_route_sale";
}else{
	$tit = "旅游产品";$table = DBFIX."scenic";
}
$smarty->assign('tit', $tit);
$smarty->assign('action', $action);
$smarty->assign('types', $types);

switch ($action) {
	case "handle" :
		$id = $_GET['id'];
		$do = 0;
		unset ($_GET['action']);
		unset ($_GET['page']);
		unset ($_GET['types']);
		if (!empty ($id)) {
			$db->updatetable($table, $_GET, array (
				'id' => $id
			));
		}
		vheader("?types=$types&page=$page");
		break;
	case "list" :
		if($types===0){
			$sqladd = ' where types=0 and ctype=0';
		}else{
			$sqladd = 'where 1=1';
		}
		if (!empty ($_GET['keyword'])) { //keywords
			if ($sqladd == "") {
				$sqladd .= " and title like '%" . $_GET['keyword'] . "%'";
			} else {
				$sqladd .= " and title like '%" . $_GET['keyword'] . "%'";
			}
		}
		$sqlfrom = " from " . $table . $sqladd;
		$totalnum = $db->result($db->query("select count(*) " . $sqlfrom), 0); //总数;
		$query = $db->query("select * " . $sqlfrom . " order by addtime desc limit $start,$perpage");
		$data = $comments = array ();
		while ($data = $db->fetch_array($query)) {
			$comments[] = $data;
		}
		$multipage = multi($totalnum, $perpage, $page, '?types=' . $types);
		$smarty->assign('multipage', $multipage);
		$smarty->assign('comments', $comments);
		$smarty->assign('totalnum', $totalnum);
		$smarty->assign('page', $page);
		$smarty->display('allow.html');
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
		$smarty->display('allow.html');
		break;
}
?>